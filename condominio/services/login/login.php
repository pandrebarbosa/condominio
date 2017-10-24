<?php
$usuario  = (isset($_POST['usuario']) ? $_POST['usuario'] : '');
$senha    = (isset($_POST['senha']) ? $_POST['senha'] : '');

$resultado = '';

if (trim($usuario) == '') {
    $resultado =  array("tipo" => "erro", "msg" => "O Usuário é obrigatório!");
} else if (trim($senha) == '') {
    $resultado =  array("tipo" => "erro", "msg" => "A Senha é obrigatória!");
}

if ($resultado == '') {
    require_once('../lib/banco.class.php');
    require_once('../lib/toolBox.class.php'); 
    
    $ambiente = toolBox::retornaAmbiente();

    $banco = new banco();
    
	$tabelas = "tb_pessoa AS p
			    INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
				INNER JOIN tb_tipo_usuario AS tu ON tu.co_tipo_usuario=u.co_tipo_usuario
			    LEFT JOIN tb_morador AS mo ON mo.co_pessoa=p.co_pessoa";
	$campos = "p.no_pessoa AS 'Nome',p.co_pessoa,u.ds_senha,u.co_tipo_usuario,tu.no_tipo_usuario,u.ds_senha,mo.co_unidade";
	$where = "u.ds_login='" . $usuario . "'";
    $confere_usuario = $banco->seleciona($tabelas, $campos, $where, "p.co_pessoa", NULL, NULL, FALSE);
    
    if ($confere_usuario) {
        if (md5($senha) != $confere_usuario[0]['ds_senha']) {	
        	$resultado =  array("tipo" => "erro", "msg" => "Senha incorreta!");
    	} else {
	        session_name("Condominio");
	        session_start();
	        
	        $dados_sessao = array();
	        $i=1;
	        foreach($confere_usuario[0] AS $key=>$val){
	        	$dados_sessao[$key]=$val;
	        	if($i == count($confere_usuario[0])){
		        	$dados_sessao["ambiente"]=$ambiente;
	        	}
	        	$i++;
	        }
	        $_SESSION['credencial'] = $dados_sessao;
	        
	        $res_seguranca = $banco->seleciona("tb_controle_acesso AS ca INNER JOIN tb_controller AS c ON c.co_controller=ca.co_controller",
	        		                           "c.no_controller,c.ds_caminho", "ca.co_tipo_usuario=" . $confere_usuario[0]["co_tipo_usuario"], NULL, NULL, NULL, FALSE);
	        foreach($res_seguranca AS $dado){
	        	$dados_usuarios[$dado['no_controller']] = $dado['ds_caminho']; 
	        }
	        $_SESSION['seguranca'] = $dados_usuarios;

	        $res_configuracao = $banco->seleciona("configuracao","ds_remetente_emails,ds_copia_emails,ds_dest_email_cadastro", NULL, NULL, NULL, NULL, FALSE);
	        $_SESSION['configuracao'] = $res_configuracao[0];
	        
	        $resultado =  array("tipo" => "sucesso", "msg" => "Senha correta. Aguarde!");	
			if($ambiente=="PROD"){
				$banco->insere("tb_registros_acessos","co_pessoa,dt_hr_acesso, dados_acesso", $confere_usuario[0]['co_pessoa'].",NOW(),'".toolBox::verificaNavegadorSO()."'");
			}
		}
    }else{
    	$resultado =  array("tipo" => "erro", "msg" => "Erro no login!");
    }
}

echo json_encode($resultado);
exit;