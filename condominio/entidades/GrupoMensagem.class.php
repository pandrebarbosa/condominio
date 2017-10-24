<?php
class GrupoMensagem {
	
	private $co_grupo;
	private $no_grupo;
	private $ds_descricao;
	private $no_metodo;
	
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
	public function getCoGrupo() {
		return $this->co_grupo;
	}
	public function setCoGrupo($co_grupo) {
		$this->co_grupo = $co_grupo;
		return $this;
	}
	public function getNoGrupo() {
		return $this->no_grupo;
	}
	public function setNoGrupo($no_grupo) {
		$this->no_grupo = $no_grupo;
		return $this;
	}
	public function getDsDescricao() {
		return $this->ds_descricao;
	}
	public function setDsDescricao($ds_descricao) {
		$this->ds_descricao = $ds_descricao;
		return $this;
	}
	public function getNoMetodo() {
		return $this->no_metodo;
	}
	public function setNoMetodo($no_metodo) {
		$this->no_metodo = $no_metodo;
		return $this;
	}
	
	
}