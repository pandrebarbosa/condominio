<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();
$res_tunidade = $banco->seleciona("tb_tipo_unidade", "co_tipo_unidade, no_tipo_unidade", "co_tipo_unidade IN (3,6)", NULL, "no_tipo_unidade ASC", NULL, FALSE);
echo json_encode($res_tunidade);