<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/MoradorNotificacao.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorNotificacaoDAO.class.php');

//print_r($_POST);exit;

$MoradorNotificacao = new MoradorNotificacao($_POST);
$MoradorNotificacaoDAO = new MoradorNotificacaoDAO();

$MoradorNotificacaoDAO->gravarNotificacaoEmail($MoradorNotificacao);

$resultado =  array("id"=>null, "tipo" => "success", "msg" => "Salvo com sucesso.");

echo json_encode($resultado);
