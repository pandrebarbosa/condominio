<?php
class Veiculo{
	
	private $co_veiculo;
	private $co_unidade;
	private $co_tipo_veiculo;
	private $co_vaga;
	private $co_modelo_veiculo;
	private $ds_placa;
	private $ds_cor;
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
	
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
	}	
	
	public function getCoVeiculo() {
		return $this->co_veiculo;
	}
	public function setCoVeiculo($co_veiculo) {
		$this->co_veiculo = $co_veiculo;
		return $this;
	}
	public function getCoUnidade() {
		return $this->co_unidade;
	}
	public function setCoUnidade($co_unidade) {
		$this->co_unidade = $co_unidade;
		return $this;
	}
	public function getCoTipoVeiculo() {
		return $this->co_tipo_veiculo;
	}
	public function setCoTipoVeiculo($co_tipo_veiculo) {
		$this->co_tipo_veiculo = $co_tipo_veiculo;
		return $this;
	}
	public function getCoVaga() {
		return $this->co_vaga;
	}
	public function setCoVaga($co_vaga) {
		$this->co_vaga = $co_vaga;
		return $this;
	}
	public function getCoModeloVeiculo() {
		return $this->co_modelo_veiculo;
	}
	public function setCoModeloVeiculo($co_modelo_veiculo) {
		$this->co_modelo_veiculo = $co_modelo_veiculo;
		return $this;
	}
	public function getDsPlaca() {
		return $this->ds_placa;
	}
	public function setDsPlaca($ds_placa) {
		$this->ds_placa = $ds_placa;
		return $this;
	}
	public function getDsCor() {
		return $this->ds_cor;
	}
	public function setDsCor($ds_cor) {
		$this->ds_cor = $ds_cor;
		return $this;
	}
	public function getStAtivo() {
		return $this->st_ativo;
	}
	public function setStAtivo($st_ativo) {
		$this->st_ativo = $st_ativo;
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

	
}