<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$ds_placa = isset($_POST["ds_placa"]) ? $_POST["ds_placa"] : '';
$co_modelo_veiculo = isset($_POST["co_modelo_veiculo"]) ? $_POST["co_modelo_veiculo"] : '';


$criterio="v.st_ativo IS TRUE";
if($ds_placa != ""){
	$criterio .= " AND v.ds_placa='" . $ds_placa . "'";
}
if($co_modelo_veiculo!=""){
	$criterio .= " AND v.co_modelo_veiculo=" . $co_modelo_veiculo . "";
}

$pagina = isset ( $_POST ["pagina"] ) && $_POST ["pagina"] != "" ? $_POST ["pagina"] : 1;
$maximo = isset ( $_POST ["maximo"] ) ? $_POST ["maximo"] : null;

$campos = "vg.nu_numero,v.ds_cor,UPPER(v.ds_placa) AS 'Placa',tv.no_tipo_veiculo AS 'Tipo',mv.no_modelo_veiculo AS 'Veículo',u.co_unidade,u.nu_numero AS 'Garagem',u.co_torre";
$tabelas = "tb_veiculo AS v
			INNER JOIN tb_unidade AS u ON u.co_unidade=v.co_unidade
			LEFT  JOIN tb_unidade AS vg ON v.co_vaga=vg.co_unidade
			INNER JOIN tb_tipo_veiculo AS tv ON tv.co_tipo_veiculo=v.co_tipo_veiculo
			INNER JOIN tb_modelo_veiculo AS mv ON mv.co_modelo_veiculo=v.co_modelo_veiculo";
$resTotal = $banco->seleciona($tabelas,"count(vg.nu_numero) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$totalDeRegistros = $resTotal[0]['total'];

$arrayTotalDeRegistros = array("total"=>$totalDeRegistros);

$inicio = $pagina - 1;
$inicio = $maximo * $inicio;

$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", NULL, NULL, "$inicio,$maximo", FALSE);

//adidiona o total de registros no inicio do array
if($totalDeRegistros>0){
	array_unshift($pedidos,$arrayTotalDeRegistros);
}
echo json_encode($pedidos);