<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Mensagem.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/GrupoMensagem.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MensagemDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/GrupoMensagemDAO.class.php');

include('validarCadastro.php');

$MensagemDAO = new MensagemDAO();
$GrupoMensagemDAO = new GrupoMensagemDAO();

if($_POST['enviar_agora'] == 'true' || $_POST['enviar_agora'] === true){
	$Mensagem->setDtHrEnvio("NOW()");
	$MensagemDAO->gravarMensagem($Mensagem);
	
	$res = $GrupoMensagemDAO->listarGrupo($GrupoMensagem);
	$metodo = $res[0]['no_metodo'];
	$MensagemDAO->$metodo($Mensagem);
	$resultado =  array("tipo" => "sucesso", "msg" => "Gravação e envio com sucesso.", "id"=>$Mensagem->getCoMensagem());
}else{
	$Mensagem->setDtHrEnvio(null);
	$MensagemDAO->gravarMensagem($Mensagem);
	$resultado =  array("tipo" => "sucesso", "msg" => "Gravação com sucesso.", "id"=>$Mensagem->getCoMensagem());
}

echo json_encode($resultado);
exit;
