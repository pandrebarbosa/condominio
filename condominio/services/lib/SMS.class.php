<?php
class SMS
{
	
    static function smsNovoCorreio(){
    	
    	$req = self::requisicaoApi(array('client_id'=>"pandre.barbosa@gmail.com", 'client_secret'=>"4947944"), "request_token");
    	$access_token = $req['access_token'];
    	
    	// Monta a mensagem
    	$SMS = "San Raphael informa: Você tem uma correspondência na sua caixa de correio.";
    	// Array com os parametros para o envio
    	$data = array(
    			'origem'=>NULL, // Seu numero que é origem
    			'destino'=>"061981547201", // E o numero de destino
    			'tipo'=>"texto",
    			'access_token'=>$access_token,
    			'texto'=>$SMS
    	);
    	// realiza o envio
    	$res = self::requisicaoApi($data, "sms/send");    	
		
		return $res;
		
    }

    
    function requisicaoApi($params, $endpoint){
    	$url = "http://api.directcallsoft.com/{$endpoint}";
    	$data = http_build_query($params);
    	$ch =   curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	$return = curl_exec($ch);
    	curl_close($ch);
    	// Converte os dados de JSON para ARRAY<
    	$dados = json_decode($return, true);
    	return $dados;
    }
}

?>