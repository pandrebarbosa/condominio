<?php
class AnimalDomestico {
	
	private $co_animal_domestico;
	private $co_unidade;
	private $co_tipo_animal;
	private $co_raca;
	private $ds_cor;
	private $ds_nome;
	private $ds_foto;
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
	
	public function getCoAnimalDomestico() {
		return $this->co_animal_domestico;
	}
	public function setCoAnimalDomestico($co_animal_domestico) {
		$this->co_animal_domestico = $co_animal_domestico;
		return $this;
	}
	public function getCoUnidade() {
		return $this->co_unidade;
	}
	public function setCoUnidade($co_unidade) {
		$this->co_unidade = $co_unidade;
		return $this;
	}
	public function getCoTipoAnimal() {
		return $this->co_tipo_animal;
	}
	public function setCoTipoAnimal($co_tipo_animal) {
		$this->co_tipo_animal = $co_tipo_animal;
		return $this;
	}
	public function getCoRaca() {
		return $this->co_raca;
	}
	public function setCoRaca($co_raca) {
		$this->co_raca = $co_raca;
		return $this;
	}
	public function getDsCor() {
		return $this->ds_cor;
	}
	public function setDsCor($ds_cor) {
		$this->ds_cor = $ds_cor;
		return $this;
	}
	public function getDsNome() {
		return $this->ds_nome;
	}
	public function setDsNome($ds_nome) {
		$this->ds_nome = $ds_nome;
		return $this;
	}
	public function getDsFoto() {
		return $this->ds_foto;
	}
	public function setDsFoto($ds_foto) {
		$this->ds_foto = $ds_foto;
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