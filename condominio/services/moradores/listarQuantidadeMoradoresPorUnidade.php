<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$campos = "CONCAT(u.co_torre,u.nu_numero) AS 'Unidade', COUNT(mo.co_pessoa) AS 'Total'";
$tabelas = "tb_morador AS mo
			INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade
			WHERE mo.st_ativo IS TRUE AND u.co_torre IS NOT NULL";
$res_cli = $banco->seleciona($tabelas,$campos,null, "mo.co_unidade", "total DESC, unidade ASC", NULL, FALSE);

echo json_encode($res_cli);