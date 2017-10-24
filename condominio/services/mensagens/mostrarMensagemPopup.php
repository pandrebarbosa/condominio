<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MensagemDAO.class.php');

$MensagemDAO = new MensagemDAO();
$co_pessoa = isset($_POST['co_pessoa']) ? $_POST['co_pessoa'] : '';

$res = false;
if($MensagemDAO->verificarSeHaMensagemDisponivel($co_pessoa)){
	$res = $MensagemDAO->listarMensagemDisponivel($co_pessoa);
}
echo json_encode($res);