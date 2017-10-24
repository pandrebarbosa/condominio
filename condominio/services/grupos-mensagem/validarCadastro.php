<?php
$resultado = '';

$GrupoMensagem = new GrupoMensagem($_POST);

if( $GrupoMensagem->getNoGrupo() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Nome não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $GrupoMensagem->getDsDescricao() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Descrição não preenchida!");
	echo json_encode($resultado);
	exit;
}
if( $GrupoMensagem->getNoMetodo() == NULL ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Método PHP não preenchido!");
	echo json_encode($resultado);
	exit;
}