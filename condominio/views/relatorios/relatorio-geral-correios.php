<p></p>
<!--Alertas-->
<div class="alert alert-dismissable" style="display: none;" id="alertas">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
	<strong>Atenção!</strong>
</div>
<!--/Alertas-->     
<div class="panel panel-default">
  <div class="panel-heading">
	<ol class="breadcrumb">
	  <li><a href="?ido=inicio">Início</a></li>
	  <li><a href="?ido=correios-listar">Relatório de correspondências</a></li>
	</ol>
  </div>
  
  <div class="panel-body">
	<div id="frame"></div>
  </div>
  
</div>
<script>
$( "#btn-buscar" ).click(function() {
	montaRelatorio($( "#dt_entrada" ).val());
	return false;
});

var montaRelatorio = function(data) {
	$('#frame').html(null);
	var html = '<iframe src="views/relatorios/relatorio-geral-correios-pdf.php" frameborder="0" style="height:600px; width: 100%">'
	$('#frame').html(html);
}; montaRelatorio($( "#dt_entrada" ).val());
</script>