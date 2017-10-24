<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$campos = "COUNT(u.co_unidade) as qtd";
$tabelas = "tb_morador AS mo
			INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa AND pe.co_pessoa=4
			INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade AND st_ativo IS TRUE";
$res_cli = $banco->seleciona($tabelas,$campos,null, "", "", "", FALSE);
echo json_encode($res_cli);