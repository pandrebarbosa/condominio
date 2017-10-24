<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class ControllerDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	

	/**
	 * Grava Controller na tabela de Controller
	 * 
	 * @param Controller $Controller
	 */
	public function gravarController(Controller $Controller){
		
			if($Controller->getCoController() != null){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$arr = $Controller->iterarObjeto();
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
			if($campos['co_controller']){
				array_shift($campos);
			}
			
			$this->connBanco->alterar("tb_controller", $campos, "co_controller=" . $Controller->getCoController(), FALSE );
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$arr = $Controller->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$id_controller = $this->connBanco->inserir("tb_controller", $campos, $valores, FALSE);
			
			$Controller->setCoController($id_controller);
			
		}
		

	}
	
	/**
	 * Grava Controller na tabela de Controller
	 * 
	 * @param Controller $Controller
	 */
	public function gravarControllerAcesso(Controller $Controller){
		
		$campos = array("co_tipo_usuario","co_controller");
		
		$this->connBanco->apagar("tb_controle_acesso", "co_tipo_usuario=" . $Controller->getCoTipoUsuario());
		if($Controller->getCoController()!=''){
			foreach($Controller->getCoController() as $val){
				
				$valores = array($Controller->getCoTipoUsuario(), $val);
				
				$this->connBanco->inserir("tb_controle_acesso", $campos,$valores, FALSE);
				
			}
		}
		

	}


	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarControllerJSON(Controller $Controller) {
	
		$arrayCampos = array(
			"*"
		);
	
		$tabelas = "tb_controller";
		$where=null;
		if($Controller->getCoController()>0){
			$where="co_controller=".$Controller->getCoController();
		}
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param $tipo_usuario int
	 */
	public function listarControllerPorTipoUsuarioJSON($co_tipo_usuario) {
	
		$arrayCampos = array(
			"c.*"
		);
	
		$tabelas = "tb_controller AS c
					LEFT JOIN tb_controle_acesso AS ca ON c.co_controller=ca.co_controller";
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, "ca.co_tipo_usuario=".$co_tipo_usuario, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}	
	
	
	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param $tipo_usuario int
	 */
	public function listarControllerDisponivelPorTipoUsuario($co_tipo_usuario) {
	
		$arrayCampos = array(
			"c.*"
		);
	
		$tabelas = "tb_controller AS c";
		$where="c.co_controller NOT IN (SELECT co_controller FROM tb_controle_acesso WHERE co_tipo_usuario=$co_tipo_usuario)";
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}	
	
	/**
	 * Altera a tabela de contato para st_ativo = false
	 *
	 * @param Contato $Contato
	 */
	public function excluirController(Controller $Controller){
	
		$this->connBanco->apagar("tb_controller","co_controller=" . $Controller->getCoController());
	
	}
	
}