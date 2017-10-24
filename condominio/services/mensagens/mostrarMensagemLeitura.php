<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MensagemDAO.class.php');

$MensagemDAO = new MensagemDAO();
$co_mensagem = isset($_POST['co_mensagem']) ? $_POST['co_mensagem'] : '';
$res = $MensagemDAO->carregarMensagem($co_mensagem);

echo json_encode($res);