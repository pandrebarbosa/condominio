<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$campos = "COUNT(mo.co_pessoa) as qtd";
$tabelas = "tb_morador AS mo
			INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade";
$res_cli = $banco->seleciona($tabelas, $campos, NULL, NULL, NULL, NULL, FALSE);
echo json_encode($res_cli);