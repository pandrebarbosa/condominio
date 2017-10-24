<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Controller.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ControllerDAO.class.php');

$co_tipo_usuario = ($_POST["co_tipo_usuario"] != "null") ? $_POST["co_tipo_usuario"] : '';

$ControllerDAO = new ControllerDAO();

$res = $ControllerDAO->listarControllerDisponivelPorTipoUsuario($co_tipo_usuario);

echo json_encode($res);