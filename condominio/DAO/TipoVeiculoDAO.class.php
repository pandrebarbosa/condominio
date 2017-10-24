<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class TipoVeiculoDAO extends Db {
	
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
	public function listarTipoVeiculoJSON(TipoVeiculo $TipoVeiculo) {
	
		$arrayCampos = array(
			"*"
		);
	
		$tabelas = "tb_tipo_veiculo";
		$where=null;
		if($TipoVeiculo->getCoTipoVeiculo()>0){
			$where="co_tipo_veiculo=".$TipoVeiculo->getCoTipoVeiculo();
		}
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, NULL, NULL, NULL, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	
	
}