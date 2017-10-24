<?php

class Controller{
	
	private $co_controller;
	private $no_controller;
	private $ds_controller;
	private $ds_caminho;
	private $co_tipo_usuario;
	
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
	public function getNoController() {
		return $this->no_controller;
	}
	public function setNoController($no_controller) {
		$this->no_controller = $no_controller;
		return $this;
	}
	public function getDsController() {
		return $this->ds_controller;
	}
	public function setDsController($ds_controller) {
		$this->ds_controller = $ds_controller;
		return $this;
	}
	public function getDsCaminho() {
		return $this->ds_caminho;
	}
	public function setDsCaminho($ds_caminho) {
		$this->ds_caminho = $ds_caminho;
		return $this;
	}
	public function getCoController() {
		return $this->co_controller;
	}
	public function setCoController($co_controller) {
		$this->co_controller = $co_controller;
		return $this;
	}
	public function getCoTipoUsuario() {
		return $this->co_tipo_usuario;
	}
	public function setCoTipoUsuario($co_tipo_usuario) {
		$this->co_tipo_usuario = $co_tipo_usuario;
		return $this;
	}
	
	
}