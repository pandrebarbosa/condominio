<?php

class TipoAnimal{
	
	private $co_tipo_animal;
	private $no_tipo_animal;
	
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
	public function getCoTipoAnimal() {
		return $this->co_tipo_animal;
	}
	public function setCoTipoAnimal($co_tipo_animal) {
		$this->co_tipo_animal = $co_tipo_animal;
		return $this;
	}
	public function getNoTipoAnimal() {
		return $this->no_tipo_animal;
	}
	public function setNoTipoAnimal($no_tipo_animal) {
		$this->no_tipo_animal = $no_tipo_animal;
		return $this;
	}
	
	
}