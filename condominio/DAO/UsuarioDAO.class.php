<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class UsuarioDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	

	/**
	 * Grava pessoas na tabela de usuários
	 * 
	 * @param Usuario $Usuario
	 */
	public function gravarUsuario(Usuario $Usuario){

		if($this->listarUsuarioExistente($Usuario)){
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$Usuario->setDtHrRegistro('CURRENT_TIMESTAMP');
			$arr = $Usuario->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$k] = $val;
				}
				$i++;
			}
			
			/* Se tiver a chave primaria prenchida, retira do array, para não
			 * fazer parte do UPDATE.
			 */
			if($campos['co_pessoa']){
				array_shift($campos);
			}
				
			$this->connBanco->alterar("tb_usuario", $campos, "co_pessoa=" . $Usuario->getCoPessoa(), FALSE );
		
		
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */			
			$campos=array();
			$valores=array();
			$arr = $Usuario->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
				
			$this->connBanco->inserir("tb_usuario", $campos, $valores, FALSE);

				
		}
		

	}


	/**
	 * Lista um usuário caso ele exista no banco dado id
	 *
	 * @param Usuario $Usuario
	 */
	public function listarUsuarioExistente(Usuario $Usuario) {
		$arrayCampos = array(
				"*"
		);
		$res = $this->connBanco->selecionar( "tb_usuario", $arrayCampos, "co_pessoa=" . $Usuario->getCoPessoa(), NULL, NULL, NULL, FALSE );
	
		if ($res) {
			$Usuario->setCoPessoa ( $res[0]['co_pessoa'] );
				
			return true;
		} else {
			return false;
		}
	}
	
	
	/**
	 * Lista um usuário caso ele exista no banco dado id
	 *
	 * @param Usuario $Usuario
	 */
	public function listarUsuario(Usuario $Usuario) {
		
		$arrayCampos = array(
				"*"
		);
		$res = $this->connBanco->selecionar( "tb_usuario",$arrayCampos, "co_pessoa=" . $Usuario->getCoPessoa(), NULL, NULL, NULL, FALSE );
	
		if ($res) {
			$Usuario->setCoPessoa ( $res[0]['co_pessoa'] );
			$Usuario->setCoTipoUsuario($res[0]['co_tipo_usuario']);
			$Usuario->setDsEmail($res[0]['ds_email']);
			$Usuario->setDsLogin($res[0]['ds_login']);
			$Usuario->setDsSenha($res[0]['ds_senha']);
			$Usuario->setStAtivo($res[0]['st_ativo']);
	
			return true;
		} else {
	
			return false;
		}
	}
	
	
	/**
	 * Lista os dados de um usuário caso ele exista no banco dado id
	 *
	 * @param Usuario $Usuario
	 */
	public function listarUsuarioJSON(Usuario $Usuario) {
	
		$arrayCampos = array(
				"p.co_pessoa",
				"p.no_pessoa",
				"DATE_FORMAT(p.dt_nascimento,'%d/%m/%Y') AS dt_nascimento",
				"INSERT( INSERT( INSERT( p.nu_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) AS nu_cpf",
				"p.nu_rg",
				"u.ds_login",
				"u.ds_email",
				"tu.co_tipo_usuario",
				"u.st_ativo",
				"un.co_torre",
				"un.co_unidade" );
		
		$tabelas = "tb_pessoa AS p
		    INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
			INNER JOIN tb_tipo_usuario AS tu ON tu.co_tipo_usuario=u.co_tipo_usuario
		    LEFT JOIN  tb_morador AS m ON m.co_pessoa=p.co_pessoa
			LEFT JOIN tb_unidade AS un ON un.co_unidade=m.co_unidade";
		
		$where = null;
		if( $Usuario->getCoPessoa() > 0 ){
			$where = "u.co_pessoa=" . $Usuario->getCoPessoa();
		}
		
		$res = $this->connBanco->selecionar($tabelas ,$arrayCampos, $where, NULL, NULL, NULL, FALSE );
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
	/**
	 * Reseta senha do usuario
	 *
	 * @param Usuario $Usuario
	 */
	public function resetarSenha(Usuario $Usuario){

	    $campos=array();
	    //seta o data_hora da alteração
	    $senha = md5(123456789);
	    $Usuario->setDsSenha($senha);
	    $arr = $Usuario->iterarObjeto();
	    $i=0;
	    foreach ($arr as $k=>$val){
	        if($val != null){
	            $campos[$k] = $val;
	        }
	        $i++;
	    }
	    /* Se tiver a chave primaria prenchida, retira do array, para não
	     * fazer parte do UPDATE.
	     */
	    if($campos['co_pessoa']){
	        array_shift($campos);
	    }
	    $this->connBanco->alterar("tb_usuario", $campos, "co_pessoa=" . $Usuario->getCoPessoa(), FALSE );
	    
	}
	
}