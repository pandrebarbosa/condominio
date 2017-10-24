<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Veiculo.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/ModeloVeiculo.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/VeiculoDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ModeloVeiculoDAO.class.php');

include('validarCadastro.php');

$VeiculoDAO = new VeiculoDAO();
$ModeloVeiculoDAO = new ModeloVeiculoDAO();

if( $Veiculo->getCoModeloVeiculo() == NULL && $ModeloVeiculo->getNoModeloVeiculo() != NULL ){
	$ModeloVeiculoDAO->gravarModeloVeiculo($ModeloVeiculo);
	$Veiculo->setCoModeloVeiculo($ModeloVeiculo->getCoModeloVeiculo());
}	
$VeiculoDAO->gravarVeiculo($Veiculo);
$resultado =  array("tipo" => "sucesso", "msg" => "Veículo salvo com sucesso.");

echo json_encode($resultado);
exit;
