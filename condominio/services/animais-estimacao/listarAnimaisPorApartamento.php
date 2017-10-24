<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$co_unidade = isset($_POST["co_unidade"]) ? $_POST["co_unidade"] : '';

$criterio = "ad.co_unidade =" . $co_unidade . " AND ad.st_ativo IS TRUE";


$campos = "ad.co_animal_domestico,ta.no_tipo_animal,r.no_raca,ad.ds_cor,ad.ds_nome";
$tabelas = "tb_animal_domestico AS ad
			INNER JOIN tb_unidade AS u ON u.co_unidade=ad.co_unidade
			INNER JOIN tb_tipo_animal AS ta ON ta.co_tipo_animal=ad.co_tipo_animal
			INNER JOIN tb_raca AS r ON r.co_raca=ad.co_raca";

$totalDeRegistros = $banco->seleciona($tabelas, $campos, "$criterio", "", "", "", FALSE);

if ($totalDeRegistros!= "") { ?>
<table class="table table-responsive table-striped">
    <tr>
        <th>Animal</th>
        <th>Nome</th>
        <th>Raça/cor</th>
        <th></th>
    </tr>
	<?php
    $pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "", "", "", FALSE);
    foreach ($pedidos as $dados) {
    ?>
	  <tr>
	  	<td><?php echo $dados['no_tipo_animal'] ?></td>
	  	<td><?php echo $dados['ds_nome'] ?></td>
        <td><?php echo $dados['no_raca'] ." " . $dados['ds_cor'] ?></td>
        <td align="right">
        	<a class="btn btn-primary btn-sm" title="Editar" href="javascript:carregaAnimal(<?php echo $dados['co_animal_domestico'] ?>);"><i class="glyphicon glyphicon-pencil"></i></a>
			<a class="btn btn-primary btn-sm" title="Excluir" href="javascript:abrirModalExcluirAnimal(<?php echo $dados['co_animal_domestico'] ?>);"><i class="glyphicon glyphicon-trash"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<?php
}else{
	echo "Não foram encontrados registros.";
} ?>