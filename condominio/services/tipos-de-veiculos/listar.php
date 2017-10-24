<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "";
$txt_criterio = ($_POST["criterio"] != "null") ? $_POST["criterio"] : '';
if ($txt_criterio != "") {
    $criterio = "no_tipo_morador like '%" . $txt_criterio . "%'";
}

$pagina = isset ( $_POST ["pagina"] ) && $_POST ["pagina"] != "" ? $_POST ["pagina"] : 1;
$maximo = isset ( $_POST ["maximo"] ) ? $_POST ["maximo"] : null;

$campos = "co_tipo_morador, no_tipo_morador AS 'Tipo'";
$tabelas = "tb_tipo_morador";
$resTotal = $banco->seleciona($tabelas, "count(co_tipo_morador) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$totalDeRegistros = $resTotal[0]['total'];
$arrayTotalDeRegistros = array("total"=>$totalDeRegistros);
$pedidos=null;
if($totalDeRegistros > 0){
	$inicio = $pagina - 1;
	$inicio = $maximo * $inicio;
	
	$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", NULL, "co_tipo_morador DESC", "$inicio,$maximo", FALSE);

	///adidiona o total de registros no inicio do array
	array_unshift($pedidos,$arrayTotalDeRegistros);
}

echo json_encode($pedidos);