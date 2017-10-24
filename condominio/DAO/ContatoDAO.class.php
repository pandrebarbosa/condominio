<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class ContatoDAO extends Db {
	
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
	public function gravarContato(Contato $Contato){
		
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$arr = $Contato->iterarObjeto();
		$i=0;
		foreach ($arr as $k=>$val){
			if($val != null){
				$campos[$i] = $k;
				$valores[$i] = $val;
			}
			$i++;
		}
		
		$this->connBanco->inserir("tb_contato", $campos, $valores, FALSE);

	}


	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarContatoJSON(Contato $Contato) {
	
		$arrayCampos = array(
			"c.co_contato",
			"c.co_pessoa",
			"tc.no_tipo_contato AS 'Tipo de contato'",
			"c.ds_contato AS 'Contato'"
		);
	
		$tabelas = "tb_contato AS c INNER JOIN tb_tipo_contato AS tc ON c.co_tipo_contato = tc.co_tipo_contato";
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, "c.co_pessoa =" . $Contato->getCoPessoa() . " AND c.st_ativo IS TRUE", "", "", "", FALSE);
	
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
	public function excluirContato(Contato $Contato){
	
		$campos = array(
				"st_ativo" => 0,
				"dt_hr_registro" => "CURRENT_TIMESTAMP"
		);
		$this->connBanco->alterar("tb_contato", $campos, "co_contato=" . $Contato->getCoContato() . " AND co_pessoa=" . $Contato->getCoPessoa(), FALSE );
	
	}
	
}