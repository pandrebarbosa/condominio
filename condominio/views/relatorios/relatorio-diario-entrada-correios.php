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
	  <li><a href="?ido=correios-listar">Relatório Diário de Correspondências</a></li>
	</ol>
  </div>
  <div class="panel-body">
	
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
				<label for="exampleInputEmail1">Data da entrada</label>
				<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
					<input type="text" class="form-control mascara-data" id="dt_entrada" value="<?php echo date("d/m/Y")?>" >
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
					</div>
				</div>			
			</div>
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
				<br />
				<button class="btn btn-info" id="btn-buscar">Gerar</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4"></div>			
		</div><!-- Fecha div row -->
		<p></p>
		
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
	var html = '<iframe src="views/relatorios/relatorio-diario-entrada-correios-pdf.php?data='+data+'" frameborder="0" style="height:600px; width: 100%">'
	$('#frame').html(html);
}; montaRelatorio($( "#dt_entrada" ).val());
</script>