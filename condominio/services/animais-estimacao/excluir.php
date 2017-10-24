<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$co_unidade = isset($_POST['co_unidade']) ? $_POST['co_unidade'] : '';
$co_animal = isset($_POST['co_animal']) ? $_POST['co_animal'] : '';

$banco = new banco();
$res = $banco->altera("tb_animal_domestico","st_ativo=false,dt_hr_registro=NOW()","co_animal_domestico=".$co_animal." AND co_unidade=".$co_unidade,FALSE);
	
$resultado =  array("tipo" => "sucesso", "msg" => "Exclusão feita com sucesso!");

echo json_encode($resultado);
exit;
