<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$co_torre = isset($_POST['co_torre']) ? $_POST['co_torre'] : '';
$nu_numero = isset($_POST['nu_numero']) ? $_POST['nu_numero'] : '';
$co_tipo_unidade = isset($_POST['co_tipo_unidade']) ? $_POST['co_tipo_unidade'] : '';
$co_pessoa = isset($_POST['co_pessoa']) ? $_POST['co_pessoa'] : '';

$banco = new banco();
$res = $banco->altera("tb_morador","st_ativo=false","co_pessoa=".$co_pessoa." AND nu_numero=".$nu_numero." AND co_tipo_unidade=".$co_tipo_unidade." AND co_torre=".$co_torre,FALSE);
	
$resultado =  array("tipo" => "sucesso", "msg" => "Exclusão feita com sucesso!");

echo json_encode($resultado);
exit;
