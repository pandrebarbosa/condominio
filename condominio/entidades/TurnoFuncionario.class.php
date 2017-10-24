<?php

class TurnoFuncionario{
	private $co_turno;
	private $co_pessoa;
	private $dt_hr_registro;
	
	public function iterarObjeto() {
		$arrayRetorno = array();
		foreach ( $this as $key => $value ) {
			$arrayRetorno[$key] = $value;
		}
	
		return $arrayRetorno;
	}
	public function getCoTurno() {
		return $this->co_turno;
	}
	public function setCoTurno($co_turno) {
		$this->co_turno = $co_turno;
		return $this;
	}
	public function getCoPessoa() {
		return $this->co_pessoa;
	}
	public function setCoPessoa($co_pessoa) {
		$this->co_pessoa = $co_pessoa;
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