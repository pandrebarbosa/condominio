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

$CorreioDAO->gravarCorreio($Correio);

$res = $CorreioDAO->listarEntradaCorresnpodenciaJSON($Correio);

//Verifica os moradores da unidade
$Morador = new Morador();
$Morador->setCoUnidade($Correio->getCoUnidade());
$moradores = $MoradorDAO->listarMoradoresDaUnidade($Morador);

if($moradores){
	foreach($moradores as $dados){
		$Usuario = new Usuario();
		$Usuario->setCoPessoa($dados['co_pessoa']);
		$UsuarioDAO = new UsuarioDAO();
		$existeUsuario = $UsuarioDAO->listarUsuario($Usuario);
		if($existeUsuario){
			$email[] = $Usuario->getDsEmail() != '' ? $Usuario->getDsEmail() : false ;
		}
	}
	
	if($email[0]!=false){
		$EnvioEmail = new EnvioEmail();
		$EnvioEmail->setDsEmail($email[0]);
		
		$EnvioEmailDAO = new EnvioEmailDAO();
		$ultimoEnvio = $EnvioEmailDAO->retornarDiferencaHoraDoUltimoEnvio($EnvioEmail);
		
		if($ultimoEnvio >= 0){ //2 horas
			$emailDestinatario = $email[0];
			$enviou = Email::enviarEmailAlertaCorrespondencia(  $res[0]['dt_hr_chegada'],
                                            					$res[0]['unidade'],
                                            					$res[0]['item'],
                                            					$res[0]['recebedor'],
                                            					$res[0]['ds_observacao'],
                                            					$emailDestinatario);
					if($enviou){
						$resultado =  array("tipo" => "success",
											"msg" => "Correspondência gravada com sucesso. Morador alertado no email(<i>".$EnvioEmail->getDsEmail()."</i>).",
											"id" => $Correio->getCoItemCorreio());
					}else{
						$resultado =  array("tipo" => "info",
											"msg" => "Correspondência gravada com sucesso. Não houve envio de email por erro desconhecido. (<i>".$EnvioEmail->getDsEmail()."</i>)",
											"id" => $Correio->getCoItemCorreio());	
					}
		}else{
			$resultado =  array("tipo" => "info",
								"msg" => "Correspondência gravada com sucesso. Não houve envio de email, pois ja houve envio com menos de 2 horas.(<i>".$EnvioEmail->getDsEmail()."</i>).",
								"id" => $Correio->getCoItemCorreio());
		}
	}else{
		$resultado =  array("tipo" => "info",
							"msg" => "Correspondência gravada com sucesso. Não houve envio de email, pois não há email cadastrado.",
							"id" => $Correio->getCoItemCorreio());
	}

}else{
	$resultado =  array("tipo" => "info",
						"msg" => "Correspondência gravada com sucesso. Não houve envio de email, pois não há usuario e nem email cadastrados.",
						"id" => $Correio->getCoItemCorreio());	
}

echo json_encode($resultado);
exit;
