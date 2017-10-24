<?php
$resultado = '';

$Pessoa = new Pessoa($_POST);
$Funcionario = new Funcionario($_POST);

$Funcionario->setDtEntrada(toolBox::formataData($Funcionario->getDtEntrada(),"G"));
$Funcionario->setDtSaida(toolBox::formataData($Funcionario->getDtSaida(),"G"));

if( $Pessoa->getNuCpf() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "CPF não preenchido!");
	echo json_encode($resultado);
	exit;
}

if( $Pessoa->getNoPessoa() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Nome não preenchido!");
	echo json_encode($resultado);
	exit;
}

if( $Pessoa->getDtNascimento() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Nascimento não preenchido!");
	echo json_encode($resultado);
	exit;
}

if( $Funcionario->getCoCargoFuncionario() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Nascimento não preenchido!");
	echo json_encode($resultado);
	exit;
}

if( $Funcionario->getNoEmpresaContratante() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Nascimento não preenchido!");
	echo json_encode($resultado);
	exit;
}

if( $Funcionario->getDtEntrada() == null ){
	$resultado =  array("id" => null, "tipo" => "erro", "msg" => "Data de início no condomínio não preenchida!");
	echo json_encode($resultado);
	exit;
}
$Pessoa->setNuCpf( toolBox::removeFormatacaoCpfCNpj($Pessoa->getNuCpf(), "PF") );
$Pessoa->setDtNascimento( toolBox::formataData($Pessoa->getDtNascimento(), "G") );