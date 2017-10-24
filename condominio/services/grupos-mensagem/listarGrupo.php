<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/GrupoMensagem.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/GrupoMensagemDAO.class.php');

$GrupoMensagem = new GrupoMensagem($_POST);

$GrupoMensagemDAO = new GrupoMensagemDAO();
$resultado = $GrupoMensagemDAO->listarGrupo($GrupoMensagem);

echo json_encode($resultado);
exit;
