<?php
if (array_key_exists($ido, $_SESSION['seguranca'])){
	include($_SESSION['seguranca'][$ido]);
}else{
	include("views/inicio/sem-permissao.php");
}


