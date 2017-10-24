<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/EnvioEmailDAO.class.php');

$EnvioEmailDAO = new EnvioEmailDAO();

$res = $EnvioEmailDAO->listarAutorizacoesDeEmail();

echo json_encode($res);