<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$co_unidade = isset($_POST["co_unidade"]) ? $_POST["co_unidade"] : '';

$criterio = "mo.co_unidade= " . $co_unidade . " AND mo.st_ativo IS TRUE";

$campos = "tm.no_tipo_morador,pe.no_pessoa,pe.ds_foto,pe.co_pessoa,DATE_FORMAT(pe.dt_nascimento,'%d/%m/%Y') AS dt_nascimento,DATE_FORMAT(mo.dt_inicio,'%d/%m/%Y') AS dt_inicio";
$tabelas = "tb_morador AS mo
			INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
			INNER JOIN tb_unidade AS u ON u.co_unidade=mo.co_unidade
			INNER JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=mo.co_tipo_morador
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
			INNER JOIN tb_torre AS tr ON tr.co_torre=u.co_torre";

$totalDeRegistros = $banco->seleciona($tabelas, $campos, "$criterio", "", "", "", FALSE);

if ($totalDeRegistros!= "") { ?>
<table class="table table-striped">
    <tr>
        <th></th>
        <th>Morador</th>
        <th>Data nascimento</th>
        <th>Data entrada</th>
        <th></th>
    </tr>
	<?php
    $pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "", "concat(tr.no_torre,u.nu_numero)", "", FALSE);
    foreach ($pedidos as $dados) {
    ?>
	  <tr>
	    <td><?php if( $dados['ds_foto'] ){?>
	    	<img src="<?php echo $_SESSION['credencial']['ambiente']=="DEV" ? "/condominiosanraphael" : "" ?>/arquivos/imagens/pessoas/<?php echo $dados['ds_foto'] ?>" class="img-thumbnail" style="width: 80px;" />
	    	<?php }else{?>
	    	<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="img-thumbnail" style="width: 80px;" />
	    	<?php }?>
	    </td>
        <td><a href="javascript:carregaMorador(<?php echo $dados['co_pessoa'] ?>);"><?php echo $dados['no_pessoa'] ." (<i>" . $dados['no_tipo_morador'] . "</i>)" ?></a></td>
        <td><?php echo $dados['dt_nascimento'] ?></td>
        <td><?php echo $dados['dt_inicio'] ?></td>
        <td align="right">
        	<a class="btn btn-primary btn-sm" title="Editar" href="javascript:carregaMorador(<?php echo $dados['co_pessoa'] ?>);"><i class="glyphicon glyphicon-pencil"></i></a>
			<a class="btn btn-primary btn-sm" title="Excluir" href="javascript:abrirModalExcluirMorador(<?php echo $dados['co_pessoa'] ?>);"><i class="glyphicon glyphicon-trash"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<?php
}else{
	echo "Não foram encontrados registros.";
} ?>