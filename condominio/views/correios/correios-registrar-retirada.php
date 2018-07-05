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
	<div class="row">
		<div class="col-sm-11">
			<ol class="breadcrumb">
			  <li><a href="?ido=<?php echo base64_encode("inicio")?>">Início</a></li>
			  <li><a href="?ido=<?php echo base64_encode("correios-listar")?>">Lista de correspondências</a></li>
			  <li class="active">Retirada de correspondências</li>
			</ol>
		</div>
		<div class="col-sm-1 text-right">
			<span id="ajuda-correio-retirada" class="glyphicon glyphicon-question-sign ajuda">
		</div>
	</div>	
  </div>
  <div class="panel-body">

	<form role="form" name="frm-usuarios" id="frm-usuarios">
	
		<div class="alert alert-success" id="dados-entrada" role="alert"></div>
		<div class="alert alert-warning hide" id="dados-retirada" role="alert"></div>
		
		<div id="formulario">		
    		<div class="row">
    			<!-- Fecha div col-md-3 -->
    			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
    	            <label for="exampleInputEmail1">Data/hora da retirada</label>
                    <div class='input-group date datetimepicker' id='datetimepicker'>
                        <input type='text' id="dt_hr_retirada" value="<?php echo date("d/m/Y H:i")?>" class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>				
    			</div>
    			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4"></div>
    			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4"></div>			
    		</div><!-- Fecha div row -->
		
    		<p></p>
    		<div class="row">
    			<div class="col-md-12">
    				<label for="exampleInputEmail1">Observação</label>
    				<textarea class="form-control" rows="4" id="ds_observacao"></textarea>
    			</div>										
    		</div>
    		<p></p>
    		<div class="panel-footer text-right">
    			<button type="button" class="btn btn-primary" id="btn-salvar-correspondencia">Salvar</button>
    			<button type="reset" id="btn-reset-morador" class="btn btn-default">Cancelar</button>
    		</div><!-- Fim div panel-footer -->
    		
    		<input type="hidden" id="co_funcionario_retirada" value="<?php echo $_SESSION['credencial']['co_pessoa']?>" >
    		<input type="hidden" id="co_item_correio" value="<?php echo isset($_GET['co_item_correio']) ? $_GET['co_item_correio'] : ''?>" >
		</div>
</form>

<!-- Modal confirma senha Usuario -->
<div class="modal fade" id="modal-confirmar-morador" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-confirmar-morador">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			Confirmar a retirada pelo morador
			</div>
            <div class="modal-body text-center">
        		<div class="row">
        			<div class="col-md-12">
        				Digite os 4 últimos digitos de seu CPF:
        			</div>										
        		</div>				
        		<div class="row">
        			<div class="col-md-12">
        				<input type="password" maxlength="4" class="form-control" id="ultomos_digitos_cpf" />
        				<input type="hidden" id="co_item_correio_confirmar">
        			</div>										
        		</div>				
            </div>
            <div class="modal-footer">
                  <button id="btn-excluir" class="btn btn-default">Confirmar</button>
                  <button id="btn-cancelar" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var abreModalConfirmacao = function(id) {
	$('#co_item_correio_excluir').val(id);
	$('#modal-confirmar-morador').modal('show');	
};

$( "#ajuda-correio-retirada" ).click(function() {
	$( "#img-ajuda" ).attr('src','img/ajuda/retirada-correspondencias.png');
	$( "#modal-ajuda" ).modal('show');
});

$('#ds_observacao').maxlength({
	max: 120,
	feedbackText: '{r} caracteres (máximo de {m})', 
}); 

$( "#btn-salvar-correspondencia" ).click(function() {
	gravarRetirada();
});

var carregaCorreio = function(co_item_correio) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/correios/listarDadosEntradaCorrespondencia.php",
		  data: { co_item_correio: co_item_correio }
		}).done(function( data ){
			montaResultadoEntrada(data);
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};carregaCorreio($("#co_item_correio").val());

var montaResultadoEntrada = function(data) {
	var resultado = "<h3 class='H3Menor'>Dados da entrada</h3>";
		resultado += "<b>Data/hora chegada:</b> " + data[0].dt_hr_chegada + "<br />";
		resultado += "<b>Unidade:</b> " + data[0].unidade + "<br />";
		resultado += "<b>Item:</b> " + data[0].item + "<br />";
		resultado += "<b>Recebedor:</b> " + data[0].recebedor + "<br />";
		resultado += "<b>Observação:</b><br />";
		resultado += "<em>"+data[0].ds_observacao+"</em>";

	$('#dados-entrada').html(resultado);

}

var carregaDadosDaRetirada = function(co_item_correio) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/correios/listarDadosRetiradaCorrespondencia.php",
		  data: { co_item_correio: co_item_correio }
		}).done(function( data ){
			if(data != false){
				montaResultadoRetirada(data);
				$("#formulario").hide();
			}
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};carregaDadosDaRetirada($("#co_item_correio").val());

var montaResultadoRetirada = function(data) {
	var resultado = "<h3 class='H3Menor'>Dados da Retirada</h3>";
		resultado += "<b>Data/hora retirada:</b> " + data[0].dt_hr_retirada + "<br />";
		resultado += "<b>Recebedor:</b> " + data[0].recebedor + "<br />";
		resultado += "<b>Observação:</b><br />";
		resultado += "<em>"+data[0].ds_retirada+"</em>";
	$('#dados-retirada').html(resultado).removeClass('hide');

}

var gravarRetirada = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/correios/gravarRetirada.php",
	  data: { co_item_correio: $('#co_item_correio').val(),
		  	  co_funcionario_retirada: $('#co_funcionario_retirada').val(),
		  	  dt_hr_retirada: $('#dt_hr_retirada').val(),
		  	  ds_observacao: $('#ds_observacao').val()
		    } 
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
		document.location.href="?ido=correios-listar";		
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

</script>
