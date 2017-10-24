<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Turno.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TurnoDAO.class.php');

$Turno = new Turno(null);
$TurnoDAO = new TurnoDAO();

$res = $TurnoDAO->listarTurnoJSON($Turno);

echo json_encode($res);