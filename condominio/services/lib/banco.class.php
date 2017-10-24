<?php

class banco{

	private $conn;
	private $db;
	private $query;
	private $data;
	

	function conectar(){
		$amb = toolBox::retornaAmbiente();
			
		if($amb == "DEV"){
			$conn = @mysql_connect('localhost','root','') or die("Erro[connection]: " . mysql_error());
			mysql_select_db('sanraphael') or die("Erro[select_db]: " . mysql_error());
			
			return $conn;
		}else{
			$conn = @mysql_connect("ranraphael.mysql.dbaas.com.br", "sanraphael", "csraphael2613") or die("Erro[conn]: " . mysql_error());
			mysql_select_db("sanraphael") or die("Erro[select_db]: " . mysql_error());
			
			return $conn;
		}
		
	}

	
	function seleciona($tabela, $campos, $where=NULL, $group_by=NULL, $order_by=NULL, $limit=NULL, $depurar=FALSE){
		
		$data="";
		$conexao = $this->conectar();
		
		$this->query="SELECT ".$campos." FROM ".$tabela;
		
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
			
		$res=mysql_query($this->query) or die ("Nao foi possivel selecionar no Banco com a querie:<pre>" . $this->query . "</pre>");
			
		while($row=mysql_fetch_assoc($res)){
			$data[]=$row;
		}
		mysql_close($conexao);
		mysql_free_result($res);
		
		return $data;
	  
	}
	
	function insere($tabela,$campos,$valores,$depurar=FALSE){
		
		$conexao = $this->conectar();
		
		$this->query="INSERT INTO ".$tabela." (".$campos.") VALUES (".$valores.")";
		
		if ($depurar){
			print '<pre>'.$this->query.'</pre>';
			exit;
		}			
		
		mysql_query($this->query) or die ("Nao foi possivel inserir no Banco com a querie:<pre>" . $this->query . "</pre>");
		
		$retorno = mysql_insert_id();
				
		$conexao = mysql_close($conexao);
		
		return $retorno;		
		
	}
	
	function apaga($tabela,$where=NULL,$depurar=FALSE){
		
		$conexao = $this->conectar();
		
		$this->query="DELETE FROM ".$tabela;
		
		if ( $where != NULL )
			$this->query.=" WHERE ".$where;
			
		if ($depurar){
			print '<pre>'.$this->query.'</pre>';
			exit;
		}			
					
		mysql_query($this->query) or die ("Nao foi possivel deletar no Banco com a querie:<pre>" . $this->query . "</pre>");
		
		$conexao = mysql_close($conexao);
		
	}
	
	function altera($tabela,$campos,$where=NULL,$depurar=FALSE){
		
		$conexao = $this->conectar();
		
		$this->query="UPDATE ".$tabela." SET ".$campos;
		
		if ( $where != NULL )
			$this->query.=" WHERE ".$where;
			
		if ($depurar){
			print '<pre>'.$this->query.'</pre>';
			exit;
		}						
		
		mysql_query($this->query) or die ("Nao foi possivel alterar no Banco com a querie:<pre>" . $this->query . "</pre>");

		$conexao = mysql_close($conexao);
		
	}	
}
?>