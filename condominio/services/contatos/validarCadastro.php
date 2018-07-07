<?php
$resultado = '';

$Contato = new Contato($_POST);

if( $Contato->getCoPessoa() == NULL){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Morador não identificado!");
	echo json_encode($resultado);
	exit;
}
if( $Contato->getCoTipoContato() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Tipo de contato não selecionado!");
	echo json_encode($resultado);
	exit;
}
if( $Contato->getDsContato() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Contato não preenchido!");
	echo json_encode($resultado);
	exit;
}