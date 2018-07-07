<?php
$resultado = '';

$Controller = new Controller($_POST);

if( $Controller->getNoController() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Nome não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Controller->getDsController() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Descrição não preechida!");
	echo json_encode($resultado);
	exit;
}
if( $Controller->getDsCaminho() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Caminho não preenchido!");
	echo json_encode($resultado);
	exit;
}
