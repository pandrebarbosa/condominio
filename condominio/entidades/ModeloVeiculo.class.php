<?php
class ModeloVeiculo{
	
	private $co_modelo_veiculo;
	private $no_modelo_veiculo;
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
	
	public function getCoModeloVeiculo() {
		return $this->co_modelo_veiculo;
	}
	public function setCoModeloVeiculo($co_modelo_veiculo) {
		$this->co_modelo_veiculo = $co_modelo_veiculo;
		return $this;
	}
	public function getNoModeloVeiculo() {
		return $this->no_modelo_veiculo;
	}
	public function setNoModeloVeiculo($no_modelo_veiculo) {
		$this->no_modelo_veiculo = $no_modelo_veiculo;
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