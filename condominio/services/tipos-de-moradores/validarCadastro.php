<?php
$resultado = '';

$TipoMorador = new TipoMorador($_POST);

if( $TipoMorador->getNoTipoMorador() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Nome não preenchido!");
	echo json_encode($resultado);
	exit;
}

