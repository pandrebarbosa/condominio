<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$co_tipo_unidade = isset($_POST['co_tipo_unidade']) ? $_POST['co_tipo_unidade'] : '';
$banco = new banco();
$res = $banco->seleciona("tb_unidade", "co_tipo_unidade,co_unidade,nu_numero", "st_ativo IS TRUE AND co_tipo_unidade=$co_tipo_unidade", "nu_numero ASC", NULL, NULL, FALSE);
echo json_encode($res);