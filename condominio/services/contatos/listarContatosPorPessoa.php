<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Contato.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ContatoDAO.class.php');

$Contato= new Contato($_POST);
$ContatoDAO = new ContatoDAO();

$res = $ContatoDAO->listarContatoJSON($Contato);

echo json_encode($res);