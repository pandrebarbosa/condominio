<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Raca.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/RacaDAO.class.php');

$Raca = new Raca($_GET);
$RacaDAO = new RacaDAO();

$res = $RacaDAO->listarRacaAutoCompleteJSON($Raca);

echo json_encode($res);