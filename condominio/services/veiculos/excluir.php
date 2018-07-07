<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Veiculo.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/VeiculoDAO.class.php');

$Veiculo = new Veiculo($_POST);
$VeiculoDAO = new VeiculoDAO();

$VeiculoDAO->excluirVeiculo($Veiculo);
$resultado =  array("tipo" => "success", "msg" => "Exclusão feita com sucesso!");

echo json_encode($resultado);
exit;