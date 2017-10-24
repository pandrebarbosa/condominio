<?php
class EnvioEmail{
	
	private $co_envio_email;
	private $ds_email;
	private $dt_hr_envio;
	private $ds_assunto;
	private $ds_conteudo;
	
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
	
	public function getCoEnvioEmail() {
		return $this->co_envio_email;
	}
	public function setCoEnvioEmail($co_envio_email) {
		$this->co_envio_email = $co_envio_email;
		return $this;
	}
	public function getDsEmail() {
		return $this->ds_email;
	}
	public function setDsEmail($ds_email) {
		$this->ds_email = $ds_email;
		return $this;
	}
	public function getDtHrEnvio() {
		return $this->dt_hr_envio;
	}
	public function setDtHrEnvio($dt_hr_envio) {
		$this->dt_hr_envio = $dt_hr_envio;
		return $this;
	}
	public function getDsAssunto() {
		return $this->ds_assunto;
	}
	public function setDsAssunto($ds_assunto) {
		$this->ds_assunto = $ds_assunto;
		return $this;
	}
	public function getDsConteudo() {
		return $this->ds_conteudo;
	}
	public function setDsConteudo($ds_conteudo) {
		$this->ds_conteudo = $ds_conteudo;
		return $this;
	}
	
	
}