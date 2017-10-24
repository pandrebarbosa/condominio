<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/VeiculoDAO.class.php');

$VeiculoDAO = new VeiculoDAO();

$res = $VeiculoDAO->listarQuantidadeVeiculoJSON();

echo json_encode($res);