<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$co_pessoa = isset($_POST['co_pessoa']) ? $_POST['co_pessoa'] : null;

$banco = new banco();

$campos = "mo.co_tipo_morador,
		pe.ds_foto,
		DATE_FORMAT(mo.dt_inicio,'%d/%m/%Y') AS dt_inicio,
		mo.co_pessoa,
		mo.co_profissao,
		p.no_profissao,
		pe.no_pessoa,
		INSERT( INSERT( INSERT( pe.nu_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) AS nu_cpf,
		pe.nu_rg,
		DATE_FORMAT(pe.dt_nascimento,'%d/%m/%Y') AS dt_nascimento,
		pe.st_foto_publica";
$tabelas = "tb_morador AS mo
			INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
			INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade
			INNER JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=mo.co_tipo_morador
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
			LEFT JOIN tb_torre AS tr ON tr.co_torre=u.co_torre
			LEFT JOIN tb_profissao AS p ON p.co_profissao=mo.co_profissao";
$res_cli = $banco->seleciona($tabelas,$campos,"mo.co_pessoa=".$co_pessoa, "", "", "", FALSE);

echo json_encode($res_cli);