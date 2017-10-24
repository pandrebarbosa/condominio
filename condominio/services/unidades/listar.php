<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "u.st_ativo IS TRUE";
$txt_criterio = ($_POST["criterio"] != "null") ? $_POST["criterio"] : '';
if ($txt_criterio != "") {
    $criterio .= " AND (p.no_pessoa like '%" . $txt_criterio . "%' OR u.nu_numero = '" . $txt_criterio."')";
}

$co_tipo_unidade = null;
$txt_tipo_unidade = ($_POST["co_tipo_unidade"] != "null" ) ? $_POST["co_tipo_unidade"] : '';
if ($txt_tipo_unidade != "") {
	$co_tipo_unidade = "AND tu.co_tipo_unidade = " . $txt_tipo_unidade;
}

$pagina = isset ( $_POST ["pagina"] ) && $_POST ["pagina"] != "" ? $_POST ["pagina"] : 1;
$maximo = isset ( $_POST ["maximo"] ) ? $_POST ["maximo"] : null;

$campos = "u.nu_numero,tu.no_tipo_unidade AS 'Tipo',u.co_unidade,t.no_torre,
		   CONCAT('Torre ',t.no_torre,' - ',tu.no_tipo_unidade,': ',u.nu_numero)  AS 'Unidade',
		   COALESCE(p.no_pessoa,'Desocupado') AS 'Morador',p.co_pessoa";
$tabelas = "tb_unidade AS u
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade $co_tipo_unidade
			LEFT JOIN tb_torre AS t ON t.co_torre=u.co_torre
			LEFT JOIN tb_morador AS m ON m.co_unidade=u.co_unidade
			LEFT JOIN tb_pessoa AS p ON p.co_pessoa=m.co_pessoa
			LEFT JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=m.co_tipo_morador";

$resTotal = $banco->seleciona($tabelas, "count(u.nu_numero) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$totalDeRegistros = $resTotal[0]['total'];
$arrayTotalDeRegistros = array("total"=>$totalDeRegistros);
$pedidos=null;
if($totalDeRegistros > 0){
	$inicio = $pagina - 1;
	$inicio = $maximo * $inicio;
	
	$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "u.co_unidade", NULL, "$inicio,$maximo", FALSE);
	
	///adidiona o total de registros no inicio do array
	array_unshift($pedidos,$arrayTotalDeRegistros);
}
echo json_encode($pedidos);