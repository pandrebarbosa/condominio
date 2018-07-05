<?php
$idoDecodificado = base64_decode($ido);

if (array_key_exists($idoDecodificado, $_SESSION['seguranca'])){
    include($_SESSION['seguranca'][$idoDecodificado]);
}else{
	include("views/inicio/sem-permissao.php");
}


