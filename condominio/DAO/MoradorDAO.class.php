<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class MoradorDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	

	/**
	 * Grava pessoas na tabela de pessoas
	 * 
	 * @param Pessoa $Pessoa
	 */
	public function gravarMorador(Morador $Morador){
		
			if( $this->existeMorador($Morador) ){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$Morador->setDtHrRegistro("CURRENT_TIMESTAMP");
			$arr = $Morador->iterarObjeto();
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
			if($campos['co_pessoa']){
				array_shift($campos);
			}
			if($campos['co_unidade']){
				array_shift($campos);
			}			
			
			$this->connBanco->alterar("tb_morador", $campos, "co_pessoa=" . $Morador->getCoPessoa() . " AND co_unidade=" . $Morador->getCoUnidade(), FALSE );
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$arr = $Morador->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$id_pessoa = $this->connBanco->inserir("tb_morador", $campos, $valores, FALSE);
			
			$Morador->setCoPessoa($id_pessoa);
			
		}
	}

	
	
	/**
	 * Lista um morador de uma unidade dado o 
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarMorador(Morador $Morador) {
		
		$arrayCampos = array(
			"co_pessoa",
			"co_unidade",
			"co_tipo_morador",
			"co_profissao",
			"dt_inicio",
			"dt_fim",
			"st_ativo",
			"dt_hr_registro"
		);
		$res = $this->connBanco->selecionar( "tb_morador", $arrayCampos, "co_pessoa=" . $Morador->getCoPessoa() . " AND co_unidade=" . $Morador->getCoUnidade(), NULL, NULL, NULL, FALSE );
	
		if($res){
			$Morador->setCoPessoa ( $res[0]['co_pessoa'] );
			$Morador->setCoProfissao($res[0]['co_profissao']);
			$Morador->setCoTipoMorador($res[0]['co_tipo_morador']);
			$Morador->setCoUnidade($res[0]['co_unidade']);
			$Morador->setDtFim($res[0]['dt_fim']);
			$Morador->setDtInicio($res[0]['dt_inicio']);
			$Morador->setDtHrRegistro($res[0]['dt_hr_registro']);
			$Morador->setStAtivo($res[0]['st_ativo']);
			
			return true;
		}else{				
			return false;
		}
		

	}
	
	
	/**
	 * Lista um morador de uma unidade dado o
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarMoradoresDaUnidade(Morador $Morador) {
		$arrayCampos = array(
				"co_pessoa",
				"co_unidade",
				"co_tipo_morador",
				"co_profissao",
				"dt_inicio",
				"dt_fim",
				"st_ativo",
				"dt_hr_registro"
		);
		$res = $this->connBanco->selecionar( "tb_morador", $arrayCampos, "co_unidade=" . $Morador->getCoUnidade() . " AND st_ativo IS TRUE", NULL, NULL, NULL, FALSE );

		if($res){
			return $res;
		}else{
			return false;
		}
	
	}
	
	
	/**
	 * Verifica se existe um morador de uma unidade dado o
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function existeMorador(Morador $Morador) {
	
		$arrayCampos = array(
				"co_pessoa"
		);
		
		$res=false;
		if($Morador->getCoPessoa() != NULL){
			$res = $this->connBanco->selecionar( "tb_morador", $arrayCampos, "co_pessoa=" . $Morador->getCoPessoa() . " AND co_unidade=" . $Morador->getCoUnidade(), NULL, NULL, NULL, FALSE );
		}
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * Lista um morador de uma unidade dado o
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarMoradoresPorUnidadeJSON($co_unidade) {
	
		$arrayCampos = array(
			"tm.no_tipo_morador",
			"pe.no_pessoa AS 'Nome'",
			"COALESCE(pe.ds_foto,'---') AS 'Foto'",
			"tm.no_tipo_morador AS 'Tipo morador'",
			"COALESCE(pro.no_profissao,'<small><i>Não preenchido</i></small>') AS 'Profissão'"
		);
		
		$criterio = "mo.co_unidade= " . $co_unidade . " AND mo.st_ativo IS TRUE";
		$tabelas = "tb_morador AS mo
			INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
			INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade
			INNER JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=mo.co_tipo_morador
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
			INNER JOIN tb_torre AS tr ON tr.co_torre=u.co_torre
			LEFT JOIN tb_profissao AS pro ON pro.co_profissao=mo.co_profissao";
		
		$res = $this->connBanco->selecionar( $tabelas, $arrayCampos, $criterio, NULL, NULL, NULL, FALSE );
	
		if($res){
			return $res;
		}else{
			return false;
		}
	
	}
	
	/**
	 * Lista um morador de uma unidade dado o
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarMoradoresPorTorre() {
	
		$arrayCampos = array(
				"CONCAT('Torre ', u.co_torre) AS torre",
				"u.nu_numero AS unidade",
				"tm.no_tipo_morador",
				"pe.no_pessoa",
				"INSERT( INSERT( INSERT( pe.nu_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) AS nu_cpf",
				"pe.nu_rg",
				"DATE_FORMAT(pe.dt_nascimento,'%d/%m/%Y') AS dt_nascimento",
				"DATE_FORMAT(mo.dt_inicio,'%d/%m/%Y') AS dt_inicio",
				"p.no_profissao"
		);
		$tabelas="tb_morador AS mo
					INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
					INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade
					INNER JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=mo.co_tipo_morador
					INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
					INNER JOIN tb_torre AS tr ON tr.co_torre=u.co_torre
					LEFT JOIN tb_profissao AS p ON p.co_profissao=mo.co_profissao";
		
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, "mo.st_ativo IS TRUE", NULL, "u.co_torre ASC, u.nu_numero ASC, pe.no_pessoa ASC", NULL, FALSE);
	
		return $res;
	
	}
	
	/**
	 * Lista um morador de uma unidade dado o
	 * codigo da pessoa e codigo da unidade
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarMoradoresPorUnidadeNaoUsuariosJSON($co_unidade) {
	
		$arrayCampos = array(
				"pe.no_pessoa",
				"pe.co_pessoa",
				"pe.nu_cpf",
				"pe.nu_rg",
				"usu.ds_login"
		);
	
		$criterio = "mo.co_unidade= " . $co_unidade . " AND mo.st_ativo IS TRUE";
		$tabelas = "tb_morador AS mo
					INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
					LEFT JOIN tb_usuario AS usu ON usu.co_pessoa=pe.co_pessoa";
		$res = $this->connBanco->selecionar( $tabelas, $arrayCampos, $criterio, NULL, NULL, NULL, FALSE );
	
		if($res){
			return $res;
		}else{
			return false;
		}
	
	}
	
	/**
	 * Lista emails dos moradores de uma unidade
	 *
	 * @param $co_unidade
	 * @return <ListaCorreiosDiarioRelatorio>
	 */
	public function listarEmailMoradores($co_unidade) {
	    
	    $arrayCampos = array(
	        "mo.co_pessoa",
	        "mo.co_unidade",
	        "co.ds_contato",
	        "mnf.st_autorizado"
	    );
	    
	    $criterio = "mo.co_unidade= " . $co_unidade . " AND mo.st_ativo IS TRUE";
	    
	    $tabelas = "tb_morador AS mo
					INNER JOIN tb_contato AS co ON co.co_pessoa=mo.co_pessoa AND co.co_tipo_contato = 3 AND co.st_ativo IS TRUE
                    LEFT JOIN tb_morador_notificacao AS mnf ON mnf.co_pessoa = mo.co_pessoa AND mnf.co_unidade=mo.co_unidade";
	    $res = $this->connBanco->selecionar( $tabelas, $arrayCampos, $criterio, NULL, NULL, NULL, FALSE );
	    
	    if($res){
	        return $res;
	    }else{
	        return false;
	    }
	    
	}
	
	
	/**
	 * Lista um morador de uma unidade dado o CPF
	 *
	 * @param CPF
	 * @return Pessoa
	 */
	public function listarMoradorPorCPFJSON($cpf) {
	    
	    $arrayCampos = array(
	        "pe.co_pessoa",
	        "pe.no_pessoa",
	        "pe.nu_cpf",
	        "pe.nu_rg"
	    );
	    
	    $criterio = "mo.st_ativo IS TRUE";
	    $tabelas = "tb_morador AS mo
					INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa AND pe.nu_cpf='" . $cpf . "'";
	    $res = $this->connBanco->selecionar( $tabelas, $arrayCampos, $criterio, NULL, NULL, NULL, FALSE );
	    
	    if($res){
	        return $res;
	    }else{
	        return false;
	    }
	    
	}
	
}