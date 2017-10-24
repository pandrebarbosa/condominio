<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class CargoFuncionarioDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	


	
	
	/**
	 * Lista as raças caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarCargoFuncionarioJSON() {
	
		$arrayCampos = array(
			"co_cargo_funcionario",
			"no_cargo_funcionario"
		);
	
		$res = $this->connBanco->selecionar("tb_cargo_funcionario", $arrayCampos, NULL, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
}