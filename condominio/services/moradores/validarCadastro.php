<?php
$resultado = '';

$Pessoa = new Pessoa($_POST);
$Morador = new Morador($_POST);
$Profissao = new Profissao($_POST);
$Unidade = new Unidade($_POST);

if( $Morador->getCoUnidade() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Unidade não identificada!");
	echo json_encode($resultado);
	exit;
}
if( $Morador->getCoTipoMorador() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Tipo de morador não identificado!");
	echo json_encode($resultado);
	exit;
}
if( $Morador->getDtInicio() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Data de início não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $Pessoa->getNoPessoa() == NULL ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Nome do morador não preenchido!");
	echo json_encode($resultado);
	exit;
}
//Obrigar o preenchimento do CPF somente para Moradorou Proprietário
if( $Morador->getCoTipoMorador()==1 || $Morador->getCoTipoMorador()==4 ){
	if ($Pessoa->getNuCpf() == "" ||
        $Pessoa->getNuCpf() == "00000000000" ||
        $Pessoa->getNuCpf() == "11111111111" ||
        $Pessoa->getNuCpf() == "22222222222" ||
        $Pessoa->getNuCpf() == "33333333333" ||
        $Pessoa->getNuCpf() == "44444444444" ||
        $Pessoa->getNuCpf() == "55555555555" ||
        $Pessoa->getNuCpf() == "66666666666" ||
        $Pessoa->getNuCpf() == "77777777777" ||
        $Pessoa->getNuCpf() == "88888888888" ||
        $Pessoa->getNuCpf() == "99999999999") {
		$resultado =  array("id" => null, "tipo" => "danger", "msg" => "CPF do <b>proprietário ou locatário</b> inválido!");
		echo json_encode($resultado);
		exit;
	}
}