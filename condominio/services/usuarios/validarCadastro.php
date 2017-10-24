<?php
$resultado = '';

$Usuario = new Usuario($_POST);
$Unidade = new Unidade($_POST);
$Pessoa  = new Pessoa($_POST);
$moradorNotificacao  = new MoradorNotificacao($_POST);

if( $Usuario->getCoTipoUsuario() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Tipo de usuário não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Usuario->getCoPessoa() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Usuário não selecionado!");
	echo json_encode($resultado);
	exit;
}
if( $Usuario->getDsEmail() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Email não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Usuario->getDsLogin()== null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Login do usuário não preenchido!");
	echo json_encode($resultado);
	exit;
}