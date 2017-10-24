<?php
$resultado = '';

$RetiradaCorreio = new RetiradaCorreio($_POST);

if( $RetiradaCorreio->getCoItemCorreio() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Funcionário não identificado!");
	echo json_encode($resultado);
	exit;
}
if( $RetiradaCorreio->getCoFuncionarioRetirada() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Unidade não identificada!");
	echo json_encode($resultado);
	exit;
}
if( $RetiradaCorreio->getDtHrRetirada() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Tipo de correspondência não identificada!");
	echo json_encode($resultado);
	exit;
}
if( $RetiradaCorreio->getDsObservacao() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Número da correspondência não preenchida!");
	echo json_encode($resultado);
	exit;
}

$RetiradaCorreio->setDtHrRetirada(toolBox::formataDataHora($RetiradaCorreio->getDtHrRetirada(),"G"));