<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class TipoUnidadeDAO extends Db {
	
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
	public function gravarTipoUnidade(TipoUnidade $TipoUnidade){
		
			if($TipoUnidade->getCoTipoUnidade() != null){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$arr = $TipoUnidade->iterarObjeto();
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
			if($campos['co_tipo_unidade']){
				array_shift($campos);
			}
			
			$this->connBanco->alterar("tb_tipo_unidade", $campos, "co_tipo_unidade=" . $TipoUnidade->getCoTipoUnidade(), FALSE );
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$arr = $TipoUnidade->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$id_controller = $this->connBanco->inserir("tb_tipo_unidade", $campos, $valores, FALSE);
			
			$TipoUnidade->setCoTipoUnidade($id_controller);
			
		}
		

	}


	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarTipoUnidadeJSON(TipoUnidade $TipoUnidade) {
	
		$arrayCampos = array(
			"*"
		);
	
		$tabelas = "tb_tipo_unidade";
		$where=null;
		if($TipoUnidade->getCoTipoUnidade()>0){
			$where="co_tipo_unidade=".$TipoUnidade->getCoTipoUnidade();
		}
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
}