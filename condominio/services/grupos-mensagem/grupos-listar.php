<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "";
$txt_criterio = ($_POST["criterio"] != "null") ? $_POST["criterio"] : '';
if ($txt_criterio != "") {
	$criterio .= " no_grupo like '%" . $txt_criterio . "%' OR ds_descricao = '%" . $txt_criterio . "%')";
}

$pagina = isset ( $_POST ["pagina"] ) && $_POST ["pagina"] != "" ? $_POST ["pagina"] : 1;
$maximo = isset ( $_POST ["maximo"] ) ? $_POST ["maximo"] : null;

$campos = "co_grupo, no_grupo AS 'Nome', ds_descricao AS 'Descrição', no_metodo AS 'Método PHP'";
$tabelas = "tb_grupo_mensagem";

$resTotal = $banco->seleciona($tabelas, "count(co_grupo) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$totalDeRegistros = $resTotal[0]['total'];
$arrayTotalDeRegistros = array("total"=>$totalDeRegistros);
$pedidos=null;
if($totalDeRegistros > 0){
	$inicio = $pagina - 1;
	$inicio = $maximo * $inicio;

	$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "co_grupo DESC", NULL, "$inicio,$maximo", FALSE);

	///adidiona o total de registros no inicio do array
	array_unshift($pedidos,$arrayTotalDeRegistros);
}
echo json_encode($pedidos);