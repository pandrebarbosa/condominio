<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class TipoItemCorreioDAO extends Db {
	
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
	public function listarTipoItemJSON() {
	
		$arrayCampos = array(
			"co_tipo_item_correio",
			"no_tipo_item_correio"
		);
	
		$res = $this->connBanco->selecionar("tb_tipo_item_correio", $arrayCampos, NULL, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
}