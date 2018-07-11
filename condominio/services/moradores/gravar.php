<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Pessoa.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Morador.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Profissao.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Unidade.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/PessoaDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/ProfissaoDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UnidadeDAO.class.php');

include('validarCadastro.php');

$PessoaDAO = new PessoaDAO();
$MoradorDAO = new MoradorDAO();
$ProfissaoDAO = new ProfissaoDAO();
$UnidadeDAO = new UnidadeDAO();


if( $Morador->getCoProfissao() == NULL && $Profissao->getNoProfissao() != NULL){
	$ProfissaoDAO->gravarProfissao($Profissao);
	$Morador->setCoProfissao( $Profissao->getCoProfissao() );
}

$Pessoa->setNuCpf( toolBox::removeFormatacaoCpfCNpj($Pessoa->getNuCpf(), "PF") );
$Pessoa->setDtNascimento( toolBox::formataData($Pessoa->getDtNascimento(), "G") );
$Morador->setDtInicio( toolBox::formataData($Morador->getDtInicio(), "G") );

$PessoaDAO->gravarPessoa($Pessoa);
$Morador->setCoPessoa($Pessoa->getCoPessoa());
$MoradorDAO->gravarMorador($Morador);
$resultado =  array("tipo" => "success", "id" => $Morador->getCoPessoa(), "msg" => "Morador salva com sucesso.");

/**
 * Se for proprietário do imovel, cadastrar como tal.
 
if( $Morador->getCoTipoMorador() == 1){
	$UnidadeDAO->gravarUnidade($Unidade);
}*/
echo json_encode($resultado);
exit;
