<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Correio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Morador.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/Usuario.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/CorreioDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/UsuarioDAO.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/EnvioEmail.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/EnvioEmailDAO.class.php');

include('validarCadastro.php');

$CorreioDAO = new CorreioDAO();
$MoradorDAO = new MoradorDAO();

//Registra a entrada do correio
$CorreioDAO->gravarCorreio($Correio);

//Carrega os dados da correspondencia para colocar no email.
$res = $CorreioDAO->listarEntradaCorresnpodenciaJSON($Correio);

//Verifica os moradores da unidade
$Morador = new Morador();
$Morador->setCoUnidade($Correio->getCoUnidade());
$emailsDosMoradores = $MoradorDAO->listarEmailMoradores($Correio->getCoUnidade());

if($emailsDosMoradores){
    $email = array();
     foreach ($emailsDosMoradores as $k=>$val){
        if($val['st_autorizado'] == true){
            $email[] = $val['ds_contato'];
        }
     }
     
	$emailDestinatario = $email;
	$enviou = Email::enviarEmailAlertaCorrespondencia(  $res[0]['dt_hr_chegada'],
	    $res[0]['unidade'],
	    $res[0]['item'],
	    $res[0]['recebedor'],
	    $res[0]['ds_observacao'],
	    $emailDestinatario);
	if($enviou){
	    $resultado =  array("tipo" => "success",
	        "msg" => "Correspondência gravada com sucesso. Morador(es) alertado(s) no email.",
	        "id" => $Correio->getCoItemCorreio());
	}else{
	    $resultado =  array("tipo" => "info",
	        "msg" => "Correspondência gravada com sucesso. Não houve envio de email por erro desconhecido.",
	        "id" => $Correio->getCoItemCorreio());
	}

}else{
	$resultado =  array("tipo" => "info",
						"msg" => "Correspondência gravada com sucesso. Não houve envio de email, pois não há morador e email cadastrado e autorizado.",
						"id" => $Correio->getCoItemCorreio());	
}

echo json_encode($resultado);
exit;
