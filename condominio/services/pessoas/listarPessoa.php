<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Pessoa.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/PessoaDAO.class.php');

$Pessoa = new Pessoa($_POST);
$PessoaDAO = new PessoaDAO();

$Pessoa->setNuCpf( toolBox::removeFormatacaoCpfCNpj($Pessoa->getNuCpf(), "PF"));

$res_pessoa=$PessoaDAO->listarPessoaJSON($Pessoa);

echo json_encode($res_pessoa);