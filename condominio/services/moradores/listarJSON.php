<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "mo.st_ativo IS TRUE";
$txt_criterio = isset($_POST["criterio"]) ? $_POST["criterio"] : '';
if ($txt_criterio != "") {
    $criterio .= " AND (pe.no_pessoa like '%" . $txt_criterio . "%' OR concat(tr.no_torre,u.nu_numero) like '%" . $txt_criterio . "%')";
}

$pagina = isset ( $_POST ["pagina"] ) && $_POST ["pagina"] != "" ? $_POST ["pagina"] : 1;
$maximo = isset ( $_POST ["maximo"] ) ? $_POST ["maximo"] : null;

$campos = "concat(tr.no_torre,u.nu_numero) AS 'Torre / Unidade', tu.no_tipo_unidade AS 'Tipo de unidade', pe.no_pessoa AS 'Nome', pe.ds_foto AS 'Foto', mo.co_pessoa,u.co_unidade,tr.co_torre,u.nu_numero";
$tabelas = "tb_morador AS mo
			INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
			INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade
			INNER JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=mo.co_tipo_morador
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
			INNER JOIN tb_torre AS tr ON tr.co_torre=u.co_torre";

$resTotal = $banco->seleciona($tabelas,"count(mo.co_pessoa) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$total = $resTotal[0]['total'];
$array_total = array("total"=>$total);

$inicio = $pagina - 1;
$inicio = $maximo * $inicio;

$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", NULL, "pe.no_pessoa ASC", "$inicio,$maximo", FALSE);

///adidiona o total de registros no inicio do array
array_unshift($pedidos,$array_total);

echo json_encode($pedidos);