<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/ModeloVeiculo.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ModeloVeiculoDAO.class.php');

$ModeloVeiculo = new ModeloVeiculo($_GET);
$ModeloVeiculoDAO = new ModeloVeiculoDAO();

$res = $ModeloVeiculoDAO->listarModeloVeiculoAutoCompleteJSON($ModeloVeiculo);

echo json_encode($res);