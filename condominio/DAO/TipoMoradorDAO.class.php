<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class TipoMoradorDAO extends Db {
	
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
	public function gravarTipoUnidade(TipoMorador $TipoMorador){
		
			if($TipoMorador->getCoTipoMorador() != null){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$arr = $TipoMorador->iterarObjeto();
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
			if($campos['co_tipo_morador']){
				array_shift($campos);
			}
			
			$this->connBanco->alterar("tb_tipo_morador", $campos, "co_tipo_morador=" . $TipoMorador->getCoTipoMorador(), FALSE );
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$arr = $TipoMorador->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$id_controller = $this->connBanco->inserir("tb_tipo_morador", $campos, $valores, FALSE);
			
			$TipoMorador->setCoTipoMorador($id_controller);
			
		}
		

	}


	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarTipoMoradorJSON(TipoMorador $TipoMorador) {
	
		$arrayCampos = array(
			"*"
		);
	
		$tabelas = "tb_tipo_morador";
		$where=null;
		if($TipoMorador->getCoTipoMorador()>0){
			$where="co_tipo_morador=".$TipoMorador->getCoTipoMorador();
		}
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
}