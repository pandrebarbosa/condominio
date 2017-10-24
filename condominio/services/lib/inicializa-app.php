<?php
$pathAbsolute = realpath(dirname(__FILE__));

session_name("Condominio");
session_start();

$_SESSION['credencial']['ambiente'] = $ambiente;

require_once($pathAbsolute . '/banco.class.php');
require_once($pathAbsolute . '/toolBox.class.php');
require_once($pathAbsolute . '/Email.class.php');