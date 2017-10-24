<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$co_unidade = isset($_POST['co_unidade']) ? $_POST['co_unidade'] : '';
$banco = new banco();
$res = $banco->seleciona("tb_unidade", "*", "st_ativo IS TRUE AND co_unidade=$co_unidade", "", "", "", FALSE);
echo json_encode($res);