<?php
class Pessoa {
	
	private $co_pessoa;
	private $no_pessoa;
	private $dt_nascimento;
	private $ds_foto;
	private $nu_cpf;
	private $nu_rg;
	private $dt_hr_registro;
	private $st_foto_publica;
	private $co_pessoa_registro;
	
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
	
	public function getCoPessoa() {
		return $this->co_pessoa;
	}
	public function setCoPessoa($co_pessoa) {
		$this->co_pessoa = $co_pessoa;
		return $this;
	}
	public function getNoPessoa() {
		return $this->no_pessoa;
	}
	public function setNoPessoa($no_pessoa) {
		$this->no_pessoa = $no_pessoa;
		return $this;
	}
	public function getDtNascimento() {
		return $this->dt_nascimento;
	}
	public function setDtNascimento($dt_nascimento) {
		$this->dt_nascimento = $dt_nascimento;
		return $this;
	}
	public function getDsFoto() {
		return $this->ds_foto;
	}
	public function setDsFoto($ds_foto) {
		$this->ds_foto = $ds_foto;
		return $this;
	}
	public function getNuCpf() {
		return $this->nu_cpf;
	}
	public function setNuCpf($nu_cpf) {
		$this->nu_cpf = $nu_cpf;
		return $this;
	}
	public function getNuRg() {
		return $this->nu_rg;
	}
	public function setNuRg($nu_rg) {
		$this->nu_rg = $nu_rg;
		return $this;
	}
	
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
		
		return $arrayRetorno;
	}
	public function getDtHrRegistro() {
		return $this->dt_hr_registro;
	}
	public function setDtHrRegistro($dt_hr_registro) {
		$this->dt_hr_registro = $dt_hr_registro;
		return $this;
	}
	public function getCoPessoaRegistro() {
		return $this->co_pessoa_registro;
	}
	public function setCoPessoaRegistro($co_pessoa_registro) {
		$this->co_pessoa_registro = $co_pessoa_registro;
		return $this;
	}
	public function getStFotoPublica() {
		return $this->st_foto_publica;
	}
	public function setStFotoPublica($st_foto_publica) {
		$this->st_foto_publica = $st_foto_publica;
		return $this;
	}
	
	
	
}


