<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$co_ocorrencia = isset($_POST['co_ocorrencia']) ? $_POST['co_ocorrencia'] : '';

$banco = new banco();

$campos = "o.co_tipo_ocorrencia,o.co_ocorrencia,o.ds_titulo,o.ds_ocorrencia,DATE_FORMAT(o.dt_hr_ocorrencia,'%d/%m/%Y %H:%i') AS dt_hr_ocorrencia";
$tabelas = "tb_ocorrencia AS o";
$res_cli = $banco->seleciona($tabelas, $campos, "o.co_ocorrencia=$co_ocorrencia", "", "", "", FALSE);
echo json_encode($res_cli);