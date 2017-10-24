<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Unidade.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UnidadeDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Morador.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorDAO.class.php');

$Morador = new Morador($_POST);

include('validarCadastro.php');

$UnidadeDAO = new UnidadeDAO();
$MoradorDAO = new MoradorDAO();

$res_prop = $MoradorDAO->existeMorador($Morador);

if(!$res_prop){
	$MoradorDAO->gravarMorador($Morador);
	$UnidadeDAO->gravarUnidade($Unidade);
	$resultado =  array("tipo" => "sucesso", "msg" => "Unidade cadastrada com sucesso.");
}else{
	$resultado =  array("tipo" => "erro", "msg" => "Unidade já possui proprietário cadastrado. Procure o administrador do sistema.");
}

echo json_encode($resultado);
exit;
