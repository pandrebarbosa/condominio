<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
$banco = new banco();

// initilize all variable
$params = $totalRecords = $data = array();

$orderBy = $limit = "";
$where = "u.st_ativo IS TRUE";

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
    $where .= " AND u.nu_numero = " . $params['searchPhrase'];
}
if (! empty($params['sort'])) {
    switch (key($params['sort'])){
        case "no_tipo_unidade":
            $itemOrder = "tu.no_tipo_unidade";
            break;
            
        case "co_torre":
            $itemOrder = "t.co_torre";
            break;
        case "unidade":
            $itemOrder = "u.nu_numero";
            break;
        default:
            $itemOrder = key($params['sort']);
    }
    $orderBy = $itemOrder . ' ' . current($params['sort']);
}
// getting total number records without any search
$campos = "CONCAT(t.no_torre,u.nu_numero)  AS unidade, u.co_unidade, u.co_torre, u.nu_numero, tu.no_tipo_unidade";
$tabelas = "tb_unidade AS u 
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade 
			LEFT JOIN tb_torre AS t ON t.co_torre=u.co_torre";

if ($limit != - 1){
    $limit = "$start_from, $limit";
}

$resTotal = $banco->seleciona($tabelas,"count(u.nu_numero) AS total", $where, NULL, NULL, NULL, FALSE);
$totalRecords = $resTotal[0]['total'];

$data = $banco->seleciona($tabelas, $campos, $where, NULL, $orderBy, $limit, FALSE);

$json_data = array(
    "current" => intval($params['current']),
    "rowCount" => 10,
    "total" => intval($totalRecords),
    "rows" => $data // total data array
);

echo json_encode($json_data);