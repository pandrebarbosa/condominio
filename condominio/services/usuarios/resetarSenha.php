<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Usuario.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UsuarioDAO.class.php');

$Usuario = new Usuario($_POST);
$Usuario->setCoPessoaRegistro($_SESSION['credencial']['co_pessoa']);

$UsuarioDAO = new UsuarioDAO();

$UsuarioDAO->resetarSenha($Usuario);

$destinatario = $UsuarioDAO->listarUsuarioJSON($Usuario);

$enviou = Email::emailResetarSenha($destinatario[0]['ds_email']);

$resultado = "";
if($enviou){
    $resultado =  array("tipo" => "success",
        "msg" => "Senha alterada com sucesso. Usuário alertado por email.");
}else{
    $resultado =  array("tipo" => "success",
        "msg" => "Senha alterada com sucesso. Não houve envio de email por erro desconhecido.");
}

echo json_encode($resultado);
exit;
