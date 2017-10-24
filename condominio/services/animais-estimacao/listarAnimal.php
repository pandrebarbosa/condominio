<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/AnimalDomestico.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/AnimalDomesticoDAO.class.php');

$AnimalDomestico = new AnimalDomestico($_POST);

$AnimalDomesticoDAO = new AnimalDomesticoDAO();

$res_animal = $AnimalDomesticoDAO->listarAnimalDomesticoJSON($AnimalDomestico);

echo json_encode($res_animal);