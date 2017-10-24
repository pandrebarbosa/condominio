<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class TurnoDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}

	/**
	 * Grava correios na tabela de correios
	 *
	 * @param ModeloVeiculo $ModeloVeiculo
	 */
	public function gravarTurnoFuncionario($turnosArr){
	
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$i=0;
		foreach ($turnosArr as $val){
			if($val != null){
				$ObjTurnos[$i] = $val;
			}
			$i++;
		}

		$this->apagarTurnoFuncionarios($ObjTurnos[0]->getCoPessoa());
		foreach ($ObjTurnos as $TurnoFuncionario){
			$campos = array(
					"co_turno",
					"co_pessoa",
					"dt_hr_registro",
			);
			$valores = array(
					$TurnoFuncionario->getCoTurno(),
					$TurnoFuncionario->getCoPessoa(),
					$TurnoFuncionario->getDtHrRegistro()
			);
			$this->connBanco->inserir("tb_turno_funcionario", $campos, $valores, FALSE);
		}
	
	
	}
	
	/**
	 * Lista as raças caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function apagarTurnoFuncionarios($co_pessoa) {
	
		if($this->listarTurnosPorFuncionarioJSON($co_pessoa)){
			$this->connBanco->apagar("tb_turno_funcionario","co_pessoa=" . $co_pessoa, FALSE);
		}
		
		return true;
	}
	
	/**
	 * Lista as raças caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarTurnoJSON(Turno $Turno) {
	
		$arrayCampos = array(
			"co_turno",
			"ds_turno"
		);
		$where=null;
		if($Turno->getCoTurno() > 0){
			$where="co_turno = " . $Turno->getCoTurno();
		}
		$res = $this->connBanco->selecionar("tb_turno", $arrayCampos, $where, null, null, null, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
	/**
	 * Lista as raças caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarTurnosPorFuncionarioJSON($co_pessoa) {
	
		$arrayCampos = array(
				"co_turno"
		);
		if($co_pessoa > 0){
			$where="co_pessoa = " . $co_pessoa;
		} else {
			return false;
		}
		$res = $this->connBanco->selecionar("tb_turno_funcionario", $arrayCampos, $where, null, null, null, FALSE);
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
}