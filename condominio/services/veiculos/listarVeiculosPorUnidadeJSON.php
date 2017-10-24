<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/VeiculoDAO.class.php');

$co_unidade = isset($_POST["co_unidade"]) ? $_POST["co_unidade"] : '';

$VeiculoDAO = new VeiculoDAO();
$res = $VeiculoDAO->listarVeiculosPorUnidadeJSON($co_unidade);

echo json_encode($res);
exit;
