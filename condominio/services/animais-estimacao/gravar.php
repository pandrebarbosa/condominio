<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/AnimalDomestico.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/AnimalDomesticoDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Raca.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/RacaDAO.class.php');

include('validarCadastro.php');

$AnimalDomesticoDAO = new AnimalDomesticoDAO();
$RacaDAO = new RacaDAO();

if($AnimalDomestico->getCoRaca() == null && $Raca->getNoRaca() != null){
	$RacaDAO->gravarRaca($Raca);
	$AnimalDomestico->setCoRaca($Raca->getCoRaca());
}

$AnimalDomesticoDAO->gravarAnimalDomestico($AnimalDomestico);
$resultado =  array("tipo" => "sucesso", "msg" => "Animal doméstico salvo com sucesso.");

echo json_encode($resultado);
exit;
