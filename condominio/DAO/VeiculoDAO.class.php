<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class VeiculoDAO extends Db {
	
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
	 * @param Veiculo $Veiculo
	 */
	public function gravarVeiculo(Veiculo $Veiculo){
		
		if($Veiculo->getCoVeiculo() != null){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$Veiculo->setDtHrRegistro("NOW()");
			$arr = $Veiculo->iterarObjeto();
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
			if($campos['co_veiculo']){
				array_shift($campos);
			}
			
			$this->connBanco->alterar("tb_veiculo", $campos, "co_veiculo=" . $Veiculo->getCoVeiculo(), FALSE );
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$arr = $Veiculo->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$co_veiculo = $this->connBanco->inserir("tb_veiculo", $campos, $valores, FALSE);
			
			$Veiculo->setCoVeiculo($co_veiculo);
			
		}
		

	}

	
	
	/**
	 * Lista um morador de uma unidade dado o 
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarVeiculo(Veiculo $Veiculo) {
		$arrayCampos = array(	
			"co_veiculo",
			"co_unidade",
			"co_tipo_animal",
			"co_raca",
			"ds_cor",
			"ds_nome",
			"ds_foto",
			"st_ativo",
			"dt_hr_registro"
		);
		$res = $this->connBanco->selecionar( "tb_veiculo", $arrayCampos, "co_veiculo=" . $Veiculo->getCoVeiculo(), NULL, NULL, NULL, FALSE );
	
		if($res){
			$Veiculo->setCoVeiculo( $res[0]['co_veiculo'] );
			
			return true;
		}else{				
			return false;
		}
	}	

	/**
	 * Lista os dados de um veciulo caso ele exista no banco dado id
	 *
	 * @param Usuario $Usuario
	 */
	public function listarVeiculoJSON(Veiculo $Veiculo) {
	
		$arrayCampos = array(
			"v.co_veiculo",
			"mv.no_modelo_veiculo",
			"v.co_vaga",
			"v.ds_cor",
			"v.ds_placa",
			"v.co_tipo_veiculo",
			"u.nu_numero",
			"v.co_modelo_veiculo",
			"u.co_tipo_unidade"
		);
		
		$tabelas = "tb_veiculo AS v
					INNER JOIN tb_unidade AS u ON v.co_vaga=u.co_unidade
					LEFT JOIN tb_modelo_veiculo AS mv ON mv.co_modelo_veiculo=v.co_modelo_veiculo";
		$res = $this->connBanco->selecionar($tabelas ,$arrayCampos, "v.co_veiculo=".$Veiculo->getCoVeiculo(), NULL, NULL, NULL, FALSE );
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
	/**
	 * Lista os dados de um veciulo caso ele exista no banco dado id
	 *
	 * @param Usuario $Usuario
	 */
	public function listarVeiculosPorUnidadeJSON($co_unidade) {
	
		$arrayCampos = array(
			"v.co_veiculo",
			"vg.nu_numero AS 'Vaga'",
			"v.ds_cor,UPPER(v.ds_placa) AS 'Placa'",
			"tv.no_tipo_veiculo AS 'Tipo'",
			"mv.no_modelo_veiculo AS 'Nome/Modelo'"
		);
		
		$tabelas = "tb_veiculo AS v
			INNER JOIN tb_unidade AS u ON u.co_unidade=v.co_unidade
			LEFT  JOIN tb_unidade AS vg ON v.co_vaga=vg.co_unidade
			INNER JOIN tb_tipo_veiculo AS tv ON tv.co_tipo_veiculo=v.co_tipo_veiculo
			INNER JOIN tb_modelo_veiculo AS mv ON mv.co_modelo_veiculo=v.co_modelo_veiculo";		
		$criterio = "u.co_unidade =" . $co_unidade . " AND v.st_ativo IS TRUE";
		
		$res = $this->connBanco->selecionar($tabelas ,$arrayCampos, $criterio, NULL, NULL, NULL, FALSE );
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
	/**
	 * Lista a quantidade de veiculos
	 *
	 */
	public function listarQuantidadeVeiculoJSON() {
	
		$arrayCampos = array(
			"CONCAT(u.co_torre,u.nu_numero) AS 'Unidade'",
			"COUNT(v.co_veiculo) AS 'Total'"
		);
	
		$tabelas = "tb_veiculo AS v
			INNER JOIN tb_unidade AS u ON u.co_unidade=v.co_unidade
			WHERE v.st_ativo IS TRUE AND u.co_torre IS NOT NULL";
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, NULL, "v.co_unidade", "total DESC, unidade ASC", NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
		
	}	
	

	
	/**
	 * Altera a tabela de veiculo para st_ativo = false
	 *
	 * @param Veiculo $Veiculo
	 */
	public function excluirVeiculo(Veiculo $Veiculo){
	
		$campos = array(
				"st_ativo" => 0,
				"dt_hr_registro" => "NOW()"
		);
		$this->connBanco->alterar("tb_veiculo", $campos, "co_veiculo=" . $Veiculo->getCoVeiculo(), FALSE );
	
	}
	
}