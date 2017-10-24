<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$co_unidade = isset($_POST["co_unidade"]) ? $_POST["co_unidade"] : '';

$criterio = "u.co_unidade =" . $co_unidade . " AND v.st_ativo IS TRUE";

$campos = "v.co_veiculo,vg.nu_numero,v.ds_cor,UPPER(v.ds_placa) AS ds_placa,tv.no_tipo_veiculo,mv.no_modelo_veiculo";
$tabelas = "tb_veiculo AS v
			INNER JOIN tb_unidade AS u ON u.co_unidade=v.co_unidade
			LEFT  JOIN tb_unidade AS vg ON v.co_vaga=vg.co_unidade
			INNER JOIN tb_tipo_veiculo AS tv ON tv.co_tipo_veiculo=v.co_tipo_veiculo
			INNER JOIN tb_modelo_veiculo AS mv ON mv.co_modelo_veiculo=v.co_modelo_veiculo";

$totalDeRegistros = $banco->seleciona($tabelas, $campos, "$criterio", "", "", "", FALSE);

if ($totalDeRegistros!= "") { ?>
<table class="table table-striped">
    <tr>
        <th>Tipo</th>
        <th>Veículo/cor</th>
        <th>Placa</th>
        <th>Garagem</th>
        <th></th>
    </tr>
	<?php
    $pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "", "", "", FALSE);
    foreach ($pedidos as $dados) {
    ?>
	  <tr>
	  	<td><?php echo $dados['no_tipo_veiculo'] ?></td>
        <td><?php echo $dados['no_modelo_veiculo'] ." " . $dados['ds_cor'] ?></td>
        <td><?php echo $dados['ds_placa'] ?></td>
        <td><?php echo "GR".$dados['nu_numero'] ?></td>
        <td align="right">
        	<a class="btn btn-primary btn-sm" title="Editar" href="javascript:carregaVeiculo(<?php echo $dados['co_veiculo'] ?>);"><i class="glyphicon glyphicon-pencil"></i></a>
			<a class="btn btn-primary btn-sm" title="Excluir" href="javascript:abrirModalExcluirVeiculo(<?php echo $dados['co_veiculo'] ?>);"><i class="glyphicon glyphicon-trash"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<?php
}else{
	echo "Não foram encontrados registros.";
} ?>