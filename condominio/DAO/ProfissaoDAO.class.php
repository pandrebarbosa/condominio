<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class ProfissaoDAO extends Db {
	
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
	public function gravarProfissao(Profissao $Profissao){
		
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$arr = $Profissao->iterarObjeto();
		$i=0;
		foreach ($arr as $k=>$val){
			if($val != null){
				$campos[$i] = $k;
				$valores[$i] = $val;
			}
			$i++;
		}
		
		$co_profissao = $this->connBanco->inserir("tb_profissao", $campos, $valores, FALSE);
		
		$Profissao->setCoProfissao($co_profissao);

	}


	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarProfissaoAutoCompleteJSON(Profissao $Profissao) {
	
		$arrayCampos = array(
			"co_profissao",
			"no_profissao"
		);
	
		$res = $this->connBanco->selecionar("tb_profissao", $arrayCampos, "no_profissao like '%" . $Profissao->getNoProfissao() . "%'", "", "", "", FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
	
}