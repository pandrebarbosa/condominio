<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/TipoMorador.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TipoMoradorDAO.class.php');

include('validarCadastro.php');
$TipoMoradorDAO = new TipoMoradorDAO;
$TipoMoradorDAO->gravarTipoUnidade($TipoMorador);

$resultado =  array("tipo" => "success", "msg" => "Tipo de morador salvo com sucesso.", "id" => $TipoMorador->getCoTipoMorador());

echo json_encode($resultado);
exit;
