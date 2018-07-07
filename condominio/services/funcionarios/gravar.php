<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Pessoa.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/PessoaDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Funcionario.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/TurnoFuncionario.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/FuncionarioDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TurnoDAO.class.php');

include('validarCadastro.php');

$PessoaDAO = new PessoaDAO();
$FuncionarioDAO = new FuncionarioDAO();
$TurnoDAO = new TurnoDAO();

$turnos =  isset($_POST['turnos']) ? $_POST['turnos'] : null;
$turnosArr = Array();
if($turnos){
	foreach($turnos AS $key=>$val){
		$TurnoFuncionario = new TurnoFuncionario();
		$TurnoFuncionario->setCoTurno($val);
		$TurnoFuncionario->setCoPessoa($Pessoa->getCoPessoa());
		$TurnoFuncionario->setDtHrRegistro("NOW()");
		$turnosArr[] = $TurnoFuncionario;
	}
	$TurnoDAO->gravarTurnoFuncionario($turnosArr);
}else{
	$TurnoDAO->apagarTurnoFuncionarios($Pessoa->getCoPessoa());
}

if( $Funcionario->getCoPessoa() == null ){
	// Pergunta se já existe a pessoa. Caso exista, carrega o objeto.
	$existeaPessoa = $PessoaDAO->listarPessoaExistente($Pessoa);
	if(!$existeaPessoa){
		//Se não existir, grava ela e carrega o objeto
		$PessoaDAO->gravarPessoa($Pessoa);
	}
	
	//Carregar o objeto Usuario com co_pessoa
	$Funcionario->setCoPessoa($Pessoa->getCoPessoa());
	
	$FuncionarioDAO->gravarFuncionario($Funcionario);
	$resultado =  array("tipo" => "success", "msg" => "Funcionário <em>". $Pessoa->getNoPessoa() ."</em> salvo com sucesso.", "id" => $Pessoa->getCoPessoa());

}else{

	$PessoaDAO->gravarPessoa($Pessoa);
	$FuncionarioDAO->gravarFuncionario($Funcionario);
	
	$resultado =  array("tipo" => "success", "msg" => "Alteração salva com sucesso.", "id" => $Pessoa->getCoPessoa());
	
}

echo json_encode($resultado);
exit;
