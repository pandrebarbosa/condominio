<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
$banco = new banco();

// initilize all variable
$params = $totalRecords = $data = array();

$orderBy = $limit = "";
$where = "u.st_ativo IS TRUE";
$co_tipo_unidade = "";

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
    $where .= " AND (p.no_pessoa like '%" . $params['searchPhrase'] ."%' ";
    $where .= " OR u.nu_numero = '" . $params['searchPhrase'] . "'";
    $where .= " OR tu.no_tipo_unidade like '%" . $params['searchPhrase'] . "%'";
    $where .= " OR CONCAT(t.no_torre,u.nu_numero) = '" . $params['searchPhrase'] . "')";
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
$campos = "u.nu_numero as 'nu_numero',tu.no_tipo_unidade AS 'tipo',u.co_unidade as 'co_unidade',t.no_torre as 'no_torre',
        CONCAT(t.no_torre,u.nu_numero)  AS 'unidade',
        COALESCE(p.no_pessoa,'Desocupado') AS 'morador',p.co_pessoa";
$tabelas = "tb_unidade AS u
        INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
        LEFT JOIN tb_torre AS t ON t.co_torre=u.co_torre
        LEFT JOIN tb_morador AS m ON m.co_unidade=u.co_unidade AND m.st_ativo IS TRUE
        LEFT JOIN tb_pessoa AS p ON p.co_pessoa=m.co_pessoa
        LEFT JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=m.co_tipo_morador";
        
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