<?php
$resultado = '';

$Unidade = new Unidade($_POST);

if( $Unidade->getCoTipoUnidade() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Tipo de usuário não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Unidade->getCoTorre() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Torre não identificada!");
	echo json_encode($resultado);
	exit;
}
if( $Unidade->getNuNumero() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Número da unidade não identificada!");
	echo json_encode($resultado);
	exit;
}
