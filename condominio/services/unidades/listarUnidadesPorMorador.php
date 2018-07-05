<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$campos = "u.nu_numero,tu.sg_sigla_unidade,u.nu_numero,tu.co_tipo_unidade,tu.no_tipo_unidade,p.no_pessoa AS morador,p.co_pessoa,tm.no_tipo_morador,u.co_unidade,t.no_torre";
$tabelas = "tb_morador AS m
			LEFT JOIN tb_unidade AS u ON m.co_unidade=u.co_unidade AND u.st_ativo IS TRUE
			LEFT JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
			LEFT JOIN tb_torre AS t ON t.co_torre=u.co_torre
			LEFT JOIN tb_pessoa AS p ON p.co_pessoa=m.co_pessoa
			LEFT JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=m.co_tipo_morador";
$criterio = "m.co_pessoa = " . $_SESSION['credencial']['co_pessoa'];
?>
<div class="list-group">
	<a href="#" class="list-group-item active"><h3 class="H3Menor">Minhas unidades</h3></a>
	<?php
    $pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "u.co_unidade", "", "", FALSE);
    foreach ($pedidos as $dados) {
    	if($dados['co_tipo_unidade'] == 1 || $dados['co_tipo_unidade'] == 4){
    ?>	
		<a href="default.php?ido=<?php echo base64_encode("abrir-ficha-unidade")?>&co_unidade=<?php echo $dados['co_unidade'] ?>&nu_numero=<?php echo $dados['nu_numero'] ?>&no_torre=<?php echo $dados['no_torre'] ?>" class="list-group-item">
			<?php
			//Se for apartamento, mostra a torre
        	if( $dados['co_tipo_unidade']==1 ){
        		echo "Torre ".$dados['no_torre']. " - " .$dados['no_tipo_unidade'].": ".$dados['nu_numero'];
        	}else{
        		echo $dados['no_tipo_unidade'].": ".$dados['nu_numero'];
        	} ?>
		</a>
	<?php }else{ ?>
		<a class="list-group-item">
			<?php
			//Se for apartamento, mostra a torre
        	if( $dados['co_tipo_unidade']==1 ){
        		echo "Torre ".$dados['no_torre']. " - " .$dados['no_tipo_unidade'].": ".$dados['nu_numero'];
        	}else{
        		echo $dados['no_tipo_unidade'].": ".$dados['nu_numero'];
        	} ?>
		</a>	
		
<?php } } ?>
</div>