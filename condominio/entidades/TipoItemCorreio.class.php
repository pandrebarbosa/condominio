<?php
class TipoItemCorreio {
	
	private $co_tipo_item_correio;
	private $no_tipo_item_correio;
	
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
	
	public function getCoTipoItemCorreio() {
		return $this->co_tipo_item_correio;
	}
	public function setCoTipoItemCorreio($co_tipo_item_correio) {
		$this->co_tipo_item_correio = $co_tipo_item_correio;
		return $this;
	}
	public function getNoTipoItemCorreio() {
		return $this->no_tipo_item_correio;
	}
	public function setNoTipoItemCorreio($no_tipo_item_correio) {
		$this->no_tipo_item_correio = $no_tipo_item_correio;
		return $this;
	}
	
}