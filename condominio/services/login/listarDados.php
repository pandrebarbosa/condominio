<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$co_pessoa = isset($_POST['co_pessoa']) ? $_POST['co_pessoa'] : '';

$banco = new banco();

$res_usuario = $banco->seleciona("tb_usuario","co_pessoa,ds_login", "co_pessoa=$co_pessoa", "", "", "", FALSE);
echo json_encode($res_usuario);