<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Morador.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorDAO.class.php');

$Morador = new Morador($_POST);
$MoradorDAO = new MoradorDAO();

$res = $MoradorDAO->listarEmailMoradores($Morador->getCoUnidade());

echo json_encode($res);