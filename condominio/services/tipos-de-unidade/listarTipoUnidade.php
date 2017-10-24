<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/TipoUnidade.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TipoUnidadeDAO.class.php');

$TipoUnidade = new TipoUnidade($_POST);
$TipoUnidadeDAO = new TipoUnidadeDAO();

$res = $TipoUnidadeDAO->listarTipoUnidadeJSON($TipoUnidade);

echo json_encode($res);