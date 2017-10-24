<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Contato.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ContatoDAO.class.php');

include('validarCadastro.php');

$ContatoDAO = new ContatoDAO();

$ContatoDAO->gravarContato($Contato);

$resultado =  array("id"=>$Contato->getCoPessoa(), "tipo" => "sucesso", "msg" => "Contato salvo com sucesso.");

echo json_encode($resultado);
exit;
