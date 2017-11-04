<?php
class MoradorNotificacao {
	
	private $co_pessoa;
	private $co_unidade;
	private $st_autorizado;
	private $co_pessoa_registro;
	private $dt_hr_registro;
	

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
	public function getCoUnidade() {
		return $this->co_unidade;
	}
	public function setCoUnidade($co_unidade) {
		$this->co_unidade = $co_unidade;
		return $this;
	}
	public function getStAutorizado() {
	    return $this->st_autorizado;
	}
	public function setStAutorizado($st_autorizado) {
	    $this->st_autorizado = $st_autorizado;
		return $this;
	}
	public function getCoPessoaRegistro()
	{
	    return $this->co_pessoa_registro;
	}
	public function setCoPessoaRegistro($co_pessoa_registro)
	{
	    $this->co_pessoa_registro = $co_pessoa_registro;
	}
	public function getDtHrRegistro() {
	    return $this->dt_hr_registro;
	}
	public function setDtHrRegistro($dt_hr_registro) {
	    $this->dt_hr_registro = $dt_hr_registro;
	    return $this;
	}
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
	}
	
	
}