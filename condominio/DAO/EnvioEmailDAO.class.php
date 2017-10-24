<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class EnvioEmailDAO extends Db {
	
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
	public function gravarEnvioEmail(EnvioEmail $EnvioEmail){
	
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$EnvioEmail->setDtHrEnvio("CURRENT_TIMESTAMP");
		$arr = $EnvioEmail->iterarObjeto();
		$i=0;
		foreach ($arr as $k=>$val){
			if($val != null){
				$campos[$i] = $k;
				$valores[$i] = $val;
			}
			$i++;
		}
	
		$this->connBanco->inserir("tb_envio_email", $campos, $valores, FALSE);
	
	}
	
	
	/**
	 * Lista os modelos de veiculo caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function retornarDiferencaHoraDoUltimoEnvio(EnvioEmail $EnvioEmail) {
		$arrayCampos = array(
			"HOUR(TIMEDIFF(MAX(em.dt_hr_envio), CURRENT_TIMESTAMP)) AS 'diff'"
		);
		$tabelas = "tb_envio_email AS em";
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, "em.ds_email='" . $EnvioEmail->getDsEmail()."'", NULL, NULL, NULL, FALSE);
		
		if (isset($res[0]['diff'])) {
			
			return $res[0]['diff'];
		} else {
			
			return 99;
		}
	}
	
	/**
	 * Lista os dados de um veciulo caso ele exista no banco dado id
	 *
	 * @param Usuario $Usuario
	 */
	public function listarAutorizacoesDeEmail() {
	
		$arrayCampos = array(
			"DATE_FORMAT(tr.dt_hr_registro,'%d/%m/%Y %H:%i') AS 'Autorização'",
			"pe.no_pessoa AS 'Nome'",
			"CASE tr.st_deseja_receber 
			 	WHEN 0 THEN 'Não'
			 	WHEN 1 THEN 'Sim'
			 END AS 'Receber?'"
		);
		$tabelas = "tb_recebimento_email AS tr INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=tr.co_pessoa";
		$where = "tr.dt_hr_registro = (select MAX(tr1.dt_hr_registro)
                     		FROM tb_recebimento_email AS tr1
                    		where tr1.co_pessoa = tr.co_pessoa)";
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, "", "", "", FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

}