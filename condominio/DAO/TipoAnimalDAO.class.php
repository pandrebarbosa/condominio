<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class TipoAnimalDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	

	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarTipoAnimalJSON(TipoAnimal $TipoAnimal) {
	
		$arrayCampos = array(
			"*"
		);
	
		$tabelas = "tb_tipo_animal";
		$where=null;
		if($TipoAnimal->getCoTipoAnimal()>0){
			$where="co_tipo_animal=".$TipoAnimal->getCoTipoAnimal();
		}
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
}