<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "";
$txt_criterio = ($_POST["criterio"] != "null") ? $_POST["criterio"] : '';

if ($txt_criterio != "") {
    $criterio = "p.no_pessoa like '%" . $txt_criterio . "%' OR u.ds_login like '%" . $txt_criterio . "%'";
}

$pagina = isset ( $_POST ["pagina"] ) && $_POST ["pagina"] != "" ? $_POST ["pagina"] : 1;
$maximo = isset ( $_POST ["maximo"] ) ? $_POST ["maximo"] : null;

$campos = "co_mensagem, ds_titulo AS 'Título', DATE_FORMAT(dt_hr_registro,'%d/%m/%Y %H:%i') AS 'Data hora'";
$tabelas = "tb_mensagem";

$resTotal = $banco->seleciona($tabelas,"count(co_mensagem) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$totalDeRegistros = $resTotal[0]['total'];
$arrayTotalDeRegistros = array("total"=>$totalDeRegistros);

$inicio = $pagina - 1;
$inicio = $maximo * $inicio;

$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "co_mensagem", "dt_hr_registro DESC", "$inicio,$maximo", FALSE);

///adidiona o total de registros no inicio do array
array_unshift($pedidos,$arrayTotalDeRegistros);

echo json_encode($pedidos);