<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Pessoa.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/PessoaDAO.class.php');

$Pessoa = new Pessoa($_GET);
$PessoaDAO = new PessoaDAO();

$res = $PessoaDAO->listarPessoasProprietariosAutoCompleteJSON($Pessoa);

echo json_encode($res);