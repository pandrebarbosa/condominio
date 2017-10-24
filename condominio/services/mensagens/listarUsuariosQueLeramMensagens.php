<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MensagemDAO.class.php');

$MensagemDAO = new MensagemDAO();

$res = $MensagemDAO->listarTodasMensagensComRegLeitura();

echo json_encode($res);