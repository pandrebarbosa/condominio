<?php
$pathAbsolute = realpath(dirname(dirname(__FILE__)))."/lib";

require_once($pathAbsolute . '/Email.class.php');

$resultado = '';
$ds_email = isset($_POST['ds_email']) ? $_POST['ds_email'] : '';
$no_pessoa = isset($_POST['no_pessoa']) ? $_POST['no_pessoa'] : '';
$ds_unidade = isset($_POST['ds_unidade']) ? $_POST['ds_unidade'] : '';

if( empty( $no_pessoa )){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Nome do usuário não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( empty( $ds_email )){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Email não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( empty( $ds_unidade )){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Campo unidade(s) não preenchido!");
	echo json_encode($resultado);
	exit;
}

$email = Email::emailNovoUsuario($no_pessoa,$ds_email,$ds_unidade);

if($email){
	$resultado =  array("tipo" => "success", "msg" => "Solicitação enviada com sucesso. Aguarde instruções por email.");
}else{
	$resultado =  array("tipo" => "danger", "msg" => "Erro ao enviar email.");
}

echo json_encode($resultado);
exit;
