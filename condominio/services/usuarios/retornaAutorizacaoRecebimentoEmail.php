<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/MoradorNotificacao.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorNotificacaoDAO.class.php');

$MoradorNotificacao = new MoradorNotificacao($_POST);
$MoradorNotificacaoDAO = new MoradorNotificacaoDAO();

$res = $MoradorNotificacaoDAO->notificacaoAutorizada($MoradorNotificacao);

if($res){
	$retorno = $res;
}else{
	$retorno = array(0=>array("st_deseja_receber" => 0));
}

echo json_encode($retorno);