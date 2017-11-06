<?php
class Email
{
 
    static function emailResetarSenha($destinatario){
        
        $templatePath = realpath(dirname(dirname(dirname(__FILE__)))) . '/views/email/aviso-nova-senha.html';
        $templateConteudo = file_get_contents( $templatePath );
        
        $assunto = "Nova senha de acesso";
        $conteudo = $templateConteudo;
        
        $enviou = self::enviaEmail($destinatario, $destinatarioCc, $assunto, $conteudo);
        
        return $enviou;
        
    }
    
    static function emailNovoUsuario($nome,$email,$unidades){
    	
		$templatePath = realpath(dirname(dirname(dirname(__FILE__)))) . '/views/email/aviso-novo-cadastro.html';
		$templateConteudo = file_get_contents ( $templatePath );
		$variaveisTemplate = Array( 
			'{{$nome}}',
			'{{$email}}',
			'{{$unidades}}'
		);
		$valoresTemplate = Array( 
			$nome,
			$email,
			$unidades
		);
		
		$destinatario = "ajuda@condominiosanraphael.com.br";
		$destinatarioCc = "pandre.barbosa@gmail.com";
		$assunto = "NOVO USUÁRIO";
		$conteudo = str_replace ( $variaveisTemplate, $valoresTemplate, $templateConteudo );
		
		$enviou = self::enviaEmail($destinatario, $destinatarioCc, $assunto, $conteudo);		
		
		return $enviou;
		
    }
    
    static function enviarEmailAlertaCorrespondencia($dt_hr_chegada,$unidade,$ds_item,$recebedor,$ds_observacao,$destinatario){
    	
		$templatePath = realpath(dirname(dirname(dirname(__FILE__)))) . '/views/email/aviso-correspondencia.html';
		$templateContent = file_get_contents ( $templatePath );
		$placeHolders = Array( 
			'{{$dt_hr_chegada}}',
			'{{$unidade}}',
			'{{$ds_item}}',
			'{{$recebedor}}',
			'{{$ds_observacao}}'
		);
		$values = Array( 
			$dt_hr_chegada,
			$unidade,
			$ds_item,
			$recebedor,
			$ds_observacao
		);
		
		$assunto = "San Rahael avisa: Chegou uma nova correspondência.";
		$conteudo = str_replace ( $placeHolders, $values, $templateContent );
		$destinatarioFinal = implode(',', $destinatario);
		$destinatarioCc = null;
		
		$enviou = self::enviaEmail($destinatarioFinal, $destinatarioCc, $assunto, $conteudo);
		
		//Se tiver enviado, gravo o registor do envio.
		if($enviou){
			$EnvioEmail = new EnvioEmail();
			$EnvioEmail->setDsAssunto($assunto);
			$EnvioEmail->setDsConteudo($conteudo);
			$EnvioEmail->setDsEmail($destinatarioFinal);
			$EnvioEmailDAO = new EnvioEmailDAO();
			$env = $EnvioEmailDAO->gravarEnvioEmail($EnvioEmail);
		}
		
		return $enviou;
		
    }
    
    public function enviaEmail($destinatario,$destinatarioCc=null, $assunto, $conteudo) {
    	
    	
    	// emails para quem será enviado o formulário
    	$emailsender = "webmaster@condominiosanraphael.com.br";
    	
    	// É necessário indicar que o formato do e-mail é html
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    	$headers .= 'From: Condomínio San Raphael - Lago Norte <webmaster@condominiosanraphael.com.br>' . "\r\n";
    	if($destinatarioCc != null){
    		$headers .= 'Bcc:'.$destinatarioCc . "\r\n";
    	}
    	 
    	if(!mail($destinatario, $assunto, $conteudo, $headers ,"-r".$emailsender)){ // Se for Postfix
    		$headers .= "Return-Path: " . $emailsender . "\n"; // Se "não for Postfix"
    		mail($destinatario, $assunto, $conteudo, $headers );
    	}
    	 
    	$enviaremail = mail($destinatario, $assunto, $conteudo, $headers);
    	if($enviaremail){
    		return true;
    	} else {
    		return false;
    	}    	
    }

}

?>