<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/TipoUnidade.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TipoUnidadeDAO.class.php');

include('validarCadastro.php');
$TipoUnidadeDAO = new TipoUnidadeDAO;
$TipoUnidadeDAO->gravarTipoUnidade($TipoUnidade);

$resultado =  array("tipo" => "sucesso", "msg" => "Tipo de Unidade salva com sucesso.", "id" => $TipoUnidade->getCoTipoUnidade());

echo json_encode($resultado);
exit;
