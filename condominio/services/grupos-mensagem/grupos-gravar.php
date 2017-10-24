<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/GrupoMensagem.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/GrupoMensagemDAO.class.php');

include('validarCadastro.php');

$GrupoMensagemDAO = new GrupoMensagemDAO();
$GrupoMensagemDAO->gravarGrupo($GrupoMensagem);

$resultado =  array("tipo" => "sucesso", "msg" => "Grupo salvo com sucesso.", "id" => $GrupoMensagem->getCoGrupo());

echo json_encode($resultado);
exit;
