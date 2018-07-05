<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/CorreioDAO.class.php');

$CorreioDAO = new CorreioDAO();
$co_unidade = isset($_POST['co_unidade']) ? $_POST['co_unidade'] : '';

$resultado = $CorreioDAO->listarCorreioDisponivelPorMoradorJSON($co_unidade);

echo json_encode($resultado);
exit;
