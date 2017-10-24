<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class FuncionarioDAO extends Db {
	
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
	public function gravarFuncionario(Funcionario $Funcionario){
		
		if($this->verificarExistenciaFuncionario($Funcionario)){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$Funcionario->setDtHrRegistro("CURRENT_TIMESTAMP");
			$arr = $Funcionario->iterarObjeto();
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
			$this->connBanco->alterar("tb_funcionario", $campos, "co_pessoa=" . $Funcionario->getCoPessoa(), FALSE );
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$Funcionario->setDtHrRegistro("CURRENT_TIMESTAMP");
			$arr = $Funcionario->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$id_pessoa = $this->connBanco->inserir("tb_funcionario", $campos, $valores, FALSE);
			
			$Funcionario->setCoPessoa($id_pessoa);
			
		}
		

	}
	
	

	/**
	 * Lista uma pessoa caso ela exista no banco dado chave primária ou CPF
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	private function verificarExistenciaFuncionario(Funcionario $Funcionario) {
		$arrayCampos = array(
			"co_pessoa"
		);
	
		$where = "co_pessoa = " . $Funcionario->getCoPessoa();
		$res = $this->connBanco->selecionar( "tb_funcionario", $arrayCampos, $where, NULL, NULL, NULL, FALSE );
	
		if($res){
			return $res[0]['co_pessoa'];
		}else{
			return false;
		}
	}
	
	/**
	 * Lista uma pessoa caso ela exista no banco dado chave primária ou CPF
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarFuncionarioJSON(Funcionario $Funcionario) {
		$arrayCampos = array(
				"p.co_pessoa",
				"p.no_pessoa",
				"p.ds_foto",
				"DATE_FORMAT(p.dt_nascimento,'%d/%m/%Y') AS dt_nascimento",
				"p.nu_rg",
				"INSERT( INSERT( INSERT( p.nu_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) AS nu_cpf",
				"f.co_cargo_funcionario",
				"f.no_empresa_contratante",
				"f.st_ativo",
				"DATE_FORMAT(f.dt_entrada,'%d/%m/%Y') AS dt_entrada",
				"DATE_FORMAT(f.dt_saida,'%d/%m/%Y') AS dt_saida"				
		);
	
		$tabelas = "tb_pessoa AS p INNER JOIN tb_funcionario AS f ON f.co_pessoa=p.co_pessoa";
		$where=null;
		if($Funcionario->getCoPessoa() > 0){
			$where = "p.co_pessoa = " . $Funcionario->getCoPessoa();
		}
		$res = $this->connBanco->selecionar( $tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE );
	
		if($res){
			return $res;
		}else{
			return false;
		}
	}
	
	/**
	 * Lista uma pessoa caso ela exista no banco dado chave primária ou CPF
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarFuncionariosJSON() {
		$arrayCampos = array(
				"p.co_pessoa",
				"p.no_pessoa",
				"p.ds_foto",
				"DATE_FORMAT(p.dt_nascimento,'%d/%m/%Y') AS dt_nascimento",
				"p.nu_rg",
				"INSERT( INSERT( INSERT( p.nu_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) AS nu_cpf",
				"cf.no_cargo_funcionario",
				"f.no_empresa_contratante",
				"f.st_ativo",
				"DATE_FORMAT(f.dt_entrada,'%d/%m/%Y') AS dt_entrada",
				"DATE_FORMAT(f.dt_saida,'%d/%m/%Y') AS dt_saida"				
		);
	
		$tabelas = "tb_pessoa AS p
				INNER JOIN tb_funcionario AS f ON f.co_pessoa=p.co_pessoa
				LEFT JOIN tb_cargo_funcionario AS cf ON cf.co_cargo_funcionario=f.co_cargo_funcionario";
		$where="f.st_ativo IS TRUE";
		$res = $this->connBanco->selecionar( $tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE );
	
		if($res){
			return $res;
		}else{
			return false;
		}
	}	
	
	/**
	 * lista as pessoas em formato JSON para autocomplete
	 * @param Pessoa $Pessoa
	 * @return boolean|unknown[]|boolean
	 */
	public function listarFuncionariosAutoCompleteJSON(Pessoa $Pessoa){
	
		$arrayCampos = array(
				"co_pessoa",
				"no_pessoa"
		);
			
		$res = $this->connBanco->selecionar("tb_pessoa", $arrayCampos, "no_pessoa like '%" . $Pessoa->getNoPessoa(). "%'", "", "", "", FALSE);
			
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}	
	
}