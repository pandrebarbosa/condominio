<p></p>
<!--Alertas-->
<div class="alert alert-dismissable text-center" style="display: none;" id="alertas">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
	<strong>Atenção!</strong>
</div>
<!--/Alertas-->
<div class="row">
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
			  <div class="panel-heading">
				<ol class="breadcrumb">
				  <li><a href="?ido=<?php echo base64_encode("inicio")?>">Início</a></li>
				  <li class="active">Ficha da unidade <span id="NomeUnidadeApresentacao"></span></li>
				</ol>
			  </div><!-- Fim do breadcrumb -->
			  
			  <div class="panel-body">
					<div class="tab-pane fade in active" id="ficha">
						<div class="panel panel-info">
							<div class="panel-heading">
								Moradores
							</div>
							<div class="panel-body" id="gridMoradores"></div>
						</div>
		
						<div class="panel panel-info">
							<div class="panel-heading">
								Veículos
							</div>
							<div class="panel-body" id="gridVeiculos"></div>
						</div>
		
						<div class="panel panel-info">
							<div class="panel-heading">
								Animais de estimação
							</div>
							<div class="panel-body" id="gridAnimais"></div>
						</div>
					</div> <!-- Fim de ficha -->
			  </div><!-- Fim da panel-body -->
                
            </div><!-- Fim da panel with-nav-tabs panel-default -->
        </div><!-- Fim da col-md-12 -->
        
		<input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>">
		<input type="hidden" id="co_unidade" value="<?php echo isset($_GET['co_unidade']) ? $_GET['co_unidade'] : ''?>">
		<input type="hidden" id="co_torre" value="<?php echo $_GET['no_torre']?>">
		<input type="hidden" id="nu_numero" value="<?php echo $_GET['nu_numero']?>">
		
</div><!-- Fim da row -->

<script>
$('#NomeUnidadeApresentacao').html( 'Torre ' + $('#co_torre').val() + ' Unidade: ' + $('#nu_numero').val());
var montaResultadoTabela = function(result, header, divResultado) {
	if(result){
		var arr = ["jpg","gif","png","PNG","GIF","JPG"];
		var tabela = "<table class='table table-striped'>";
			tabela += "<tr>";
			$.each(header, function (key, val) {
				tabela += "<th>" + val + "</th>";
			});
			tabela += "</tr>";
	
		$.each(result, function (key, val) {
			tabela += "<tr>";
			$.each(header, function (k, v) {
				var nome = val[v];
				var campo = nome.split(".");
				if(jQuery.inArray( campo[1], arr ) >= 0 ){
					if(val[v] != "---"){
						tabela += "<td><img src='<?php echo $_SESSION['credencial']['ambiente']=="DEV" ? "/condominiosanraphael" : "" ?>/arquivos/imagens/pessoas/"+val[v]+"' class='img-thumbnail' style='width: 50px;' /></td>";
					}else{
						tabela += "<td><img src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' class='img-thumbnail' style='width: 50px;' /></td>";
					}
				}else{
					tabela += "<td>" + val[v] + "</td>";
				}
			});
			tabela += "</tr>";
	
		});
		tabela += "</table>";
	}else{
		tabela = "Não há registros.";
	}
	$('#' + divResultado).html(tabela).fadeIn('slow');
};

var gridMoradores = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,	  
	  url: "services/moradores/listarMoradoresPorUnidadeJSON.php",
	  data: { co_unidade: $('#co_unidade').val() }
	}).done(function( data ) {
		var header = ["Foto", "Nome", "Tipo morador", "Profissão"];
		montaResultadoTabela(data, header, "gridMoradores");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; gridMoradores();


var gridVeiculos = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,	  
	  url: "services/veiculos/listarVeiculosPorUnidadeJSON.php",
	  data: { co_unidade: $('#co_unidade').val() }
	}).done(function( data ) {
		var header = ["Tipo", "Nome/Modelo", "Placa", "Vaga" ];
		montaResultadoTabela(data, header, "gridVeiculos");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; gridVeiculos();

var gridAnimais = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,	  
	  url: "services/animais-estimacao/listarAnimaisPorUnidadeJSON.php",
	  data: { co_unidade: $('#co_unidade').val() }
	}).done(function( data ) {
		var header = ["Foto", "Nome", "Tipo", "Raça", "Cor"];
		montaResultadoTabela(data, header, "gridAnimais");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; gridAnimais();
</script>