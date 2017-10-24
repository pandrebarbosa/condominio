<?php
class Usuario {

	private $co_pessoa;
	private $co_tipo_usuario;
	private $ds_email;
	private $ds_login;
	private $ds_senha;
	private $st_ativo;
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
	
	public function getCoPessoa() {
		return $this->co_pessoa;
	}
	public function setCoPessoa($co_pessoa) {
		$this->co_pessoa = $co_pessoa;
		return $this;
	}
	public function getCoTipoUsuario() {
		return $this->co_tipo_usuario;
	}
	public function setCoTipoUsuario($co_tipo_usuario) {
		$this->co_tipo_usuario = $co_tipo_usuario;
		return $this;
	}
	public function getDsEmail() {
		return $this->ds_email;
	}
	public function setDsEmail($ds_email) {
		$this->ds_email = $ds_email;
		return $this;
	}
	public function getDsLogin() {
		return $this->ds_login;
	}
	public function setDsLogin($ds_login) {
		$this->ds_login = $ds_login;
		return $this;
	}
	public function getDsSenha() {
		return $this->ds_senha;
	}
	public function setDsSenha($ds_senha) {
		$this->ds_senha = $ds_senha;
		return $this;
	}
	public function getStAtivo() {
		return $this->st_ativo;
	}
	public function setStAtivo($st_ativo) {
		$this->st_ativo = $st_ativo;
		return $this;
	}
	
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
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