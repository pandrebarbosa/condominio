<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();
$res_tunidade = $banco->seleciona("tb_tipo_usuario", "*", NULL, NULL, "no_tipo_usuario ASC", NULL, FALSE);
echo json_encode($res_tunidade);