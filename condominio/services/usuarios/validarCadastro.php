<?php
$resultado = '';

$Usuario = new Usuario($_POST);
$Unidade = new Unidade($_POST);
$Pessoa  = new Pessoa($_POST);
$moradorNotificacao  = new MoradorNotificacao($_POST);

if( $Usuario->getCoTipoUsuario() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Tipo de usuário não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Usuario->getCoPessoa() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Usuário não selecionado!");
	echo json_encode($resultado);
	exit;
}
if( $Usuario->getDsEmail() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Email não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Usuario->getDsLogin()== null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Login do usuário não preenchido!");
	echo json_encode($resultado);
	exit;
}