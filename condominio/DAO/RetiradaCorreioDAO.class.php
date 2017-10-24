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
	
}