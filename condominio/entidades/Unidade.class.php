<?php
class Unidade {
	
	private $co_unidade;
	private $nu_numero;
	private $co_tipo_unidade;
	private $co_torre;
	private $co_proprietario;
	private $nu_metragem;
	private $dt_aquisicao;
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
	
	public function getCoUnidade() {
		return $this->co_unidade;
	}
	public function setCoUnidade($co_unidade) {
		$this->co_unidade = $co_unidade;
		return $this;
	}
	public function getNuNumero() {
		return $this->nu_numero;
	}
	public function setNuNumero($nu_numero) {
		$this->nu_numero = $nu_numero;
		return $this;
	}
	public function getCoTipoUnidade() {
		return $this->co_tipo_unidade;
	}
	public function setCoTipoUnidade($co_tipo_unidade) {
		$this->co_tipo_unidade = $co_tipo_unidade;
		return $this;
	}
	public function getCoTorre() {
		return $this->co_torre;
	}
	public function setCoTorre($co_torre) {
		$this->co_torre = $co_torre;
		return $this;
	}
	public function getCoProprietario() {
		return $this->co_proprietario;
	}
	public function setCoProprietario($co_proprietario) {
		$this->co_proprietario = $co_proprietario;
		return $this;
	}
	public function getNuMetragem() {
		return $this->nu_metragem;
	}
	public function setNuMetragem($nu_metragem) {
		$this->nu_metragem = $nu_metragem;
		return $this;
	}
	public function getDtAquisicao() {
		return $this->dt_aquisicao;
	}
	public function setDtAquisicao($dt_aquisicao) {
		$this->dt_aquisicao = $dt_aquisicao;
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
	
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
	}
	public function getCoPessoaRegistro() {
		return $this->co_pessoa_registro;
	}
	public function setCoPessoaRegistro($co_pessoa_registro) {
		$this->co_pessoa_registro = $co_pessoa_registro;
		return $this;
	}
	
	
}