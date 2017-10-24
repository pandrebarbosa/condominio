<?php
class Correio {
	
	private $co_item_correio;
	private $co_unidade;
	private $co_tipo_item_correio;
	private $ds_item;
	private $co_funcionario_recebimento;
	private $dt_hr_chegada;
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
	public function getCoUnidade() {
		return $this->co_unidade;
	}
	public function setCoUnidade($co_unidade) {
		$this->co_unidade = $co_unidade;
		return $this;
	}
	public function getCoTipoItemCorreio() {
		return $this->co_tipo_item_correio;
	}
	public function setCoTipoItemCorreio($co_tipo_item_correio) {
		$this->co_tipo_item_correio = $co_tipo_item_correio;
		return $this;
	}
	public function getDsItem() {
		return $this->ds_item;
	}
	public function setDsItem($ds_item) {
		$this->ds_item = $ds_item;
		return $this;
	}
	public function getCoFuncionarioRecebimento() {
		return $this->co_funcionario_recebimento;
	}
	public function setCoFuncionarioRecebimento($co_funcionario_recebimento) {
		$this->co_funcionario_recebimento = $co_funcionario_recebimento;
		return $this;
	}
	public function getDtHrChegada() {
		return $this->dt_hr_chegada;
	}
	public function setDtHrChegada($dt_hr_chegada) {
		$this->dt_hr_chegada = $dt_hr_chegada;
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
	
}