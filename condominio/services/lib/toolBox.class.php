<?php

class toolBox
{

    static function formatarCPF_CNPJ($campo, $formatado = true)
    {
        // retira formato
        $codigoLimpo = ereg_replace("[' '-./ t]", '', $campo);
        // pega o tamanho da string menos os digitos verificadores
        $tamanho = (strlen($codigoLimpo) - 2);
        // verifica se o tamanho do código informado é válido
        if ($tamanho != 9 && $tamanho != 12) {
            return false;
        }

        if ($formatado) {
            // seleciona a máscara para cpf ou cnpj
            $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

            $indice = - 1;
            for ($i = 0; $i < strlen($mascara); $i ++) {
                if ($mascara[$i] == '#')
                    $mascara[$i] = $codigoLimpo[++ $indice];
            }
            // retorna o campo formatado
            $retorno = $mascara;
        } else {
            // se não quer formatado, retorna o campo limpo
            $retorno = $codigoLimpo;
        }

        return $retorno;
    }

    static function removeFormatacaoCpfCNpj($numero, $tipo)
    {
        $numero_final = "";
        if ($tipo == "PF") {
            $numero_final = str_replace('-', '', str_replace('.', '', $numero));
        } elseif ($tipo == "PJ") {
            $numero_final = str_replace('/', '', str_replace('-', '', str_replace('.', '', $numero)));
        }
        return $numero_final;
    }

    static function formataDinheiroGravar($numero)
    {
        $numero_final = str_replace(',', '.', str_replace('.', '', $numero));
        return $numero_final;
    }

    static function formataData($data,$acao)
    {
        if ($acao == "G") {
            $data_final = str_replace('/', '', $data);
            $ano = substr($data_final, 4, 4);
            $mes = substr($data_final, 2, 2);
            $dia = substr($data_final, 0, 2);
            $dia_banco = $ano . "-" . $mes . "-" . $dia;
        } elseif ($acao == "M") {
            $data_final = str_replace('-', '', $data);
            $ano = substr($data_final, 0, 4);
            $mes = substr($data_final, 4, 2);
            $dia = substr($data_final, 6, 2);
            $dia_banco = $dia . "/" . $mes . "/" . $ano;
        }
        return $dia_banco;
    }

    static function formataDataHora($data,$acao="G")
    {
    	if ($acao == "G") {
	    	$data_final = str_replace('/', '', $data);
	    	$data_final = str_replace(':', '', $data_final);
	    	$data_final = str_replace(' ', '', $data_final);
	        $dia = substr($data_final, 0, 2);
	        $mes = substr($data_final, 2, 2);
	        $ano = substr($data_final, 4, 4);
	        $hora = substr($data_final, 8, 2);
	        $minuto = substr($data_final, 10, 2);
	        $dt_banco = $ano . "-" . $mes . "-" . $dia . " " . $hora.":".$minuto.":00";
    	} elseif ($acao == "M") {
	    	$data_final = str_replace('-', '', $data);
	        $ano = substr($data_final, 0, 4);
	        $mes = substr($data_final, 4, 2);
	        $dia = substr($data_final, 6, 2);
	        $hora = substr($data_final, 8, 9);
	        $dt_banco = $dia . "/" . $mes . "/" . $ano . " às " . $hora;
    	}
        
        return $dt_banco;
    }

    static function formataDataComHora($data)
    {
        $data_final = str_replace('-', '', $data);
        $ano = substr($data_final, 0, 4);
        $mes = substr($data_final, 4, 2);
        $dia = substr($data_final, 6, 2);
        $dt_banco = $dia . "/" . $mes . "/" . $ano;
        return $dt_banco;
    }

    /**
     * Calcula a idade levando em consideração anos bisextos
     *
     * @param integer $d
     *            Dia
     * @param integer $m
     *            Mês
     * @param integer $y
     *            Ano
     * @return array
     */
    static function calculaIdade($data)
    {
        $data = explode('/', $data);
        //$data = explode('-', $data);
        $m = $data[1];
        $d = $data[2];
        $y = $data[0];

        $arr = explode('-', date('m-d-Y'));
        $days = call_user_func_array('gregoriantojd', $arr) - gregoriantojd($m, $d, $y);
        $aux = $days / 365.2425;
        $years = floor($aux);
        $days = floor(365.2425 * ($aux - $years));
        $months = 0;

        /**
         * Como os meses de fevereiro com 29 dias já foram levados em
         * consideração no cálculo
         * anterior, no cálculo de meses consideramos fevereiro como tendo
         * apenas 28 dias.
         */
        while ($days >= 28) {
            $sub = 28;

            if (($m % 2) == 1)
                $sub = 31;
            if ($m != 2)
                $sub = 30;

            if ($sub <= $days) {
                $days -= $sub;

                $m = $m == 12 ? 1 : $m + 1;
                ++ $months;
            } else
                break;
        }

        return $years . " ano(s), " . $months . " mês(es) e " . $days . " dia(s)";
    }

    /*
     * Função que retorna a data completa com saudação.
     */
    static function retornaData()
    {
        $dia_semana = date("l");
        $dia = date("j");
        $mes = date("F");
        $ano = date("Y");
        $hora = date("H");
        $minuto = date("i");
        $segundo = date("s");

        if (($hora >= 00) and ($hora < 12)) {
            $mensagem = "Bom dia!";
        } elseif (($hora >= 12) and ($hora < 18)) {
            $mensagem = "Boa tarde!";
        } elseif (($hora >= 18) and ($hora <= 23)) {
            $mensagem = "Boa noite!";
        }

        if ($dia_semana == "Sunday") {
            $dia_semana = "Domingo";
        } elseif ($dia_semana == "Monday") {
            $dia_semana = "Segunda Feira";
        } elseif ($dia_semana == "Tuesday") {
            $dia_semana = "Terça Feira";
        } elseif ($dia_semana == "Wednesday") {
            $dia_semana = "Quarta Feira";
        } elseif ($dia_semana == "Thursday") {
            $dia_semana = "Quinta Feira";
        } elseif ($dia_semana == "Friday") {
            $dia_semana = "Sexta Feira";
        } elseif ($dia_semana == "Saturday") {
            $dia_semana = "Sábado";
        }

        if ($mes == "January") {
            $mes = "Janeiro";
        } elseif ($mes == "February") {
            $mes = "Fevereiro";
        } elseif ($mes == "March") {
            $mes = "Março";
        } elseif ($mes == "April") {
            $mes = "Abril";
        } elseif ($mes == "May") {
            $mes = "Maio";
        } elseif ($mes == "June") {
            $mes = "Junho";
        } elseif ($mes == "July") {
            $mes = "Julho";
        } elseif ($mes == "August") {
            $mes = "Agosto";
        } elseif ($mes == "September") {
            $mes = "Setembro";
        } elseif ($mes == "October") {
            $mes = "Outubro";
        } elseif ($mes == "November") {
            $mes = "Novermbro";
        } elseif ($mes == "December") {
            $mes = "Dezembro";
        }
        $msg = "$dia_semana, $dia de $mes de $ano";
        return $msg;
    }

    static function get_ip()
    {
        $variables = array(
                '',
                'HTTP_X_FORWARDED_FOR',
                'HTTP_X_FORWARDED',
                'HTTP_FORWARDED_FOR',
                'HTTP_FORWARDED',
                'HTTP_X_COMING_FROM',
                'HTTP_COMING_FROM',
                'HTTP_CLIENT_IP',
                'HTTP_USER_AGENT',
                'REMOTE_ADDR'
        );

        $return = 'Unknown';

        foreach ($variables as $variable) {
            if (isset($_SERVER[$variable])) {
                $return .= $_SERVER[$variable] . " - ";
            }
        }

        return $return;
    }

    function retiraAcentos($string, $slug = false)
    {

        // Setamos o localidade
        setlocale(LC_ALL, 'pt_BR');

        $string = utf8_decode($string);

        // Se a flag 'slug' for verdadeira, transformamos o texto para lowercase
        if ($slug)
            $string = strtolower($string);

            // Código ASCII das vogais
        $ascii['a'] = range(224, 230);
        $ascii['e'] = range(232, 235);
        $ascii['i'] = range(236, 239);
        $ascii['o'] = array_merge(range(242, 246), array(
                240,
                248
        ));
        $ascii['u'] = range(249, 252);

        // Código ASCII dos outros caracteres
        $ascii['b'] = array(
                223
        );
        $ascii['c'] = array(
                231
        );
        $ascii['d'] = array(
                208
        );
        $ascii['n'] = array(
                241
        );
        $ascii['y'] = array(
                253,
                255
        );

        // Fazemos um loop para criar as regras de troca dos caracteres
        // acentuados
        foreach ($ascii as $key => $item) {

            $acentos = '';
            foreach ($item as $codigo)
                $acentos .= chr($codigo);
            $troca[$key] = '/[' . $acentos . ']/i';
        }

        // Aplicamos o replace com expressao regular
        $string = preg_replace(array_values($troca), array_keys($troca), $string);

        // Se a flag 'slug' for verdadeira...
        if ($slug) {

            // Troca tudo que não for letra ou número por um caractere ($slug)
            $string = preg_replace('/[^a-z0-9]/i', $slug, $string);

            // Tira os caracteres ($slug) repetidos
            $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
            $string = trim($string, $slug);
        }

        return trim($string);
    }

    function retornaMes($mes)
    {
        switch ($mes) {
            case 1:
                echo "Janeiro";
                break;
            case 2:
                echo "Fevereiro";
                break;
            case 3:
                echo "Março";
                break;
            case 4:
                echo "Abril";
                break;
            case 5:
                echo "Maio";
                break;
            case 6:
                echo "Junho";
                break;
            case 7:
                echo "Julho";
                break;
            case 8:
                echo "Agosto";
                break;
            case 9:
                echo "Setembro";
                break;
            case 10:
                echo "Outubro";
                break;
            case 11:
                echo "Novembro";
                break;
            case 12:
                echo "Dezembro";
                break;
        }
    }


    static function diferencaDatas($data_inicial, $data_final)
    {

        // Usa a função criada e pega o timestamp das duas datas:
        $time_inicial = self::geraTimestamp($data_inicial);
        $time_final = self::geraTimestamp($data_final);

        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos

        // Calcula a diferença de dias
        $dias = (int) floor($diferenca / (60 * 60 * 24)); // 225 dias

        // Exibe uma mensagem de resultado:
        return $dias;
    }

    static function geraTimestamp($data)
    {
        $partes = explode('/', $data);
        return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
    }
    
    static function verificaNavegadorSO() {
    	$ip = $_SERVER['REMOTE_ADDR'];
    
    	$u_agent = $_SERVER['HTTP_USER_AGENT'];
    	$bname = 'Unknown';
    	$platform = 'Unknown';
    	$version= "";
    
    	if (preg_match('/linux/i', $u_agent)) {
    		$platform = 'Linux';
    	}
    	elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    		$platform = 'Mac';
    	}
    	elseif (preg_match('/windows|win32/i', $u_agent)) {
    		$platform = 'Windows';
    	}
    
    
    	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    	{
    		$bname = 'Internet Explorer';
    		$ub = "MSIE";
    	}
    	elseif(preg_match('/Firefox/i',$u_agent))
    	{
    		$bname = 'Mozilla Firefox';
    		$ub = "Firefox";
    	}
    	elseif(preg_match('/Chrome/i',$u_agent))
    	{
    		$bname = 'Google Chrome';
    		$ub = "Chrome";
    	}
    	elseif(preg_match('/AppleWebKit/i',$u_agent))
    	{
    		$bname = 'AppleWebKit';
    		$ub = "Opera";
    	}
    	elseif(preg_match('/Safari/i',$u_agent))
    	{
    		$bname = 'Apple Safari';
    		$ub = "Safari";
    	}
    
    	elseif(preg_match('/Netscape/i',$u_agent))
    	{
    		$bname = 'Netscape';
    		$ub = "Netscape";
    	}
    
    	$known = array('Version', $ub, 'other');
    	$pattern = '#(?<browser>' . join('|', $known) .
    	')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    	if (!preg_match_all($pattern, $u_agent, $matches)) {
    	}
    
    
    	$i = count($matches['browser']);
    	if ($i != 1) {
    		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
    			$version= $matches['version'][0];
    		}
    		else {
    			$version= $matches['version'][1];
    		}
    	}
    	else {
    		$version= $matches['version'][0];
    	}
    
    	// check if we have a number
    	if ($version==null || $version=="") {$version="?";}
    
    	$Browser = array(
    			'userAgent' => $u_agent,
    			'name'      => $bname,
    			'version'   => $version,
    			'platform'  => $platform,
    			'pattern'    => $pattern
    	);
    
    	return $navegador = "Navegador: " . $Browser['name'] . " " . $Browser['version'] . " | SO: " . $Browser['platform'];
    
    }  
    
    /**
     * Define os caminhos e comportamentos de acordo com os ambientes.
     */
    static function retornaAmbiente() {
    	if($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "192.168.0.6"){
    		return "DEV";
    	}else{
    		return "PROD";
    	}
    	
    }
    
    
}

?>