<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class MoradorNotificacaoDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	

	/**
	 * Grava pessoas na tabela de pessoas
	 * 
	 * @param Pessoa $Pessoa
	 */
	public function gravarNotificacaoEmail(MoradorNotificacao $moradorNotificacao){
	    
	    if($this->notificacaoAutorizada($moradorNotificacao) == ""){
	        /*
	         * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
	         */
	        $campos=array();
	        $valores=array();
	        $arr = $moradorNotificacao->iterarObjeto();
	        $i=0;
	        foreach ($arr as $k=>$val){
	            if($val != null){
	                $campos[$i] = $k;
	                $valores[$i] = $val;
	            }
	            $i++;
	        }
	        
	        $this->connBanco->inserir("tb_morador_notificacao", $campos, $valores, FALSE);
	    }else{
	        /*
	         * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
	         */
	        $campos=array();
	        $arr = $moradorNotificacao->iterarObjeto();
	        $i=0;
	        foreach ($arr as $k=>$val){
	            if($val != null){
	                $campos[$k] = $val;
	            }
	            $i++;
	        }
	        
	        /* Se tiver a chave primaria prenchida, retira do array, para não
	         * fazer parte do UPDATE.
	         */
	        if($campos['co_pessoa']){
	            array_shift($campos);
	        }
	        if($campos['co_unidade']){
	            array_shift($campos);
	        }
	        
	        $this->connBanco->alterar("tb_morador_notificacao", $campos, "co_pessoa=" . $moradorNotificacao->getCoPessoa() . " AND co_unidade=" . $moradorNotificacao->getCoUnidade(), FALSE );
	        
	    }

	    
	}
	
	
	/**
	 * Verifica se o usuario tem autorizaão para emails
	 *
	 * @param Pessoa $Pessoa
	 * @return Pessoa
	 */
	public function notificacaoAutorizada(MoradorNotificacao $moradorNotificacao) {
	    
	    $arrayCampos = array(
	        "co_pessoa",
	        "co_unidade",
	        "st_autorizado"
	    );
	    
	    $res = $this->connBanco->selecionar( "tb_morador_notificacao", $arrayCampos, "co_pessoa=" . $moradorNotificacao->getCoPessoa() . " AND co_unidade=" . $moradorNotificacao->getCoUnidade(), NULL, NULL, NULL, FALSE );
	    if($res){
	        return $res[0]['st_autorizado'];
	    }else{
	        return 0;
	    }
	    
	}
	
}