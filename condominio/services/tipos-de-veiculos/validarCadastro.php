<?php
$resultado = '';

$TipoMorador = new TipoMorador($_POST);

if( $TipoMorador->getNoTipoMorador() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Nome não preenchido!");
	echo json_encode($resultado);
	exit;
}

