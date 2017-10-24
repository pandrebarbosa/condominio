<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$campos = "COUNT(ra.co_acesso) as 'Total', ra.dados_acesso AS 'SO'";
$tabelas = "tb_registros_acessos AS ra";

$res_cli = $banco->seleciona($tabelas, $campos, "ra.co_pessoa <> 1", "ra.dados_acesso", "Total DESC", NULL, FALSE);
echo json_encode($res_cli);