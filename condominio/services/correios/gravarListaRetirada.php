<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/RetiradaCorreio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Pessoa.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/RetiradaCorreioDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorDAO.class.php');

$co_funcionario_retirada = $_POST['co_funcionario_retirada'];
$ds_observacao = $_POST['ds_observacao'];
$cpf = $_POST['cpf'];

//verifica nulidades
$resultado = '';
if( $co_funcionario_retirada == null ){
    $resultado =  array("id" => null, "tipo" => "danger", "msg" => "Funcionário não identificado!");
    echo json_encode($resultado);
    exit;
}
if( $ds_observacao == null ){
    $resultado =  array("id" => null, "tipo" => "danger", "msg" => "Digite um comentário sobre a entrega!");
    echo json_encode($resultado);
    exit;
}
if( $cpf == null ){
    $resultado =  array("id" => null, "tipo" => "danger", "msg" => "CPF não identificado!");
    echo json_encode($resultado);
    exit;
}


//verifica se existe o morador com o cpf informado
$MoradorDAO = new MoradorDAO();
$pessoaRes = $MoradorDAO->listarMoradorPorCPFJSON($cpf);
if(!$pessoaRes){
    $resultado =  array("id" => null, "tipo" => "danger", "msg" => "Morador não identificado!<br />Verifique se o morador está cadastrado no sistema e  tente novamente.");
    echo json_encode($resultado);
    exit;
}

$RetiradaCorreioDAO = new RetiradaCorreioDAO();

//monta array de retiradas
$arrayRetirada = array();
$arrayNaoRetirada = array();
foreach(json_decode($_POST['listaRetirada']) as $key => $val){
    $RetiradaCorreio = new RetiradaCorreio();
    $RetiradaCorreio->setCoItemCorreio($val->id);
    $RetiradaCorreio->setCoFuncionarioRetirada($co_funcionario_retirada);
    $RetiradaCorreio->setCoPessoaRetirada($pessoaRes[0]['co_pessoa']);
    $RetiradaCorreio->setCoUnidadeRetirada($pessoaRes[0]['co_unidade']);
    $RetiradaCorreio->setDsObservacao($ds_observacao);
    $RetiradaCorreio->setDtHrRetirada(toolBox::formataDataHora(date("d/m/Y H:i"),"G"));
    $RetiradaCorreio->setDtHrRegistro("CURRENT_TIMESTAMP");
    
    $jaRetirou = $RetiradaCorreioDAO->listaRetiradaCorreio($RetiradaCorreio);    
    if(!$jaRetirou){
        $arrayRetirada[$key] = $RetiradaCorreio;
    }else{
        $arrayNaoRetirada[$key] = $RetiradaCorreio;
    }
}

$RetiradaCorreioDAO->gravarListaRetiradaCorreio($arrayRetirada);
$qtdRetiradas = count($arrayRetirada);
$qtdNaoRetiradas = count($arrayNaoRetirada);

if($qtdRetiradas > 0 && $qtdNaoRetiradas == 0){
    $resultado =  array("tipo" => "success",
        "msg" => "{$qtdRetiradas} Correspondência(s) retirada(s) com sucesso.");
}elseif($qtdRetiradas == 0 && $qtdNaoRetiradas > 0){
    $resultado =  array("tipo" => "warning",
        "msg" => "Nenhuma correspondência foi entregue. Todas já haviam sido retirada(s) anteriormente.");
}elseif($qtdRetiradas > 0 && $qtdNaoRetiradas > 0){
    $resultado =  array("tipo" => "info",
        "msg" => "{$qtdRetiradas} Correspondência(s) retirada(s) com sucesso. <br />{$qtdNaoRetiradas} Correspondência(s) já haviam sido retirada(s).");
}

echo json_encode($resultado);
exit;
