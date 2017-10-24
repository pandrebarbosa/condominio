<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Controller.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ControllerDAO.class.php');

$Controller = new Controller($_POST);
$ControllerDAO = new ControllerDAO();

$res = $ControllerDAO->listarControllerJSON($Controller);

echo json_encode($res);