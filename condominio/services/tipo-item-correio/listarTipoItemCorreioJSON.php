<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TipoItemCorreioDAO.class.php');

$TipoItemCorreioDAO = new TipoItemCorreioDAO();

$res = $TipoItemCorreioDAO->listarTipoItemJSON();

echo json_encode($res);