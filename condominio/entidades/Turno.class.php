<?php

class Turno {
	private $co_turno;
	private $ds_turno;
	private $ds_horario;
	
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
	public function getCoTurno() {
		return $this->co_turno;
	}
	public function setCoTurno($co_turno) {
		$this->co_turno = $co_turno;
		return $this;
	}
	public function getDsTurno() {
		return $this->ds_turno;
	}
	public function setDsTurno($ds_turno) {
		$this->ds_turno = $ds_turno;
		return $this;
	}
	public function getDsHorario() {
		return $this->ds_horario;
	}
	public function setDsHorario($ds_horario) {
		$this->ds_horario = $ds_horario;
		return $this;
	}
	
}