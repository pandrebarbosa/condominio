<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class ModeloVeiculoDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	

	/**
	 * Grava racas na tabela de raca
	 * 
	 * @param ModeloVeiculo $ModeloVeiculo
	 */
	public function gravarModeloVeiculo(ModeloVeiculo $ModeloVeiculo){
		
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$arr = $ModeloVeiculo->iterarObjeto();
		$i=0;
		foreach ($arr as $k=>$val){
			if($val != null){
				$campos[$i] = $k;
				$valores[$i] = $val;
			}
			$i++;
		}
		
		$co_ModeloVeiculo = $this->connBanco->inserir("tb_modelo_veiculo", $campos, $valores, FALSE);
		
		$ModeloVeiculo->setCoModeloVeiculo($co_ModeloVeiculo);
		

	}

	
	
	/**
	 * Lista um morador de uma unidade dado o 
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarModeloVeiculo(ModeloVeiculo $ModeloVeiculo) {
		$arrayCampos = array(	
			"co_ModeloVeiculo",
			"co_unidade",
			"co_tipo_animal",
			"co_raca",
			"ds_cor",
			"ds_nome",
			"ds_foto",
			"st_ativo",
			"dt_hr_registro"
		);
		$res = $this->connBanco->selecionar( "tb_ModeloVeiculo", $arrayCampos, "co_ModeloVeiculo=" . $ModeloVeiculo->getCoModeloVeiculo(), NULL, NULL, NULL, FALSE );
	
		if($res){
			$ModeloVeiculo->setCoModeloVeiculo( $res[0]['co_ModeloVeiculo'] );
			
			return true;
		}else{				
			return false;
		}
	}	

	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarModeloVeiculoAutoCompleteJSON(ModeloVeiculo $ModeloVeiculo) {
	
		$arrayCampos = array(
			"co_modelo_veiculo",
			"no_modelo_veiculo"
		);
	
		$res = $this->connBanco->selecionar("tb_modelo_veiculo", $arrayCampos, "no_modelo_veiculo like '%" . $ModeloVeiculo->getNoModeloVeiculo() . "%'", "", "", "", FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
	
}