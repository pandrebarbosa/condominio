<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Unidade.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UnidadeDAO.class.php');

include('validarCadastro.php');

$UnidadeDAO = new UnidadeDAO();

$Unidade->setCoProprietario(null);
$Unidade->setDtAquisicao(date('Y-m-d'));
$Unidade->setStAtivo(true);

$UnidadeDAO->gravarUnidade($Unidade);

$resultado =  array("tipo" => "sucesso", "msg" => "Unidade salva com sucesso.", "id" => $Unidade->getCoUnidade());


echo json_encode($resultado);
exit;
