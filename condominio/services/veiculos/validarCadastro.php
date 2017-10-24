<?php
$resultado = '';

$Veiculo = new Veiculo($_POST);
$ModeloVeiculo = new ModeloVeiculo($_POST);

if( $Veiculo->getCoUnidade() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Unidade não identificada!");
	echo json_encode($resultado);
	exit;
}
if( $Veiculo->getCoTipoVeiculo() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Tipo de veículo não identificado!");
	echo json_encode($resultado);
	exit;
}
if( $ModeloVeiculo->getNoModeloVeiculo() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Nome/modelo do veículo não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Veiculo->getDsPlaca() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Placa do veículo não preenchida!");
	echo json_encode($resultado);
	exit;
}
if( $Veiculo->getCoVaga() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Vaga não preenchida!");
	echo json_encode($resultado);
	exit;
}
if( $Veiculo->getDsCor() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Cor do veículo não preenchida!");
	echo json_encode($resultado);
	exit;
}