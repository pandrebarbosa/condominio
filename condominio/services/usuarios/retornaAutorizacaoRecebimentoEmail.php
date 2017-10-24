<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/RecebimentoEmail.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/RecebimentoEmailDAO.class.php');

$RecebimentoEmail = new RecebimentoEmail($_POST);
$RecebimentoEmailDAO = new RecebimentoEmailDAO();

$res = $RecebimentoEmailDAO->retornaAutorizacaoRecebimentoEmail($RecebimentoEmail);

if($res){
	$retorno = $res;
}else{
	$retorno = array(0=>array("st_deseja_receber" => 0));
}

echo json_encode($retorno);