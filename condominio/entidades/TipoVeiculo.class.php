<?php

class TipoVeiculo{
	private $co_tipo_veiculo;
	private $no_tipo_veiculo;
	
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
	public function getCoTipoVeiculo() {
		return $this->co_tipo_veiculo;
	}
	public function setCoTipoVeiculo($co_tipo_veiculo) {
		$this->co_tipo_veiculo = $co_tipo_veiculo;
		return $this;
	}
	public function getNoTipoVeiculo() {
		return $this->no_tipo_veiculo;
	}
	public function setNoTipoVeiculo($no_tipo_veiculo) {
		$this->no_tipo_veiculo = $no_tipo_veiculo;
		return $this;
	}
	
}