<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Correio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/CorreioDAO.class.php');

$co_itemCorreio = $_POST['co_item_correio'];
$CorreioDAO = new CorreioDAO();

$resultado = $CorreioDAO->verificarSeCorrespondenciaFoiRetirada($co_itemCorreio);

echo json_encode($resultado);
exit;
