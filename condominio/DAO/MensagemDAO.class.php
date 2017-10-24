<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class MensagemDAO extends Db {
	
	private $connBanco;
	
	/**
	 * Construtor da classe instanciando o Banco
	 */
	function __construct() {
		$this->connBanco = new Db();
	}
	

	/**
	 * Grava racas na tabela de raca
	 * 
	 * @param AnimalDomestico $AnimalDomestico
	 */
	public function gravarMensagem(Mensagem $Mensagem){
		
			if($Mensagem->getCoMensagem() != null){
			
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$Mensagem->setDtHrRegistro("NOW()");
			$arr = $Mensagem->iterarObjeto();
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
			if($campos['co_mensagem']){
				array_shift($campos);
			}
			
			$this->connBanco->alterar("tb_mensagem", $campos, "co_mensagem=" . $Mensagem->getCoMensagem(), FALSE );
			
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$Mensagem->setDtHrRegistro("NOW()");
			$arr = $Mensagem->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
			
			$co_mensagem = $this->connBanco->inserir("tb_mensagem", $campos, $valores, FALSE);
			
			$Mensagem->setCoMensagem($co_mensagem);
			
		}
		

	}

	/**
	 * Grava envio de mensagens a todos os usuarios do sistema
	 *
	 * @param Mensagem $Mensagem
	 */
	public function enviarMensagemTodosUsuarios(Mensagem $Mensagem){

		$query = "INSERT INTO tb_leitura_mensagem (co_mensagem, co_pessoa)
					SELECT ".$Mensagem->getCoMensagem().",p.co_pessoa
					FROM tb_pessoa AS p
					INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa";			
	
		$retorno = $this->connBanco->query($query,FALSE);
		
		return $retorno;
	}	

	/**
	 * Grava envio de mensagens a todos os moradores do sistema
	 *
	 * @param Mensagem $Mensagem
	 */
	public function enviarMensagemTodosMoradores(Mensagem $Mensagem){

		$query = "INSERT INTO tb_leitura_mensagem (co_mensagem, co_pessoa)
					SELECT ".$Mensagem->getCoMensagem().",p.co_pessoa
					FROM tb_pessoa AS p
					INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
					INNER JOIN tb_morador AS mo ON mo.co_pessoa=u.co_pessoa";			
	
		$retorno = $this->connBanco->query($query,FALSE);
		
		return $retorno;
	}	

	/**
	 * Grava envio de mensagens a todos os moradores da Torre 1
	 *
	 * @param Mensagem $Mensagem
	 */
	public function enviarMensagemMoradoresTorre1(Mensagem $Mensagem){

		$query = "INSERT INTO tb_leitura_mensagem (co_mensagem, co_pessoa)
					SELECT ".$Mensagem->getCoMensagem().",p.co_pessoa
					FROM tb_pessoa AS p
					INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
					INNER JOIN tb_morador AS mo ON mo.co_pessoa=u.co_pessoa
					INNER JOIN tb_unidade AS un ON un.co_unidade=mo.co_unidade AND un.co_torre = 1";			
	
		$retorno = $this->connBanco->query($query,FALSE);
		
		return $retorno;
	}	

	/**
	 * Grava envio de mensagens a todos os moradores da Torre 2
	 *
	 * @param Mensagem $Mensagem
	 */
	public function enviarMensagemMoradoresTorre2(Mensagem $Mensagem){

		$query = "INSERT INTO tb_leitura_mensagem (co_mensagem, co_pessoa)
					SELECT ".$Mensagem->getCoMensagem().",p.co_pessoa
					FROM tb_pessoa AS p
					INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
					INNER JOIN tb_morador AS mo ON mo.co_pessoa=u.co_pessoa
					INNER JOIN tb_unidade AS un ON un.co_unidade=mo.co_unidade AND un.co_torre = 2";			
	
		$retorno = $this->connBanco->query($query,FALSE);
		
		return $retorno;
	}	

	/**
	 * Grava envio de mensagens a todos os moradores da Torre 3
	 *
	 * @param Mensagem $Mensagem
	 */
	public function enviarMensagemMoradoresTorre3(Mensagem $Mensagem){

		$query = "INSERT INTO tb_leitura_mensagem (co_mensagem, co_pessoa)
					SELECT ".$Mensagem->getCoMensagem().",p.co_pessoa
					FROM tb_pessoa AS p
					INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
					INNER JOIN tb_morador AS mo ON mo.co_pessoa=u.co_pessoa
					INNER JOIN tb_unidade AS un ON un.co_unidade=mo.co_unidade AND un.co_torre = 3";			
	
		$retorno = $this->connBanco->query($query,FALSE);
		
		return $retorno;
	}	

	/**
	 * Grava envio de mensagens a todos os moradores da Torre 4
	 *
	 * @param Mensagem $Mensagem
	 */
	public function enviarMensagemMoradoresTorre4(Mensagem $Mensagem){

		$query = "INSERT INTO tb_leitura_mensagem (co_mensagem, co_pessoa)
					SELECT ".$Mensagem->getCoMensagem().",p.co_pessoa
					FROM tb_pessoa AS p
					INNER JOIN tb_usuario AS u ON p.co_pessoa=u.co_pessoa
					INNER JOIN tb_morador AS mo ON mo.co_pessoa=u.co_pessoa
					INNER JOIN tb_unidade AS un ON un.co_unidade=mo.co_unidade AND un.co_torre = 4";			
	
		$retorno = $this->connBanco->query($query,FALSE);
		
		return $retorno;
	}	
	
	
	/**
	 * Grava racas na tabela de raca
	 *
	 * @param AnimalDomestico $AnimalDomestico
	 */
	public function registrarLeituraMensagem(LeituraMensagem $LeituraMensagem){
		
		$campos=array();
		$LeituraMensagem->setDtHrRegistro("CURRENT_TIMESTAMP");
		$arr = $LeituraMensagem->iterarObjeto();
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
		if($campos['co_mensagem']){
			array_shift($campos);
		}			
		if($campos['co_pessoa']){
			array_shift($campos);
		}
		$this->connBanco->alterar("tb_leitura_mensagem", $campos, "co_pessoa=" . $LeituraMensagem->getCoPessoa() . " AND co_mensagem=" . $LeituraMensagem->getCoMensagem(), FALSE );
		
	}
	
	
	/**
	 * Lista as raças caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarMensagemDisponivel($co_pessoa) {
	
		$arrayCampos = array(
		   "MAX(m.co_mensagem) AS co_mensagem",
		   "m.ds_titulo",
		   "m.ds_conteudo",
		   "m.ds_imagem",
		   "m.dt_hr_registro",
		   "m.co_pessoa_registro"
		);
		$tabelas = "tb_mensagem AS m INNER JOIN tb_leitura_mensagem AS lm ON m.co_mensagem=lm.co_mensagem AND lm.dt_hr_registro IS NULL";
		$where = "lm.co_pessoa=".$co_pessoa;
		
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, null, null, null, FALSE);
	
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
	public function carregarMensagem($co_mensagem) {
	
		$arrayCampos = array(
		   "*"
		);
		$tabelas = "tb_mensagem";
		$where = "co_mensagem=".$co_mensagem;
		
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, null, null, null, FALSE);
	
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
	public function verificarSeHaMensagemDisponivel($co_pessoa) {
	
		$arrayCampos = array(
				"m.co_mensagem AS co_mensagem",
				"m.ds_titulo",
				"m.ds_conteudo",
				"m.ds_imagem"
		);
		$tabelas = "tb_mensagem AS m INNER JOIN tb_leitura_mensagem AS lm ON m.co_mensagem=lm.co_mensagem AND lm.dt_hr_registro IS NULL";
	
		$where = null;
		$where = "lm.co_pessoa=".$co_pessoa;
	
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, null, null, null, FALSE);
	
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
	public function listarTodasMensagensComRegLeitura() {
	
		$arrayCampos = array(
				"m.co_mensagem AS 'Código'",
				"m.ds_titulo AS 'Mensagem'",
				"p.no_pessoa AS 'Usuário'",
				"DATE_FORMAT(lm.dt_hr_registro,'%d/%m/%Y %H:%m:%s') AS 'Leitura'"
		);
		$tabelas = "tb_mensagem AS m ";
		$tabelas .= "INNER JOIN tb_leitura_mensagem AS lm ON m.co_mensagem=lm.co_mensagem AND DATE_FORMAT(lm.dt_hr_registro,'%d/%m/%Y %H:%m:%s') > '00/00/0000 00:00:00' ";
		$tabelas .= "INNER JOIN tb_pessoa AS p ON p.co_pessoa=lm.co_pessoa";
	
		$where = null;
		$res = $this->connBanco->selecionar($tabelas, $arrayCampos, $where, null, "Leitura DESC", null, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
}