<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorDAO.class.php');

$co_unidade = isset($_POST["co_unidade"]) ? $_POST["co_unidade"] : '';

$MoradorDAO = new MoradorDAO();
$res = $MoradorDAO->listarMoradoresPorUnidadeNaoUsuariosJSON($co_unidade);

echo json_encode($res);
exit;