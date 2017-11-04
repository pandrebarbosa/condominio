<?php

class Db{

	private $conn;
	private $query;
	private $data;

	
	function conectar(){
		
		if($_SESSION['credencial']['ambiente'] == "DEV"){
			$conn = @mysql_connect('localhost','root','') or die("Erro[connection]: " . mysql_error());
			mysql_select_db('sanraphael') or die("Erro[select_db]: " . mysql_error());
			
			return $conn;
		}else{
			$conn = @mysql_connect("ranraphael.mysql.dbaas.com.br", "sanraphael", "csraphael2613") or die("Erro[conn]: " . mysql_error());
			mysql_select_db("sanraphael") or die("Erro[select_db]: " . mysql_error());
			
			return $conn;
		}
		
	}

	
	function selecionar($tabela, $Arraycampos, $where=NULL, $group_by=NULL, $order_by=NULL, $limit=NULL, $depurar=FALSE){
		
		$data=array();
		$connec = $this->conectar();
		
		$i=1;
		$campos=null;
		foreach($Arraycampos AS $field){
			$campos .= $field;
			if($i<count($Arraycampos)) $campos .= ",";
			
			$i++;
		}
		
		$this->query="SELECT $campos FROM ".$tabela;
		
		if ( $where != NULL )
			$this->query.=" WHERE ".$where;
			
		if ( $group_by != NULL)
			$this->query.=" GROUP BY ".$group_by;				
						
		if ( $order_by != NULL)
			$this->query.=" ORDER BY ".$order_by;
						
		if ( $limit != NULL )
			$this->query.=" LIMIT ".$limit;
			
		if ($depurar){
			print '<pre>'.$this->query.'</pre>';
			exit;
		}	
			
		$res = mysql_query($this->query) or die ( mysql_error() . "<pre>" . $this->query . "</pre>");
		
		while($row=mysql_fetch_assoc($res)){
			$data[]=$row;
		}
		
		$qtd = count($data);		
		if($qtd>0){
			$retorno = $data;
		}else{
			$retorno = false;
		}

		mysql_close($connec);
		mysql_free_result($res);
		
		return $retorno;

	  
	}
	
	function inserir($tabela,$Arraycampos,$Arrayvalores,$depurar=FALSE){
		
		$connec = $this->conectar();
		
		$i=1;
		$campos=null;
		$iCpf=null;
		$iRg=null;
		foreach($Arraycampos AS $field){
			$campos .= $field;
			if($field == "nu_cpf") $iCpf = $i;
			if($field == "nu_rg")  $iRg = $i;
			if($i<count($Arraycampos)) $campos .= ",";
				
			$i++;
		}	
		
		$j=1;
		$valores=null;
		foreach($Arrayvalores AS $field){
			if($j == $iCpf || $j == $iRg){
				$valores .= "'" . $field . "'";
			}else{
				$valores .= $this->retornaTipo($field);
			}
			
			if($j<count($Arrayvalores)){
				$valores.= ",";
			}
			$j++;
		}		
		
		$this->query = "INSERT INTO ".$tabela." (".$campos.") VALUES (".$valores.")";
		
		if ($depurar){
			print '<pre>'.$this->query.'</pre>';
			exit;
		}			
		
		mysql_query($this->query) or die (mysql_error() . "<pre>" . $this->query . "</pre>");
		
		$retorno = mysql_insert_id();
				
		mysql_close($connec);
		
		return $retorno;		
		
	}
	
	function alterar($tabela, $Arraycampos, $where=NULL, $depurar=FALSE){
		
		$connec = $this->conectar();
		
		$j=1;
		$campos=null;
		foreach($Arraycampos AS $field=>$value){
			if($field == "nu_cpf" || $field == "nu_rg"){
				$campos .= $field."='" . $value . "'";
			}else{
				$campos .= $field."=" . $this->retornaTipo($value);
			}
			if($j<count($Arraycampos)){
				$campos.= ",";
			}
			$j++;
		}
		
		$this->query="UPDATE ".$tabela." SET ".$campos;
		
		if ( $where != NULL )
			$this->query.=" WHERE ".$where;
			
		if ($depurar){
			print '<pre>'.$this->query.'</pre>';
			exit;
		}						
		
		mysql_query($this->query) or die ("Nao foi possivel alterar no Banco com a querie:<pre>" . $this->query . "</pre>");

		mysql_close($connec);
		
	}
	
	function apagar($tabela,$where=NULL,$depurar=FALSE){
		
		$connec = $this->conectar();
		
		$this->query="DELETE FROM ".$tabela;
		
		if ( $where != NULL )
			$this->query.=" WHERE ".$where;
			
		if ($depurar){
			print '<pre>'.$this->query.'</pre>';
			exit;
		}			
					
		mysql_query($this->query) or die ("Nao foi possivel deletar no Banco com a querie:<pre>" . $this->query . "</pre>");
		
		mysql_close($connec);
		
	}
	
	function query($query,$depurar=FALSE){
	
		$connec = $this->conectar();
		
		$this->query=$query;
			
		if ($depurar){
			print '<pre>'.$this->query.'</pre>';
			exit;
		}			
					
		$res = mysql_query($this->query) or die ("ERRO: <pre>" . $this->query . "</pre>");

		mysql_close($connec);
		
		return $res;
	
	}
	
	
	/**
	 * Retorna o tipo do campo
	 * @param Campo $param
	 * @return string|Tipo: string, integer.
	 */
	private function retornaTipo($param) {
		if($param == "NOW()" || $param == "CURRENT_TIMESTAMP"){
			return $param;
		}elseif(is_numeric($param)){
			return $param;
		}elseif($param=="TRUE" || $param=="FALSE" || $param=="true" || $param=="false"){
			return $param;
		}elseif(is_string($param)){
			return "'" . $param . "'";
		}
	}
}
?>