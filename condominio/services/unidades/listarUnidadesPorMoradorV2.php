<?php
$ambiente = ($_POST["ambiente"] != "null") ? $_POST["ambiente"] : '';
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa-app.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UnidadeDAO.class.php');

$UnidadeDAO = new UnidadeDAO();
$co_morador = ($_POST["co_morador"] != "null") ? $_POST["co_morador"] : '';

$res = $UnidadeDAO->listarUnidadesPorMoradorJSON($co_morador);

echo json_encode($res);
exit;