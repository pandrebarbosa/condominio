<?php

class Mensagem{
	
	private $co_mensagem;
	private $ds_titulo;
	private $ds_conteudo;
	private $ds_imagem;
	private $dt_hr_envio;
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
	public function getCoMensagem() {
		return $this->co_mensagem;
	}
	public function setCoMensagem($co_mensagem) {
		$this->co_mensagem = $co_mensagem;
		return $this;
	}
	public function getDsTitulo() {
		return $this->ds_titulo;
	}
	public function setDsTitulo($ds_titulo) {
		$this->ds_titulo = $ds_titulo;
		return $this;
	}
	public function getDsConteudo() {
		return $this->ds_conteudo;
	}
	public function setDsConteudo($ds_conteudo) {
		$this->ds_conteudo = $ds_conteudo;
		return $this;
	}
	public function getDsImagem() {
		return $this->ds_imagem;
	}
	public function setDsImagem($ds_imagem) {
		$this->ds_imagem = $ds_imagem;
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
	public function getDtHrEnvio() {
		return $this->dt_hr_envio;
	}
	public function setDtHrEnvio($dt_hr_envio) {
		$this->dt_hr_envio = $dt_hr_envio;
		return $this;
	}
	
	
}