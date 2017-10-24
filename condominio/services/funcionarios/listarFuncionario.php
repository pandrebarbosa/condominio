<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Funcionario.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/FuncionarioDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/TurnoDAO.class.php');

$Funcionario = new Funcionario($_POST);

$FuncionarioDAO = new FuncionarioDAO();
$res = $FuncionarioDAO->listarFuncionarioJSON($Funcionario);

$TurnoDAO = new TurnoDAO();
$resTurnos = $TurnoDAO->listarTurnosPorFuncionarioJSON($Funcionario->getCoPessoa());

array_unshift($res,$resTurnos);

echo json_encode($res);
