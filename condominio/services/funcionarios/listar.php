<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "";
$txt_criterio = ($_POST["criterio"] != "null") ? $_POST["criterio"] : '';

if ($txt_criterio != "") {
    $criterio = "p.no_pessoa like '%" . $txt_criterio . "%'";
}

$pagina = isset ( $_POST ["pagina"] ) && $_POST ["pagina"] != "" ? $_POST ["pagina"] : 1;
$maximo = isset ( $_POST ["maximo"] ) ? $_POST ["maximo"] : null;

$campos = "p.co_pessoa,p.no_pessoa AS 'Nome',
		    INSERT( INSERT( INSERT( p.nu_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) AS 'CPF',
		    cf.no_cargo_funcionario AS 'Cargo',p.ds_foto AS 'Foto',
			DATE_FORMAT(f.dt_entrada,'%d/%m/%Y') AS 'Entrada',
			DATE_FORMAT(f.dt_saida,'%d/%m/%Y') AS 'Saída',
			CASE f.st_ativo
	    		WHEN 1 THEN 'Sim'
				WHEN 0 THEN 'Não'
			END AS 'Ativo'";
$tabelas = "tb_pessoa AS p
		    INNER JOIN tb_funcionario AS f ON f.co_pessoa=p.co_pessoa AND f.st_ativo IS TRUE
			INNER JOIN tb_cargo_funcionario AS cf ON cf.co_cargo_funcionario=f.co_cargo_funcionario";

$resTotal = $banco->seleciona($tabelas,"count(p.co_pessoa) AS total", "$criterio", NULL, NULL, NULL, FALSE);
$totalDeRegistros = $resTotal[0]['total'];
$arrayTotalDeRegistros = array("total"=>$totalDeRegistros);

$inicio = $pagina - 1;
$inicio = $maximo * $inicio;

$pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "p.co_pessoa", "f.dt_hr_registro DESC", "$inicio,$maximo", FALSE);

///adidiona o total de registros no inicio do array
array_unshift($pedidos,$arrayTotalDeRegistros);

echo json_encode($pedidos);