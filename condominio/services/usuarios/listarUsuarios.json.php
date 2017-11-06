<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
$banco = new banco();

// initilize all variable
$params = $totalRecords = $data = array();

$orderBy = $limit = $where = "";

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
    $where .= " p.no_pessoa LIKE '%" . $params['searchPhrase'] . "%' ";
    $where .= " OR u.ds_login LIKE '%" . $params['searchPhrase'] . "%'";
}
if (! empty($params['sort'])) {
    switch (key($params['sort'])){
        case "nome":
            $itemOrder = "p.no_pessoa";
            break;
        case "login":
            $itemOrder = "u.ds_login";
            break;
        case "tipo":
            $itemOrder = "tu.no_tipo_usuario";
            break;
        case "ativo":
            $itemOrder = "u.st_ativo";
            break;
        default:
            $itemOrder = key($params['sort']);        
    }
    $orderBy = $itemOrder . ' ' . current($params['sort']);
}
// getting total number records without any search
$campos = "p.co_pessoa,p.no_pessoa AS nome, u.ds_login AS login, tu.no_tipo_usuario AS tipo,
			CASE u.st_ativo
	    		WHEN 1 THEN 'Sim'
				WHEN 0 THEN 'Não'
			END AS ativo";

$tabelas = "tb_pessoa AS p
		    INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
			INNER JOIN tb_tipo_usuario AS tu ON tu.co_tipo_usuario=u.co_tipo_usuario";

if ($limit != - 1){
    $limit = "$start_from, $limit";
}

$resTotal = $banco->seleciona($tabelas,"count(p.co_pessoa) AS total", $where, NULL, NULL, NULL, FALSE);
$totalRecords = $resTotal[0]['total'];

$data = $banco->seleciona($tabelas, $campos, $where, NULL, $orderBy, $limit, FALSE);

$json_data = array(
    "current" => intval($params['current']),
    "rowCount" => 10,
    "total" => intval($totalRecords),
    "rows" => $data // total data array
);

echo json_encode($json_data);
	