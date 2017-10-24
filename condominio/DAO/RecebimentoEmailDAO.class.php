<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class RecebimentoEmailDAO extends Db {
	
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
	public function gravarRecebimentoEmail(RecebimentoEmail $RecebimentoEmail){
	
		/*
		 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
		 */
		$campos=array();
		$valores=array();
		$RecebimentoEmail->setDtHrRegistro("CURRENT_TIMESTAMP");
		
		if($RecebimentoEmail->getStDesejaReceber() == "true"){
			$RecebimentoEmail->setStDesejaReceber(1);
		}else{
			$RecebimentoEmail->setStDesejaReceber(0);
		}
		
		$arr = $RecebimentoEmail->iterarObjeto();
		
		$i=0;
		foreach ($arr as $k=>$val){
			//if($val != null){
				$campos[$i] = $k;
				$valores[$i] = $val;
			//}
			$i++;
		}
	
		$this->connBanco->inserir("tb_recebimento_email", $campos, $valores, FALSE);
	
	}
	
	/**
	 * Lista as raças caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function retornaAutorizacaoRecebimentoEmail(RecebimentoEmail $RecebimentoEmail) {
	
		$arrayCampos = array(
			"tr.st_deseja_receber"
		);
		$where = "tr.dt_hr_registro = (select MAX(tr1.dt_hr_registro)
                     		from tb_recebimento_email AS tr1
                    		where tr1.co_pessoa = tr.co_pessoa) AND tr.co_pessoa=".$RecebimentoEmail->getCoPessoa();
		$res = $this->connBanco->selecionar("tb_recebimento_email AS tr", $arrayCampos, $where, "", "", "", FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}	
	
}