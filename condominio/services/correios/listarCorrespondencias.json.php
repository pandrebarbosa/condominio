<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
$banco = new banco();

// initilize all variable
$params = $totalRecords = $data = array();

$orderBy = $limit = "";
$where = "c.st_ativo IS TRUE";

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
    $where .= " AND ( CONCAT(tic.no_tipo_item_correio,' nr. ',c.ds_item) LIKE '%" . $params['searchPhrase'] . "%' ";
    $where .= " OR p.no_pessoa LIKE '%" . $params['searchPhrase'] . "%' ";
    $where .= " OR c.ds_observacao LIKE '%" . $params['searchPhrase'] . "%' ";
    $where .= " OR CONCAT('Torre ',u.co_torre,' unidade ',u.nu_numero) LIKE '%" . $params['searchPhrase'] . "%' )";
}
if (! empty($params['sort'])) {
    switch (key($params['sort'])){
        case "chegada":
            $itemOrder = "c.dt_hr_chegada";
            break;
        case "retirada":
            $itemOrder = "rc.dt_hr_retirada";
            break;
        default:
            $itemOrder = key($params['sort']);        
    }
    $orderBy = $itemOrder . ' ' . current($params['sort']);
}
// getting total number records without any search
$campos = "c.co_item_correio AS 'id',
           CONCAT(tic.no_tipo_item_correio,' nr. ',c.ds_item) AS 'item',
			CONCAT('Torre ',u.co_torre,' unidade ',u.nu_numero) AS 'unidade',
            p.no_pessoa AS 'recebedor',
			DATE_FORMAT(c.dt_hr_chegada,'%d/%m/%Y %H:%i') AS 'chegada',
			COALESCE(DATE_FORMAT(rc.dt_hr_retirada,'%d/%m/%Y %H:%i'), '<i>Não retirado</i>') AS 'retirada'";

$tabelas = "tb_correio AS c
		    INNER JOIN tb_tipo_item_correio AS tic ON tic.co_tipo_item_correio=c.co_tipo_item_correio
			INNER JOIN tb_pessoa AS p ON p.co_pessoa=c.co_funcionario_recebimento
			INNER JOIN tb_unidade AS u ON u.co_unidade=c.co_unidade
			LEFT JOIN tb_retirada_correio AS rc ON rc.co_item_correio=c.co_item_correio";

if ($limit != - 1){
    $limit = "$start_from, $limit";
}

$resTotal = $banco->seleciona($tabelas,"count(c.co_item_correio) AS total", $where, NULL, NULL, NULL, FALSE);
$totalRecords = $resTotal[0]['total'];

$data = $banco->seleciona($tabelas, $campos, $where, NULL, $orderBy, $limit, FALSE);

//Converte ID para Inteiro
foreach($data as $k => $val){
    foreach($val as $key => $value){
        if($key == "id"){
           $value = intval($value); 
        }
        $val[$key] = $value;
    }
    $data[$k] = $val;
}

$json_data = array(
    "current" => intval($params['current']),
    "rowCount" => 10,
    "total" => intval($totalRecords),
    "rows" => $data // total data array
);

echo json_encode($json_data);
	