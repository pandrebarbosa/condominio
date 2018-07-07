<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include('validarCadastro.php');

$banco = new banco();

$banco->altera("tb_usuario","ds_login='$ds_login',ds_senha='$ds_senha'","co_pessoa=".$co_pessoa,FALSE);

$resultado =  array("tipo" => "success", "msg" => "Alteração salva com sucesso.");	

echo json_encode($resultado);
exit;
