<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/TipoVeiculo.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TipoVeiculoDAO.class.php');

$TipoVeiculo = new TipoVeiculo($_POST);
$TipoVeiculoDAO = new TipoVeiculoDAO();

$res = $TipoVeiculoDAO->listarTipoVeiculoJSON($TipoVeiculo);

echo json_encode($res);