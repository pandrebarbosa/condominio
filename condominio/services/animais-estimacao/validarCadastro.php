<?php
$resultado = '';

$AnimalDomestico = new AnimalDomestico($_POST);
$Raca = new Raca($_POST);

if( $AnimalDomestico->getCoUnidade() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Unidade não identificada!");
	echo json_encode($resultado);
	exit;
}
if( $AnimalDomestico->getCoTipoAnimal() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Tipo do animal de estimação não identificado!");
	echo json_encode($resultado);
	exit;
}
if( $AnimalDomestico->getDsNome() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Nome do animal de estimação não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Raca->getNoRaca() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Raça do animal de estimação não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $AnimalDomestico->getDsCor() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Cor do animal de estimação não preenchida!");
	echo json_encode($resultado);
	exit;
}

