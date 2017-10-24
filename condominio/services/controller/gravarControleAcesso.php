<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Controller.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ControllerDAO.class.php');



$Controller = new Controller($_POST);
$ControllerDAO = new ControllerDAO();
$ControllerDAO->gravarControllerAcesso($Controller);

$resultado =  array("tipo" => "sucesso", "msg" => "Unidade salva com sucesso.", "id"=>$Controller->getCoTipoUsuario());

echo json_encode($resultado);
exit;
