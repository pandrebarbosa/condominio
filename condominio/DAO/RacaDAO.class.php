<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class RacaDAO extends Db {
	
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
	 * @param AnimalDomestico $AnimalDomestico
	 */
	public function gravarRaca(Raca $Raca){
		
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$arr = $Raca->iterarObjeto();
		$i=0;
		foreach ($arr as $k=>$val){
			if($val != null){
				$campos[$i] = $k;
				$valores[$i] = $val;
			}
			$i++;
		}
		$id_raca = $this->connBanco->inserir("tb_raca", $campos, $valores, FALSE);
		
		$Raca->setCoRaca($id_raca);
	}

	
	
	/**
	 * Lista as raças caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarRacaAutoCompleteJSON(Raca $Raca) {
	
		$arrayCampos = array(
			"co_raca",
			"no_raca"
		);
	
		$res = $this->connBanco->selecionar("tb_raca", $arrayCampos, "no_raca like '%" . $Raca->getNoRaca() . "%'", "", "", "", FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
}