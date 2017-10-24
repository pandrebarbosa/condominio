<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/CargoFuncionarioDAO.class.php');

$CargoFuncionarioDAO = new CargoFuncionarioDAO();

$res = $CargoFuncionarioDAO->listarCargoFuncionarioJSON();

echo json_encode($res);