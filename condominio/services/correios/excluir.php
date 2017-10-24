<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Correio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/CorreioDAO.class.php');

$Correio = new Correio($_POST);
$CorreioDAO = new CorreioDAO();

$CorreioDAO->excluirCorresnpodencia($Correio);
$resultado =  array("id"=> $Correio->getCoItemCorreio(), "tipo" => "sucesso", "msg" => "Exclusão feita com sucesso!");

echo json_encode($resultado);
exit;