<?php
$usuario  = (isset($_POST['usuario']) ? $_POST['usuario'] : '');
$senha    = (isset($_POST['senha']) ? $_POST['senha'] : '');

$resultado = '';

if ($resultado == '') {
    require_once('../lib/banco.class.php');
    require_once('../lib/toolBox.class.php'); 
    
    $ambiente = toolBox::retornaAmbiente();

    $banco = new banco();
    
	$tabelas = "tb_pessoa AS p
			    INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
				INNER JOIN tb_tipo_usuario AS tu ON tu.co_tipo_usuario=u.co_tipo_usuario AND tu.co_tipo_usuario IN (3,4,5,99)
			    LEFT JOIN tb_morador AS mo ON mo.co_pessoa=p.co_pessoa";
	$campos = "p.no_pessoa,p.co_pessoa,u.ds_senha,u.co_tipo_usuario,tu.no_tipo_usuario,u.ds_senha,mo.co_unidade,p.ds_foto";
	$where = "u.ds_login='" . $usuario . "'";
    $confere_usuario = $banco->seleciona($tabelas, $campos, $where, "p.co_pessoa", NULL, NULL, FALSE);
    
    if ($confere_usuario) {
        if (md5($senha) != $confere_usuario[0]['ds_senha']) {	
        	$resultado =  false;
    	} else {
	        $dados_sessao = array();
	        $i=1;
	        foreach($confere_usuario[0] AS $key=>$val){
	        	$dados_sessao[$key]=$val;
	        	if($i == count($confere_usuario[0])){
		        	$dados_sessao["ambiente"]=$ambiente;
	        	}
	        	$i++;
	        }
	        $resultado = $dados_sessao;
			if($ambiente=="PROD"){
				$banco->insere("tb_registros_acessos","co_pessoa,dt_hr_acesso, dados_acesso", $confere_usuario[0]['co_pessoa'].",NOW(),'".toolBox::verificaNavegadorSO()."'");
			}
		}
    }else{
    	$resultado =  false;
    }
}

echo json_encode($resultado);
exit;