<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
$banco = new banco();

// initilize all variable
$params = $totalRecords = $data = array();

$orderBy = $limit = "";
$where = "mo.st_ativo IS TRUE";

$params = $_REQUEST;
$limit = $params["rowCount"];

if (isset($params["current"])) {
    $page = $params["current"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $limit;
// check search value exist
if (! empty($params['searchPhrase'])) {
    $where .= " AND (pe.no_pessoa like '%" . $params['searchPhrase'] . "%' OR concat(tr.no_torre,u.nu_numero) like '%" . $params['searchPhrase'] . "%') ";
}
if (! empty($params['sort'])) {
    switch (key($params['sort'])){
        case "morador":
            $itemOrder = "pe.no_pessoa";
            break;
        case "unidade":
            $itemOrder = "tr.no_torre";
            break;
        default:
            $itemOrder = key($params['sort']);
    }
    $orderBy = $itemOrder . ' ' . current($params['sort']);
}
// getting total number records without any search
$campos = "concat(tr.no_torre,u.nu_numero) AS unidade,
            tu.no_tipo_unidade AS 'Tipo de unidade',
            pe.no_pessoa AS morador,
            mo.co_pessoa,
            u.co_unidade,
            tr.co_torre,
            u.nu_numero";
$tabelas = "tb_morador AS mo
			INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
			INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade
			INNER JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=mo.co_tipo_morador
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
			INNER JOIN tb_torre AS tr ON tr.co_torre=u.co_torre";

if ($limit != - 1){
    $limit = "$start_from, $limit";
}

$resTotal = $banco->seleciona($tabelas,"count(mo.co_pessoa) AS total", $where, NULL, NULL, NULL, FALSE);
$totalRecords = $resTotal[0]['total'];

$data = $banco->seleciona($tabelas, $campos, $where, NULL, $orderBy, $limit, FALSE);

$json_data = array(
    "current" => intval($params['current']),
    "rowCount" => 10,
    "total" => intval($totalRecords),
    "rows" => $data // total data array
);

echo json_encode($json_data);

