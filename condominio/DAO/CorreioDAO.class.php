<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class CorreioDAO extends Db {
	
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
	public function gravarCorreio(Correio $Correio){
	
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$Correio->setDtHrRegistro("CURRENT_TIMESTAMP");
		$arr = $Correio->iterarObjeto();
		$i=0;
		foreach ($arr as $k=>$val){
			if($val != null){
				$campos[$i] = $k;
				$valores[$i] = $val;
			}
			$i++;
		}
	
		$co_item = $this->connBanco->inserir("tb_correio", $campos, $valores, FALSE);
	
		$Correio->setCoItemCorreio($co_item);
	
	}
	
	
	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarEntradaCorresnpodenciaJSON(Correio $Correio) {
	
		$arrayCampos = array(
			"c.co_item_correio,CONCAT(tic.no_tipo_item_correio,' / ',c.ds_item) AS 'item'",
			"CONCAT('Torre ',u.co_torre,' unidade ',u.nu_numero) AS 'unidade'",
			"CONCAT('Torre ',u.co_torre,' ',tu.sg_sigla_unidade,' ',u.nu_numero) AS 'unidade_impressora'",
			"p.no_pessoa AS 'recebedor'",
			"DATE_FORMAT(c.dt_hr_chegada,'%d/%m/%Y %H:%i') AS 'dt_hr_chegada'",
			"c.ds_observacao"
		);
		$tabelas = "tb_correio AS c
		    INNER JOIN tb_tipo_item_correio AS tic ON tic.co_tipo_item_correio=c.co_tipo_item_correio
			INNER JOIN tb_pessoa AS p ON p.co_pessoa=c.co_funcionario_recebimento
			INNER JOIN tb_unidade AS u ON u.co_unidade=c.co_unidade
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade";
		$where=null;
		if($Correio->getCoItemCorreio()>0){
			$where = "c.co_item_correio=" . $Correio->getCoItemCorreio();
		}
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE);	
		
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarCorreioDisponivelPorUnidade($co_unidade) {
	
		$arrayCampos = array(
		    "c.co_item_correio",
		    "c.ds_item",
		    "p.no_pessoa",
		    "DATE_FORMAT(c.dt_hr_chegada,'%d/%m/%Y %H:%i') AS 'dt_hr_chegada'",
		    "DATE_FORMAT(rc.dt_hr_retirada,'%d/%m/%Y %H:%i') AS 'dt_hr_retirada'"
		);
		
		$tabelas = "tb_correio AS c
		            LEFT JOIN tb_retirada_correio AS rc ON rc.co_item_correio=c.co_item_correio
		            INNER JOIN tb_pessoa AS p ON p.co_pessoa=c.co_funcionario_recebimento";
		$where = "c.st_ativo IS TRUE AND c.co_unidade=" . $co_unidade;
		$orderby="c.dt_hr_chegada DESC";
		
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, "", $orderby, "", FALSE);	
		
		if($res){
		    return $res;
		}else{
			return false;
		}
	}
	
	
	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarEntradaCorrespondenciaDiariaJSON($data=NULL) {
	
		$arrayCampos = array(
				"c.co_item_correio,CONCAT(tic.no_tipo_item_correio,' ',c.ds_item) AS 'item'",
				"CONCAT('Torre ',u.co_torre,' unidade ',u.nu_numero) AS 'unidade'",
				"p.no_pessoa AS 'recebedor'",
				"DATE_FORMAT(c.dt_hr_chegada,'%d/%m/%Y %H:%i') AS 'dt_hr_chegada'",
				"DATE_FORMAT(c.dt_hr_chegada,'%H:%i') AS 'hr_chegada'",
				"c.ds_observacao",
				"cf.no_cargo_funcionario"
		);
	
		$tabelas = "tb_correio AS c
		    INNER JOIN tb_tipo_item_correio AS tic ON tic.co_tipo_item_correio=c.co_tipo_item_correio
			INNER JOIN tb_pessoa AS p ON p.co_pessoa=c.co_funcionario_recebimento
			INNER JOIN tb_funcionario AS f ON f.co_pessoa=p.co_pessoa
			INNER JOIN tb_cargo_funcionario AS cf ON cf.co_cargo_funcionario=f.co_cargo_funcionario
			INNER JOIN tb_unidade AS u ON u.co_unidade=c.co_unidade";
		
		if($data == null){
			//Pega as correspondeicias do dia de hoje
			$dataBusca = "NOW()";
		}else{
			//Caso contrário, pega o da data fornecida
			$dataBusca = "'".$data."'";
		}

		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, "DATE_FORMAT(c.dt_hr_chegada,'%Y/%m/%d') = date(".$dataBusca.")", "", "", "", FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarRelatorioGeralCorrespondenciasJSON() {
	
		$arrayCampos = array(
				"c.co_item_correio,CONCAT(tic.no_tipo_item_correio,' ',c.ds_item) AS 'item'",
				"CONCAT('Torre ',u.co_torre,' unidade ',u.nu_numero) AS 'unidade'",
				"p.no_pessoa AS 'recebedor'",
				"DATE_FORMAT(c.dt_hr_chegada,'%d/%m/%Y %H:%i') AS 'dt_hr_chegada'",
				"COALESCE(DATE_FORMAT(rc.dt_hr_retirada,'%d/%m/%Y %H:%i'), 'Não retirado') AS 'dt_hr_retirada'",
				"c.ds_observacao",
				"cf.no_cargo_funcionario",
				"rc.ds_observacao AS ds_retirada"
		);
	
		$tabelas = "tb_correio AS c
		    INNER JOIN tb_tipo_item_correio AS tic ON tic.co_tipo_item_correio=c.co_tipo_item_correio
			INNER JOIN tb_pessoa AS p ON p.co_pessoa=c.co_funcionario_recebimento
			INNER JOIN tb_funcionario AS f ON f.co_pessoa=p.co_pessoa
			INNER JOIN tb_cargo_funcionario AS cf ON cf.co_cargo_funcionario=f.co_cargo_funcionario
			INNER JOIN tb_unidade AS u ON u.co_unidade=c.co_unidade
			LEFT JOIN  tb_retirada_correio AS rc ON rc.co_item_correio=c.co_item_correio";

		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, NULL, "", "c.dt_hr_chegada ASC", "", FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}	

	/**
	 * Altera a tabela de contato para st_ativo = false
	 *
	 * @param Contato $Contato
	 */
	public function excluirCorresnpodencia(Correio $Correio){
	
		$campos = array(
				"st_ativo" => 0,
				"dt_hr_registro" => "CURRENT_TIMESTAMP"
		);
		$this->connBanco->alterar("tb_correio", $campos, "co_item_correio=" . $Correio->getCoItemCorreio(), FALSE );
	
	}
	
	
	public function  verificarSeCorrespondenciaFoiRetirada($co_itemCorreio){
	    
	    $arrayCampos = array(
	        "rc.co_item_correio",
	        "p.no_pessoa AS recebedor",
	        "rc.ds_observacao AS ds_retirada",
	        "DATE_FORMAT(rc.dt_hr_retirada,'%d/%m/%Y %H:%i') AS dt_hr_retirada",
	    );
	    
	    $tabelas = "tb_retirada_correio AS rc INNER JOIN tb_pessoa AS p ON p.co_pessoa=rc.co_funcionario_retirada";
	    
	    $res = $this->connBanco->selecionar($tabelas, $arrayCampos, "rc.co_item_correio=" . $co_itemCorreio, NULL, NULL, "", FALSE);
	    
	    if ($res) {
	        return $res;
	    } else {
	        return false;
	    }
	}
}