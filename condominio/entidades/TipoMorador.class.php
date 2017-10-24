<?php

class TipoMorador{
	private $co_tipo_morador;
	private $no_tipo_morador;
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
	public function getCoTipoMorador() {
		return $this->co_tipo_morador;
	}
	public function setCoTipoMorador($co_tipo_morador) {
		$this->co_tipo_morador = $co_tipo_morador;
		return $this;
	}
	public function getNoTipoMorador() {
		return $this->no_tipo_morador;
	}
	public function setNoTipoMorador($no_tipo_morador) {
		$this->no_tipo_morador = $no_tipo_morador;
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