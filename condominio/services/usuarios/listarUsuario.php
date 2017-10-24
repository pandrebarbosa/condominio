<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Usuario.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UsuarioDAO.class.php');

$Usuario = new Usuario($_POST);
$UsuarioDAO = new UsuarioDAO();

$res = $UsuarioDAO->listarUsuarioJSON($Usuario);

echo json_encode($res);