<?php 
session_name("Condominio");
session_start();

require_once('../lib/banco.class.php');

session_destroy();

header("Location: ../../");
exit;