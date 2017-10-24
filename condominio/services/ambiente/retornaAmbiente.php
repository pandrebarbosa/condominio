<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$ambiente = toolBox::retornaAmbiente();

$resultado =  array("ambiente" => $ambiente);

echo json_encode($resultado);
exit;