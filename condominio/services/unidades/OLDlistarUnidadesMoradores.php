<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$criterio = "";
$txt_criterio = isset($_POST["criterio"]) ? $_POST["criterio"] : '';
if ($txt_criterio != "") {
    $criterio = "p.no_pessoa like '%" . $txt_criterio . "%' OR u.nu_numero = '" . $txt_criterio."'";
}

//TODO unidades sem ser garagem
$campos = "u.nu_numero,tu.sg_sigla_unidade,u.nu_numero,tu.co_tipo_unidade,tu.no_tipo_unidade,p.no_pessoa AS morador,p.co_pessoa,tm.no_tipo_morador,u.co_unidade,t.no_torre";
$tabelas = "tb_unidade AS u
			INNER JOIN tb_tipo_unidade AS tu ON tu.co_tipo_unidade=u.co_tipo_unidade AND u.co_tipo_unidade<>3
			LEFT JOIN tb_torre AS t ON t.co_torre=u.co_torre
			LEFT JOIN tb_morador AS m ON m.co_unidade=u.co_unidade
			LEFT JOIN tb_pessoa AS p ON p.co_pessoa=m.co_pessoa
			LEFT JOIN tb_tipo_morador AS tm ON tm.co_tipo_morador=m.co_tipo_morador";

$totalDeRegistros = $banco->seleciona($tabelas, $campos, "$criterio", "u.co_unidade", "", "", FALSE);

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
        <th>Unidade</th>
        <th>Morador</th>
        <th></th>
    </tr>
	<?php
    $pedidos = $banco->seleciona($tabelas, $campos, "$criterio", "u.co_unidade", "", "$inicio,$maximo", FALSE);
    foreach ($pedidos as $dados) {
    ?>
	  <tr>
        <td></td>
        <td><?php 
        		if( $dados['co_tipo_unidade']==1 ){
        			echo "Torre ".$dados['no_torre']. " - " .$dados['no_tipo_unidade'].": ".$dados['nu_numero'];
        		}else{
        			echo $dados['no_tipo_unidade']." - ".$dados['sg_sigla_unidade'].$dados['nu_numero'];
        		} ?>
        </td>
        <td><?php echo $dados['morador']=="" ? "Desocupado" : $dados['morador'] ." (<i>" . $dados['no_tipo_morador'] . "</i>)" ?></td>
        <td>
        	<a class="btn btn-primary btn-sm" title="Detalhar" href="default.php?ido=abrir-ficha-unidade&co_unidade=<?php echo $dados['co_unidade'] ?>&nu_numero=<?php echo $dados['nu_numero'] ?>&no_torre=<?php echo $dados['no_torre'] ?>"><i class="glyphicon glyphicon-eye-open"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<ul class="pagination">
	<?php
    if ($pgs > 1) {

        // Mostragem de pagina
        if ($menos > 0) {
            echo "<li class=\"active\"><a href=\"javascript:grid($menos,'$txt_criterio')\">anterior</a></li>";
        }

        // Listando as paginas
        for ($i = 1; $i <= $pgs; $i ++) {
            if ($i != $pagina) {
                echo "<li class=\"active\"><a href=\"javascript:grid($i,'$txt_criterio')\">$i</a></li>";
            } else {
                echo "<li class=\"disabled\"><a>" . $i . "</a></li>";
            }
        }

        if ($mais <= $pgs) {
            echo "<li class=\"active\"><a href=\"javascript:grid($mais,'$txt_criterio')\">próxima</a></li>";
		}
	} ?>
</ul>
<?php
}else{
	echo "Não foram encontrados registros.";
} ?>