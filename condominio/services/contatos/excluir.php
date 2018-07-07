<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Contato.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ContatoDAO.class.php');

$Contato = new Contato($_POST);
$ContatoDAO = new ContatoDAO();

$ContatoDAO->excluirContato($Contato);
$resultado =  array("id"=> $Contato->getCoPessoa(), "tipo" => "success", "msg" => "Exclusão feita com sucesso!");

echo json_encode($resultado);
exit;