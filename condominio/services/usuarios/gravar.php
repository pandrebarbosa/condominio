<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Usuario.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Pessoa.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Unidade.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/MoradorNotificacao.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UsuarioDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorNotificacaoDAO.class.php');

include('validarCadastro.php');

$UsuarioDAO = new UsuarioDAO();
$MoradorNotificacaoDAO = new MoradorNotificacaoDAO();

//Verifica se o usuário já existe.
$existe = $UsuarioDAO->listarUsuarioExistente($Usuario);

if($existe){
	$UsuarioDAO->gravarUsuario($Usuario);
	$MoradorNotificacaoDAO->gravarNotificacaoEmail($moradorNotificacao);
	$resultado =  array("tipo" => "success", "msg" => "Alteração salva com sucesso.", "id" => $Usuario->getCoPessoa());
}else{
	//Grava a senha inicial
	$Usuario->setDsSenha(md5("123456789"));
	$UsuarioDAO->gravarUsuario($Usuario);
	$resultado =  array("tipo" => "success", "msg" => "Usuário salvo com sucesso.", "id" => $Usuario->getCoPessoa());
}

echo json_encode($resultado);
exit;
