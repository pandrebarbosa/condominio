<?php

class Funcionario{
	
	private $co_pessoa;
	private $co_cargo_funcionario;
	private $no_empresa_contratante;
	private $st_ativo;
	private $co_pessoa_registro;
	private $dt_hr_registro;
	private $dt_entrada;
	private $dt_saida;

	public function __construct($post=null) {
		if($post != null){
			foreach ($post as $keyPost=>$valPost){
				foreach ( $this as $keyObj => $valueObj ) {
					if($keyPost == $keyObj){
						$this->$keyObj = $valPost;
					}
				}
			}
		}
	}
	
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
	}
	
	public function getCoPessoa() {
		return $this->co_pessoa;
	}
	public function setCoPessoa($co_pessoa) {
		$this->co_pessoa = $co_pessoa;
		return $this;
	}
	public function getCoCargoFuncionario() {
		return $this->co_cargo_funcionario;
	}
	public function setCoCargoFuncionario($co_cargo_funcionario) {
		$this->co_cargo_funcionario = $co_cargo_funcionario;
		return $this;
	}
	public function getStAtivo() {
		return $this->st_ativo;
	}
	public function setStAtivo($st_ativo) {
		$this->st_ativo = $st_ativo;
		return $this;
	}
	public function getDtHrRegistro() {
		return $this->dt_hr_registro;
	}
	public function setDtHrRegistro($dt_hr_registro) {
		$this->dt_hr_registro = $dt_hr_registro;
		return $this;
	}
	public function getNoEmpresaContratante() {
		return $this->no_empresa_contratante;
	}
	public function setNoEmpresaContratante($no_empresa_contratante) {
		$this->no_empresa_contratante = $no_empresa_contratante;
		return $this;
	}
	public function getCoPessoaRegistro() {
		return $this->co_pessoa_registro;
	}
	public function setCoPessoaRegistro($co_pessoa_registro) {
		$this->co_pessoa_registro = $co_pessoa_registro;
		return $this;
	}
	public function getDtEntrada() {
		return $this->dt_entrada;
	}
	public function setDtEntrada($dt_entrada) {
		$this->dt_entrada = $dt_entrada;
		return $this;
	}
	public function getDtSaida() {
		return $this->dt_saida;
	}
	public function setDtSaida($dt_saida) {
		$this->dt_saida = $dt_saida;
		return $this;
	}
	
}