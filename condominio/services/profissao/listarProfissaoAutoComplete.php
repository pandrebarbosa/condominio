<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Profissao.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ProfissaoDAO.class.php');

$Profissao = new Profissao($_GET);
$ProfissaoDAO = new ProfissaoDAO();

$res = $ProfissaoDAO->listarProfissaoAutoCompleteJSON($Profissao);

echo json_encode($res);