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

$campos = "p.co_pessoa,p.no_pessoa AS 'Nome',p.dt_nascimento AS 'Data de nascimento',p.nu_cpf AS 'CPF',u.ds_login AS 'Login',tu.no_tipo_usuario AS 'Tipo de usuário',
			CASE u.st_ativo
	    		WHEN 1 THEN 'Sim'
				WHEN 0 THEN 'Não'
			END AS 'Ativo'";
$tabelas = "tb_pessoa AS p
		    INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
			INNER JOIN tb_tipo_usuario AS tu ON tu.co_tipo_usuario=u.co_tipo_usuario";

$resTotal = $banco->seleciona($tabelas,"count(p.co_pessoa) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$totalDeRegistros = $resTotal[0]['total'];
$arrayTotalDeRegistros = array("total"=>$totalDeRegistros);

$inicio = $pagina - 1;
$inicio = $maximo * $inicio;

$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "p.co_pessoa", "u.dt_hr_registro DESC", "$inicio,$maximo", FALSE);

///adidiona o total de registros no inicio do array
array_unshift($pedidos,$arrayTotalDeRegistros);

echo json_encode($pedidos);