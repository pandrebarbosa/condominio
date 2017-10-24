<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$campos = "COUNT(ra.co_acesso) as 'Total', p.no_pessoa AS 'Usuário'";
$tabelas = "tb_registros_acessos AS ra
			INNER JOIN tb_pessoa AS p ON p.co_pessoa=ra.co_pessoa";
$res_cli = $banco->seleciona($tabelas, $campos, "ra.co_pessoa <> 1", "p.co_pessoa", "Total DESC", "0,10", FALSE);
echo json_encode($res_cli);