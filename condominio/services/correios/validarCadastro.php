<?php
$resultado = '';

$Correio = new Correio($_POST);

if( $Correio->getCoFuncionarioRecebimento() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Funcionário não identificado!");
	echo json_encode($resultado);
	exit;
}
if( $Correio->getCoUnidade() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Unidade não identificada!");
	echo json_encode($resultado);
	exit;
}
if( $Correio->getCoTipoItemCorreio() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Tipo de correspondência não identificada!");
	echo json_encode($resultado);
	exit;
}
if( $Correio->getDsItem() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Número da correspondência não preenchida!");
	echo json_encode($resultado);
	exit;
}
if( $Correio->getDtHrChegada() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Data do recebimento não preenchido!");
	echo json_encode($resultado);
	exit;
}

$Correio->SetDtHrChegada(toolBox::formataDataHora($Correio->getDtHrChegada(),"G"));
$Correio->setDsItem((string) $Correio->getDsItem());