<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class PessoaDAO extends Db {
	
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
	public function gravarPessoa(Pessoa $Pessoa){
		
		if($Pessoa->getCoPessoa() != null){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$Pessoa->setDtHrRegistro("CURRENT_TIMESTAMP");
			$arr = $Pessoa->iterarObjeto();
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
			
			$this->connBanco->alterar("tb_pessoa", $campos, "co_pessoa=" . $Pessoa->getCoPessoa(), FALSE);
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */		
			$campos=array();
			$valores=array();
			$arr = $Pessoa->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$id_pessoa = $this->connBanco->inserir("tb_pessoa", $campos, $valores, FALSE);
			
			$Pessoa->setCoPessoa($id_pessoa);
			
		}
		

	}
	
	
	/**
	 * Lista uma pessoa caso ela exista no banco dado CPF e Nome
	 *
	 * @param Pessoa $Pessoa        	
	 * @return co_pessoa
	 */
	public function listarPessoaExistente(Pessoa $Pessoa) {
		
		$arrayCampos = array(
				"co_pessoa"
		);
		
		$res = $this->connBanco->selecionar( "tb_pessoa", $arrayCampos, "nu_cpf='" . $Pessoa->getNuCpf () . "' AND REPLACE(no_pessoa, ' ', '') like '%" . str_replace ( ' ', '', $Pessoa->getNoPessoa () ) . "%'", NULL, NULL, NULL, FALSE );

		if ($res) {
			/* Se já existe, carrega o objeto todo */
			$Pessoa->setCoPessoa($res[0]['co_pessoa']);
			$this->listarPessoa($Pessoa);
			
			return true;
		} else {
			/* Caso contrário, não carrega nada. */
			$Pessoa->setCoPessoa( null );
			
			return false;
		}
		
	}
	
	
	/**
	 * Lista uma pessoa caso ela exista no banco dado chave primária ou CPF
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarPessoa(Pessoa $Pessoa) {
		$arrayCampos = array(
				"co_pessoa",
				"no_pessoa",
				"ds_foto",
				"DATE_FORMAT(dt_nascimento,'%d/%m/%Y') AS dt_nascimento",
				"nu_rg",
				"INSERT( INSERT( INSERT( p.nu_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) AS nu_cpf"
		);
		
		if($Pessoa->getCoPessoa() == NULL){
			$where = "nu_cpf='" . $Pessoa->getNuCpf()."'";
		}else{
			$where = "co_pessoa=" . $Pessoa->getCoPessoa();
		}
		
		$res = $this->connBanco->selecionar( "tb_pessoa", $arrayCampos, $where, NULL, NULL, NULL, FALSE );
		if ($res) {
		    $Pessoa->setCoPessoa ( $res[0]['co_pessoa'] );
		    $Pessoa->setNoPessoa ( $res[0]['no_pessoa'] );
		    $Pessoa->setDsFoto($res[0]['ds_foto']);
		    $Pessoa->setDtNascimento($res[0]['dt_nascimento']);
		    $Pessoa->setNuRg($res[0]['nu_rg']);
		    $Pessoa->setNuCpf( $res[0]['nu_cpf'] );
		    
		    return true;
		} else {
		    return false;
		}
	}	

	/**
	 * Lista uma pessoa caso ela exista no banco dado chave primária ou CPF
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function listarPessoaJSON(Pessoa $Pessoa) {
		$arrayCampos = array(
				"co_pessoa",
				"no_pessoa",
				"ds_foto",
				"DATE_FORMAT(dt_nascimento,'%d/%m/%Y') AS dt_nascimento",
				"nu_rg",
				"INSERT( INSERT( INSERT( nu_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) AS nu_cpf"
		);
	
		if($Pessoa->getCoPessoa() == NULL){
			$where = "nu_cpf='" . $Pessoa->getNuCpf()."'";
		}else{
			$where = "co_pessoa=" . $Pessoa->getCoPessoa();
		}
	
		$res = $this->connBanco->selecionar( "tb_pessoa", $arrayCampos, $where, NULL, NULL, NULL, FALSE );
	
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
	public function listarPessoasProprietariosAutoCompleteJSON(Pessoa $Pessoa){
	
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