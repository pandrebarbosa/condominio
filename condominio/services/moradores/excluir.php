<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$co_unidade = isset($_POST['co_unidade']) ? $_POST['co_unidade'] : '';
$co_pessoa = isset($_POST['co_pessoa']) ? $_POST['co_pessoa'] : '';

$banco = new banco();
$res = $banco->altera("tb_morador","st_ativo=false,dt_hr_registro=NOW()","co_pessoa=".$co_pessoa." AND co_unidade=".$co_unidade,FALSE);
	
$resultado =  array("tipo" => "success", "msg" => "Exclusão feita com sucesso!");

echo json_encode($resultado);
exit;
