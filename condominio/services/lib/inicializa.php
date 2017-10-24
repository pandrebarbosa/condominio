<?php
//error_reporting(E_ERROR); //E_ERROR | E_WARNING | E_PARSE

$pathAbsolute = realpath(dirname(__FILE__));

require_once($pathAbsolute . '/banco.class.php');
require_once($pathAbsolute . '/toolBox.class.php');
require_once($pathAbsolute . '/SMS.class.php');

session_name("Condominio");
session_start();

require_once($pathAbsolute . '/Email.class.php');
require_once($pathAbsolute . '/seguranca.php');

if(empty($_SESSION['credencial'])){
	header('Location: ./');
	exit;
}

$ido = isset($_GET['ido']) ? $_GET['ido'] : '';
?>