<?php

class Profissao{
	private $co_profissao;
	private $no_profissao;
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
	public function getCoProfissao() {
		return $this->co_profissao;
	}
	public function setCoProfissao($co_profissao) {
		$this->co_profissao = $co_profissao;
		return $this;
	}
	public function getNoProfissao() {
		return $this->no_profissao;
	}
	public function setNoProfissao($no_profissao) {
		$this->no_profissao = $no_profissao;
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