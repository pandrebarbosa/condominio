<?php
$resultado = '';
$co_pessoa = isset($_POST['co_pessoa']) ? $_POST['co_pessoa'] : '';
$ds_login = isset($_POST['ds_login']) ? $_POST['ds_login'] : '';
$ds_senha = isset($_POST['ds_senha']) ? md5($_POST['ds_senha']) : '';

if( empty( $co_pessoa )){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Usuário não identificado!");
	echo json_encode($resultado);
	exit;
}
if( empty( $ds_login )){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "O login não pode ficar em branco!");
	echo json_encode($resultado);
	exit;
}
if( empty( $ds_senha )){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "A senha não pode ficar em branco!");
	echo json_encode($resultado);
	exit;
}