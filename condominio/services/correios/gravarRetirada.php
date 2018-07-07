<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/RetiradaCorreio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/RetiradaCorreioDAO.class.php');

include('validarCadastroRetirada.php');

$RetiradaCorreioDAO = new RetiradaCorreioDAO();

$RetiradaCorreioDAO->gravarRetiradaCorreio($RetiradaCorreio);

$resultado =  array("tipo" => "success", "msg" => "Correspondência retirada com sucesso.");

echo json_encode($resultado);
exit;
