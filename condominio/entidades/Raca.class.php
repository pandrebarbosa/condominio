<?php
class Raca {
	
	private $co_raca;
	private $no_raca;
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
	public function getCoRaca() {
		return $this->co_raca;
	}
	public function setCoRaca($co_raca) {
		$this->co_raca = $co_raca;
		return $this;
	}
	public function getNoRaca() {
		return $this->no_raca;
	}
	public function setNoRaca($no_raca) {
		$this->no_raca = $no_raca;
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