<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class UnidadeDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	
	/**
	 * Carrega a unidade dado Torre e numero da unidade
	 * @param Unidade $Unidade
	 */
	public function listarUnidade(Unidade $Unidade) {
		$arrayCampos = array(
				"co_unidade",
				"nu_numero",
				"co_tipo_unidade",
				"co_torre",
				"co_proprietario",
				"nu_metragem",
				"dt_aquisicao",
				"st_ativo",
				"dt_hr_registro"
		);	
		$res=$this->connBanco->selecionar("tb_unidade",$arrayCampos,
				"co_torre=". $Unidade->getCoTorre() ." AND nu_numero=" . $Unidade->getNuNumero(), NULL, NULL, NULL, FALSE);
		
		if ($res) {
			$Unidade->setCoUnidade( $res[0]['co_unidade'] );
			$Unidade->setCoProprietario( $res[0]['co_proprietario'] );
			$Unidade->setCoTipoUnidade( $res[0]['co_tipo_unidade'] );
			$Unidade->setCoTorre( $res[0]['co_torre'] );
			$Unidade->setCoUnidade( $res[0]['co_unidade'] );
			$Unidade->setDtAquisicao( $res[0]['dt_aquisicao'] );
			$Unidade->setDtHrRegistro( $res[0]['dt_hr_registro'] );
			$Unidade->setNuMetragem( $res[0]['nu_metragem'] );
			$Unidade->setNuNumero( $res[0]['nu_numero'] );
			$Unidade->setStAtivo( $res[0]['st_ativo'] );
			
			return true;
		} else {
			$Unidade->setCoUnidade(null);
				
			return false;
		}
	}
	
	
	/**
	 * Carrega a unidade dado Torre e numero da unidade
	 * @param Unidade $Unidade
	 */
	public function listarUnidadeJSON(Unidade $Unidade) {
		$arrayCampos = array(
				"un.co_unidade",
				"un.nu_numero",
				"un.co_tipo_unidade",
				"tu.no_tipo_unidade",
				"un.co_torre",
				"un.co_proprietario",
				"un.nu_metragem",
				"un.dt_aquisicao",
				"un.st_ativo",
				"un.dt_hr_registro"
		);
		
		$where = "st_ativo IS TRUE";
		if($Unidade->getCoTorre() != null){
			$where .= " AND co_torre=". $Unidade->getCoTorre();
		}
		if($Unidade->getNuNumero() != null){
			$where .= " AND nu_numero=" . $Unidade->getNuNumero();
		}
		$tabelas = "tb_unidade AS un INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=un.co_tipo_unidade";
		$res=$this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, "nu_numero ASC", NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
	/**
	 * Carrega a unidade dado Torre e numero da unidade
	 * @param Unidade $Unidade
	 */
	public function listarUnidadesPorMoradorJSON($co_morador) {
		
		$arrayCampos = array(
			"u.nu_numero",
				"tu.sg_sigla_unidade",
				"u.nu_numero",
				"tu.co_tipo_unidade",
				"tu.no_tipo_unidade",
				"p.no_pessoa AS morador",
				"p.co_pessoa",
				"tm.no_tipo_morador",
				"u.co_unidade",
				"t.no_torre"
		);
		
		$tabelas = "tb_morador AS m
			LEFT JOIN tb_unidade AS u ON m.co_unidade=u.co_unidade AND u.st_ativo IS TRUE
			LEFT JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
			LEFT JOIN tb_torre AS t ON t.co_torre=u.co_torre
			LEFT JOIN tb_pessoa AS p ON p.co_pessoa=m.co_pessoa
			LEFT JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=m.co_tipo_morador";
		$where = "m.co_pessoa = " . $co_morador;
		$res=$this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	

	/**
	 * Grava pessoas na tabela de usuários
	 * 
	 * @param Usuario $Usuario
	 */
	public function gravarUnidade(Unidade $Unidade){
		
		if($Unidade->getCoUnidade() != null){
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$Unidade->setDtHrRegistro("CURRENT_TIMESTAMP");
			$arr = $Unidade->iterarObjeto();
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
			if($campos['co_unidade']){
				array_shift($campos);
			}
		
			$this->connBanco->alterar("tb_unidade", $campos, "co_unidade=" . $Unidade->getCoUnidade(), FALSE );
		
		
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$arr = $Unidade->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
		
			$id_unidade = $this->connBanco->inserir("tb_unidade", $campos, $valores, FALSE);
		
			$Unidade->setCoUnidade($id_unidade);
		
		}		
		
	}

	
}