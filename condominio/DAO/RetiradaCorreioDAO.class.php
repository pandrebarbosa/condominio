<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class RetiradaCorreioDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	

	
	/**
	 * Grava correios na tabela de correios
	 *
	 * @param ModeloVeiculo $ModeloVeiculo
	 */
	public function gravarRetiradaCorreio(RetiradaCorreio $RetiradaCorreio){
	
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$RetiradaCorreio->setDtHrRegistro("CURRENT_TIMESTAMP");
		$arr = $RetiradaCorreio->iterarObjeto();
		$i=0;
		foreach ($arr as $k=>$val){
			if($val != null){
				$campos[$i] = $k;
				$valores[$i] = $val;
			}
			$i++;
		}
	
		$co_item = $this->connBanco->inserir("tb_retirada_correio", $campos, $valores, FALSE);
	
	}
	
	/**
	 * Grava retiradas em lote
	 *
	 * @param Array $listaRetiradas
	 */
	public function gravarListaRetiradaCorreio($listaRetiradas){
	    
	    foreach($listaRetiradas as $key => $RetiradaCorreio){
	        $campos=array();
	        $valores=array();
	        $arr = $RetiradaCorreio->iterarObjeto();
	        $i=0;
	        foreach ($arr as $k=>$val){
	            if($val != null){
	                $campos[$i] = $k;
	                $valores[$i] = $val;
	            }
	            $i++;
	        }
	        $co_item = $this->connBanco->inserir("tb_retirada_correio", $campos, $valores, FALSE);
	    }
	}
	
	
	/**
	 * Lista os dados de uma retirada caso exista
	 * @param RetiradaCorreio $RetiradaCorreio
	 * @return boolean|unknown[]|boolean
	 */
	public function listaRetiradaCorreio(RetiradaCorreio $RetiradaCorreio) {
	    $arrayCampos = array(
	        "co_item_correio",
	        "co_funcionario_retirada",
	        "co_pessoa_retirada",
	        "co_unidade_retirada",
	        "dt_hr_retirada",
	        "ds_observacao",
	        "dt_hr_registro",
	        "st_ativo"
	    );
	    $res = $this->connBanco->selecionar( "tb_retirada_correio", $arrayCampos, "st_ativo IS TRUE AND co_item_correio=" . $RetiradaCorreio->getCoItemCorreio(), NULL, NULL, NULL, FALSE );
	    if($res){       
	        return $res;
	    }else{
	        return false;
	    }
	    
	    
	}
	
}