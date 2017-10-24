<?php
class TipoUnidade {
	
	private $co_tipo_unidade;
	private $no_tipo_unidade;
	private $sg_sigla_unidade;
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
	
	public function getCoTipoUnidade() {
		return $this->co_tipo_unidade;
	}
	public function setCoTipoUnidade($co_tipo_unidade) {
		$this->co_tipo_unidade = $co_tipo_unidade;
		return $this;
	}
	public function getNoTipoUnidade() {
		return $this->no_tipo_unidade;
	}
	public function setNoTipoUnidade($no_tipo_unidade) {
		$this->no_tipo_unidade = $no_tipo_unidade;
		return $this;
	}
	public function getSgSiglaUnidade() {
		return $this->sg_sigla_unidade;
	}
	public function setSgSiglaUnidade($sg_sigla_unidade) {
		$this->sg_sigla_unidade = $sg_sigla_unidade;
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