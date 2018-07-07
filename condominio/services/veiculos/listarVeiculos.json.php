<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
$banco = new banco();

// initilize all variable
$params = $totalRecords = $data = array();

$orderBy = $limit = "";
$where = "v.st_ativo IS TRUE";

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
    $where .= " AND v.ds_placa LIKE '%" . $params['searchPhrase'] . "%' ";
    $where .= " OR mv.no_modelo_veiculo LIKE '%" . $params['searchPhrase'] . "%' ";
    $where .= " OR vg.nu_numero = '" . $params['searchPhrase'] . "' ";
}
if (! empty($params['sort'])) {
    switch (key($params['sort'])){
        case "veiculo":
            $itemOrder = "mv.no_modelo_veiculo";
            break;
        case "tipo":
            $itemOrder = "tv.no_tipo_veiculo";
            break;
        case "garagem":
            $itemOrder = "vg.nu_numero";
            break;
        case "torre":
            $itemOrder = "u.co_torre";
            break;
        default:
            $itemOrder = key($params['sort']);
    }
    $orderBy = $itemOrder . ' ' . current($params['sort']);
}
// getting total number records without any search
$campos = "vg.nu_numero AS 'garagem',v.ds_cor,UPPER(v.ds_placa) AS 'placa',tv.no_tipo_veiculo AS 'tipo',mv.no_modelo_veiculo AS 'veiculo',u.co_unidade as 'co_unidade',u.nu_numero as 'unidade' ,u.co_torre as 'torre'";

$tabelas = "tb_veiculo AS v
			INNER JOIN tb_unidade AS u ON u.co_unidade=v.co_unidade
			LEFT  JOIN tb_unidade AS vg ON v.co_vaga=vg.co_unidade
			INNER JOIN tb_tipo_veiculo AS tv ON tv.co_tipo_veiculo=v.co_tipo_veiculo
			INNER JOIN tb_modelo_veiculo AS mv ON mv.co_modelo_veiculo=v.co_modelo_veiculo";

if ($limit != - 1){
    $limit = "$start_from, $limit";
}

$resTotal = $banco->seleciona($tabelas,"count(vg.nu_numero) AS total", $where, NULL, NULL, NULL, FALSE);
$totalRecords = $resTotal[0]['total'];

$data = $banco->seleciona($tabelas, $campos, $where, NULL, $orderBy, $limit, FALSE);

$json_data = array(
    "current" => intval($params['current']),
    "rowCount" => 10,
    "total" => intval($totalRecords),
    "rows" => $data // total data array
);

echo json_encode($json_data);
