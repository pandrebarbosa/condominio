<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Controller.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ControllerDAO.class.php');

include('validarCadastro.php');
$ControllerDAO = new ControllerDAO;
$ControllerDAO->gravarController($Controller);

$resultado =  array("tipo" => "sucesso", "msg" => "Unidade salva com sucesso.", "id" => $Controller->getCoController());

echo json_encode($resultado);
exit;
