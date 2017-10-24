<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();
$res_tunidade = $banco->seleciona("tb_torre", "*", NULL, NULL, "no_torre ASC", NULL, FALSE);
echo json_encode($res_tunidade);