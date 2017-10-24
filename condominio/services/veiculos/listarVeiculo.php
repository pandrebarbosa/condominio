<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Veiculo.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/VeiculoDAO.class.php');

$Veiculo = new Veiculo($_POST);
$VeiculoDAO = new VeiculoDAO();

$res = $VeiculoDAO->listarVeiculoJSON($Veiculo);

echo json_encode($res);