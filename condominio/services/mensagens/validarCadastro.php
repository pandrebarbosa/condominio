<?php
$resultado = '';

$Mensagem = new Mensagem($_POST);
$GrupoMensagem = new GrupoMensagem($_POST);
$Mensagem->setDsConteudo( addslashes($Mensagem->getDsConteudo()) );

if( $Mensagem->getDsTitulo() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Título não preenchido!");
	echo json_encode($resultado);
	exit;
}

if( $Mensagem->getDsConteudo() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Conteúdo não preenchido!");
	echo json_encode($resultado);
	exit;
}