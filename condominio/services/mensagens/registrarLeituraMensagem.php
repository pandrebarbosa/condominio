<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/LeituraMensagem.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MensagemDAO.class.php');

$LeituraMensagem = new LeituraMensagem($_POST);
$MensagemDAO = new MensagemDAO();

$MensagemDAO->registrarLeituraMensagem($LeituraMensagem);