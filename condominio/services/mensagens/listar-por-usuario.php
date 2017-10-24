<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "";
$txt_criterio = ($_POST["criterio"] != "null") ? $_POST["criterio"] : '';
$co_pessoa = ($_POST["co_pessoa"] != "null") ? $_POST["co_pessoa"] : '';

if ($txt_criterio != "") {
    $criterio = "p.no_pessoa like '%" . $txt_criterio . "%' OR u.ds_login like '%" . $txt_criterio . "%'";
}

$pagina = isset ( $_POST ["pagina"] ) && $_POST ["pagina"] != "" ? $_POST ["pagina"] : 1;
$maximo = isset ( $_POST ["maximo"] ) ? $_POST ["maximo"] : null;

$campos = "m.co_mensagem,m.ds_titulo AS 'Título',m.ds_titulo, DATE_FORMAT(m.dt_hr_registro,'%d/%m/%Y %H:%i') AS 'Data hora',
		DATE_FORMAT(m.dt_hr_registro,'%d/%m/%Y %H:%i') AS 'dt_hr_registro',
			COALESCE( DATE_FORMAT(lm.dt_hr_registro,'%d/%m/%Y %H:%i'), 'Não lido' ) AS 'Leitura'";
$tabelas = "tb_mensagem AS m LEFT JOIN tb_leitura_mensagem AS lm ON m.co_mensagem=lm.co_mensagem AND lm.co_pessoa = " . $co_pessoa;

$resTotal = $banco->seleciona($tabelas,"count(m.co_mensagem) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$totalDeRegistros = $resTotal[0]['total'];
$arrayTotalDeRegistros = array("total"=>$totalDeRegistros);

$inicio = $pagina - 1;
$inicio = $maximo * $inicio;

$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "m.co_mensagem", "m.dt_hr_registro DESC", "$inicio,$maximo", FALSE);

///adidiona o total de registros no inicio do array
array_unshift($pedidos,$arrayTotalDeRegistros);

echo json_encode($pedidos);