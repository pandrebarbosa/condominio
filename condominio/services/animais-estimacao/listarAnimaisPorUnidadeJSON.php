<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/AnimalDomesticoDAO.class.php');

$AnimalDomesticoDAO = new AnimalDomesticoDAO();

$co_unidade = isset($_POST["co_unidade"]) ? $_POST["co_unidade"] : '';

$res = $AnimalDomesticoDAO->listarAnimaisPorUnidadeJSON($co_unidade);

echo json_encode($res);
exit;