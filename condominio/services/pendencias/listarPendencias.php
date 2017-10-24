<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$resContato = $banco->seleciona("tb_contato",
		"count(co_contato) AS qtd",
		"co_pessoa = " . $_SESSION['credencial']['co_pessoa']." AND st_ativo IS TRUE",
		NULL, NULL, NULL, NULL);

?>
<div class="list-group">
	<a href="#" class="list-group-item active"><h3 class="H3Menor">Pendências no cadastro</h3></a>
	<?php if($resContato[0]['qtd']==0){?>
	<a class="list-group-item">Cadastre ao menos um contato!</a>
	<?php }else{?>
	<a class="list-group-item">Não há pendências!</a>
	<?php }?>
	
</div>