<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class AnimalDomesticoDAO extends Db {
	
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
	public function gravarAnimalDomestico(AnimalDomestico $AnimalDomestico){
		
		if($AnimalDomestico->getCoAnimalDomestico() != null){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$AnimalDomestico->setDtHrRegistro("NOW()");
			$arr = $AnimalDomestico->iterarObjeto();
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
			if($campos['co_animal_domestico']){
				array_shift($campos);
			}
			
			$this->connBanco->alterar("tb_animal_domestico", $campos, "co_animal_domestico=" . $AnimalDomestico->getCoAnimalDomestico(), FALSE );
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$arr = $AnimalDomestico->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$co_animal_domestico = $this->connBanco->inserir("tb_animal_domestico", $campos, $valores, FALSE);
			
			$AnimalDomestico->setCoAnimalDomestico($co_animal_domestico);
			
		}
		

	}

	
	
	/**
	 * Lista um morador de uma unidade dado o 
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarAnimalDomestico(AnimalDomestico $AnimalDomestico) {
		$arrayCampos = array(	
			"co_animal_domestico",
			"co_unidade",
			"co_tipo_animal",
			"co_raca",
			"ds_cor",
			"ds_nome",
			"ds_foto",
			"st_ativo",
			"dt_hr_registro"
		);
		$res = $this->connBanco->selecionar( "tb_animal_domestico", $arrayCampos, "co_animal_domestico=" . $AnimalDomestico->getCoAnimalDomestico(), NULL, NULL, NULL, FALSE );
	
		if($res){
			$AnimalDomestico->setCoAnimalDomestico( $res[0]['co_animal_domestico'] );
			
			return true;
		}else{				
			return false;
		}
	}	

	/**
	 * Lista os dados de um animal domestico caso ele exista no banco dado id
	 *
	 * @param Usuario $Usuario
	 */
	public function listarAnimalDomesticoJSON(AnimalDomestico $AnimalDomestico) {
	
		$arrayCampos = array(
			"a.co_animal_domestico",
			"a.co_raca",
			"a.ds_cor",
			"a.ds_nome",
			"a.co_tipo_animal",
			"a.ds_foto",
			"r.no_raca"
		);
		$tabelas = "tb_animal_domestico AS a INNER JOIN tb_raca AS r ON r.co_raca=a.co_raca";	
		
		$res = $this->connBanco->selecionar($tabelas ,$arrayCampos, "a.co_animal_domestico=".$AnimalDomestico->getCoAnimalDomestico(), NULL, NULL, NULL, FALSE );
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
	/**
	 * Lista os dados de um animal domestico caso ele exista no banco dado id
	 *
	 * @param Usuario $Usuario
	 */
	public function listarAnimaisPorUnidadeJSON($co_unidade) {
	
		$arrayCampos = array(
			"ad.ds_nome AS 'Nome'",
			"COALESCE(ad.ds_foto,'---') AS 'Foto'",
			"ta.no_tipo_animal AS 'Tipo'",
			"r.no_raca AS 'Raça'",
			"ad.ds_cor AS 'Cor'"
		);
		$criterio = "ad.co_unidade =" . $co_unidade . " AND ad.st_ativo IS TRUE";
		$tabelas = "tb_animal_domestico AS ad
					INNER JOIN tb_unidade AS u ON u.co_unidade=ad.co_unidade
					INNER JOIN tb_tipo_animal AS ta ON ta.co_tipo_animal=ad.co_tipo_animal
					INNER JOIN tb_raca AS r ON r.co_raca=ad.co_raca";
		
		$res = $this->connBanco->selecionar($tabelas ,$arrayCampos, $criterio, NULL, NULL, NULL, FALSE );
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
}