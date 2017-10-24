<?php
class Morador {
	
	private $co_pessoa;
	private $co_unidade;
	private $co_tipo_morador;
	private $co_profissao;
	private $dt_inicio;
	private $dt_fim;
	private $st_ativo;
	private $dt_hr_registro;
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
	public function getCoUnidade() {
		return $this->co_unidade;
	}
	public function setCoUnidade($co_unidade) {
		$this->co_unidade = $co_unidade;
		return $this;
	}
	public function getCoTipoMorador() {
		return $this->co_tipo_morador;
	}
	public function setCoTipoMorador($co_tipo_morador) {
		$this->co_tipo_morador = $co_tipo_morador;
		return $this;
	}
	public function getCoProfissao() {
		return $this->co_profissao;
	}
	public function setCoProfissao($co_profissao) {
		$this->co_profissao = $co_profissao;
		return $this;
	}
	public function getDtInicio() {
		return $this->dt_inicio;
	}
	public function setDtInicio($dt_inicio) {
		$this->dt_inicio = $dt_inicio;
		return $this;
	}
	public function getDtFim() {
		return $this->dt_fim;
	}
	public function setDtFim($dt_fim) {
		$this->dt_fim = $dt_fim;
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
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
	}
	public function getCoPessoaRegistro() {
		return $this->co_pessoa_registro;
	}
	public function setCoPessoaRegistro($co_pessoa_registro) {
		$this->co_pessoa_registro = $co_pessoa_registro;
		return $this;
	}
	
	
}