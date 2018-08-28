<?php
class RetiradaCorreio {
	private $co_item_correio;
	private $co_funcionario_retirada;
	private $co_pessoa_retirada;
	private $co_unidade_retirada;
	private $dt_hr_retirada;
	private $ds_observacao;
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
	
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
	}
	public function getCoItemCorreio() {
		return $this->co_item_correio;
	}
	public function setCoItemCorreio($co_item_correio) {
		$this->co_item_correio = $co_item_correio;
		return $this;
	}
	public function getCoFuncionarioRetirada() {
		return $this->co_funcionario_retirada;
	}
	public function setCoFuncionarioRetirada($co_funcionario_retirada) {
		$this->co_funcionario_retirada = $co_funcionario_retirada;
		return $this;
	}
	public function getCoPessoaRetirada(){
	    return $this->co_pessoa_retirada;
	}
	public function setCoPessoaRetirada($co_pessoa_retirada){
	    $this->co_pessoa_retirada = $co_pessoa_retirada;
	}
	public function getDtHrRetirada() {
		return $this->dt_hr_retirada;
	}
	public function setDtHrRetirada($dt_hr_retirada) {
		$this->dt_hr_retirada = $dt_hr_retirada;
		return $this;
	}
	public function getDsObservacao() {
		return $this->ds_observacao;
	}
	public function setDsObservacao($ds_observacao) {
		$this->ds_observacao = $ds_observacao;
		return $this;
	}
	public function getDtHrRegistro() {
		return $this->dt_hr_registro;
	}
	public function setDtHrRegistro($dt_hr_registro) {
		$this->dt_hr_registro = $dt_hr_registro;
		return $this;
	}
    public function getCoUnidadeRetirada(){
        return $this->co_unidade_retirada;
    }
    public function setCoUnidadeRetirada($co_unidade_retirada){
        $this->co_unidade_retirada = $co_unidade_retirada;
        return $this;
    }

	
	
	
}