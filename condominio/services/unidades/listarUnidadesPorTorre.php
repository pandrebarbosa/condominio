<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Unidade.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UnidadeDAO.class.php');

$Unidade = new Unidade($_POST);

$UnidadeDAO = new UnidadeDAO();

$res = $UnidadeDAO->listarUnidadeJSON($Unidade);

echo json_encode($res);