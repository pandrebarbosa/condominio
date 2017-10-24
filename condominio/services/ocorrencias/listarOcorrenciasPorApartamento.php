<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$co_unidade = isset($_POST["co_unidade"]) ? $_POST["co_unidade"] : '';

$criterio = "o.co_unidade =" . $co_unidade . " AND o.st_ativo IS TRUE";


$campos = "o.co_ocorrencia,o.ds_titulo,DATE_FORMAT(o.dt_hr_ocorrencia,'%d/%m/%Y %H:%i') AS dt_hr_ocorrencia,toc.ds_tipo_ocorrencia";
$tabelas = "tb_ocorrencia AS o
			INNER JOIN tb_unidade AS u ON u.co_unidade=o.co_unidade
			INNER JOIN tb_tipo_ocorrencia AS toc ON toc.co_tipo_ocorrencia=o.co_tipo_ocorrencia";

$totalDeRegistros = $banco->seleciona($tabelas, $campos, "$criterio", "", "", "", FALSE);

if ($totalDeRegistros!= "") { ?>
<table class="table table-striped">
    <tr>
        <th>Tipo</th>
        <th>Título</th>
        <th>Data/hora</th>
        <th></th>
    </tr>
	<?php
    $pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "", "", "", FALSE);
    foreach ($pedidos as $dados) {
    ?>
	  <tr>
	  	<td><?php echo $dados['ds_tipo_ocorrencia'] ?></td>
        <td><?php echo $dados['ds_titulo'] ?></td>
        <td><?php echo $dados['dt_hr_ocorrencia'] ?></td>
        <td align="right">
        	<a class="btn btn-primary btn-sm" title="Editar" href="javascript:carregaOcorrencia(<?php echo $dados['co_ocorrencia'] ?>);"><i class="glyphicon glyphicon-pencil"></i></a>
			<a class="btn btn-primary btn-sm" title="Excluir" href="javascript:abrirModalExcluirOcorrencia(<?php echo $dados['co_ocorrencia'] ?>);"><i class="glyphicon glyphicon-trash"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<?php
}else{
	echo "Não foram encontrados registros.";
} ?>