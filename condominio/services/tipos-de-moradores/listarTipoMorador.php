<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/TipoMorador.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TipoMoradorDAO.class.php');

$TipoMorador = new TipoMorador($_POST);
$TipoMoradorDAO = new TipoMoradorDAO();

$res = $TipoMoradorDAO->listarTipoMoradorJSON($TipoMorador);

echo json_encode($res);