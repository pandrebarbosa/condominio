<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/MoradorNotificacao.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorNotificacaoDAO.class.php');

$moradorNotificacao = new MoradorNotificacao($_POST);
$MoradorNotificacaoDAO = new MoradorNotificacaoDAO();

$res = $MoradorNotificacaoDAO->notificacaoAutorizada($moradorNotificacao);

$resposta = ($res=="" ? false : true);

echo json_encode($resposta);