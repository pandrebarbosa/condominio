<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "";
$txt_criterio = isset($_POST["criterio"]) ? $_POST["criterio"] : '';
if ($txt_criterio != "") {
    $criterio = "pe.no_pessoa like '%" . $txt_criterio . "%' OR concat(tr.no_torre,u.nu_numero) like '%" . $txt_criterio . "%'";
}

$campos = "concat(tr.no_torre,u.nu_numero) AS apartamento, tu.no_tipo_unidade, tm.no_tipo_morador, pe.no_pessoa, mo.co_pessoa, mo.co_torre, mo.nu_numero, mo.co_tipo_unidade";
$tabelas = "tb_morador AS mo
			INNER JOIN tb_pessoa AS pe ON pe.co_pessoa=mo.co_pessoa
			INNER JOIN tb_unidade AS u ON u.co_torre=mo.co_torre AND u.co_tipo_unidade=mo.co_tipo_unidade AND u.nu_numero=mo.nu_numero
			INNER JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=mo.co_tipo_morador
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade
			INNER JOIN tb_torre AS tr ON tr.co_torre=u.co_torre";

$totalDeRegistros = $banco->seleciona($tabelas, $campos, "$criterio", "", "", "", FALSE);

if ($totalDeRegistros!= "") {

    /* Paginacao*/
	$totalDeRegistros = count($totalDeRegistros);
    $maximo = 10;
    $pagina = isset($_POST["pagina"]) && $_POST["pagina"] != "" ? $_POST["pagina"] : 1;
    $inicio = $pagina - 1;
    $inicio = $maximo * $inicio;
    $menos = $pagina - 1;
    $mais = $pagina + 1;
    $pgs = ceil($totalDeRegistros / $maximo);
?>
<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Apartamento</th>
        <th>Tipo</th>
        <th>Morador</th>
        <th></th>
    </tr>
	<?php
    $pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "", "concat(tr.no_torre,u.nu_numero)", "$inicio,$maximo", FALSE);
    foreach ($pedidos as $dados) {
    ?>
	  <tr>
        <td></td>
        <td><?php echo $dados['apartamento'] ?></td>
        <td><?php echo $dados['no_tipo_unidade'] ?></td>
        <td><?php echo $dados['no_pessoa'] ." (<i>" . $dados['no_tipo_morador'] . "</i>)" ?></td>
        <td>
        	<a class="btn btn-primary" title="Detalhar" href="?ido=moradores-manter&co_pessoa=<?php echo $dados['co_pessoa'] ?>&co_torre=<?php echo $dados['co_torre'] ?>&nu_numero=<?php echo $dados['nu_numero'] ?>&co_tipo_unidade=<?php echo $dados['co_tipo_unidade'] ?>"><i class="glyphicon glyphicon-pencil"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<ul class="pagination">
	<?php
    if ($pgs > 1) {

        // Mostragem de pagina
        if ($menos > 0) {
            echo "<li class=\"active\"><a href=\"javascript:grid($menos,'$criterio')\">anterior</a></li>";
        }

        // Listando as paginas
        for ($i = 1; $i <= $pgs; $i ++) {
            if ($i != $pagina) {
                echo "<li class=\"active\"><a href=\"javascript:grid($i,'$criterio')\">$i</a></li>";
            } else {
                echo "<li class=\"disabled\"><a>" . $i . "</a></li>";
            }
        }

        if ($mais <= $pgs) {
            echo "<li class=\"active\"><a href=\"javascript:grid($mais,'$criterio')\">prÃ³xima</a></li>";
		}
	} ?>
</ul>
<?php
}else{
	echo "Não foram encontrados registros.";
} ?>