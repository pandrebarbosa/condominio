<?php
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/Db.class.php');

class GrupoMensagemDAO extends Db {
	
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
	public function gravarGrupo(GrupoMensagem $GrupoMensagem){
		
		if($GrupoMensagem->getCoGrupo() != null){
				
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			//seta o data_hora da alteração
			$arr = $GrupoMensagem->iterarObjeto();
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
			if($campos['co_grupo']){
				array_shift($campos);
			}
				
			$this->connBanco->alterar("tb_grupo_mensagem", $campos, "co_grupo=" . $GrupoMensagem->getCoGrupo(), FALSE );
				
		}else{
			/*
			 * Captura os atributos instanciados no objeto e grava somente o que está preenchido.
			 */
			$campos=array();
			$valores=array();
			$arr = $GrupoMensagem->iterarObjeto();
			$i=0;
			foreach ($arr as $k=>$val){
				if($val != null){
					$campos[$i] = $k;
					$valores[$i] = $val;
				}
				$i++;
			}
				
			$co_grupo = $this->connBanco->inserir("tb_grupo_mensagem", $campos, $valores, FALSE);
				
			$GrupoMensagem->setCoGrupo($co_grupo);
				
		}
	}

	
	
	/**
	 * Lista as raças caso ele exista no banco dado nome
	 *
	 * @param Usuario $Usuario
	 */
	public function listarGrupo(GrupoMensagem $GrupoMensagem) {

		$arrayCampos = array(
			"co_grupo",
			"no_grupo",
			"ds_descricao",
			"no_metodo"
		);
		
		$where = null;
		if($GrupoMensagem->getCoGrupo()){
			$where = "co_grupo = " . $GrupoMensagem->getCoGrupo();
		}
	
		$res = $this->connBanco->selecionar("tb_grupo_mensagem", $arrayCampos, $where, null, null, null, FALSE);
	
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	
}