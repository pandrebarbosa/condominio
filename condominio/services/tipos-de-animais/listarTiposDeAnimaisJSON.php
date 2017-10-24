<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/TipoAnimal.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TipoAnimalDAO.class.php');

$TipoAnimal = new TipoAnimal($_POST);
$TipoAnimalDAO = new TipoAnimalDAO();

$res = $TipoAnimalDAO->listarTipoAnimalJSON($TipoAnimal);

echo json_encode($res);