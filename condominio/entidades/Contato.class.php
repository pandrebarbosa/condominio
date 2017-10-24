<?php

class Contato{
	
	private $co_contato;
	private $co_pessoa;
	private $co_tipo_contato;
	private $ds_contato;
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
	
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
	}
	public function getCoContato() {
		return $this->co_contato;
	}
	public function setCoContato($co_contato) {
		$this->co_contato = $co_contato;
		return $this;
	}
	public function getCoPessoa() {
		return $this->co_pessoa;
	}
	public function setCoPessoa($co_pessoa) {
		$this->co_pessoa = $co_pessoa;
		return $this;
	}
	public function getCoTipoContato() {
		return $this->co_tipo_contato;
	}
	public function setCoTipoContato($co_tipo_contato) {
		$this->co_tipo_contato = $co_tipo_contato;
		return $this;
	}
	public function getDsContato() {
		return $this->ds_contato;
	}
	public function setDsContato($ds_contato) {
		$this->ds_contato = $ds_contato;
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
	public function getCoPessoaRegistro() {
		return $this->co_pessoa_registro;
	}
	public function setCoPessoaRegistro($co_pessoa_registro) {
		$this->co_pessoa_registro = $co_pessoa_registro;
		return $this;
	}
	
}