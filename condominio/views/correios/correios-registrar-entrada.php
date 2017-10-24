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
			  <li><a href="?ido=inicio">Início</a></li>
			  <li><a href="?ido=correios-listar">Lista de correspondências</a></li>
			  <li class="active">Entrada de correspondências</li>
			</ol>		
		</div>
		<div class="col-sm-1 text-right">
			<span id="ajuda-correio-entrada" class="glyphicon glyphicon-question-sign ajuda">
		</div>
	</div>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-usuarios" id="frm-usuarios">
		
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">
				<label>Torre</label>
				<select id="co_torre" class="form-control"></select>
			</div><!-- Fecha div col-md-3 -->
			
			<div class="col-xs-2 col-sm-2 col-md-4 col-lg-3">
				<label>Unidade</label>
				<select id="co_unidade" class="form-control">
				<option>Selecione</option>
				</select>
			</div>
		</div><!-- Fecha div row -->
	
		<p></p>
		<div class="row hide" id="lista-moradores">
			<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
			Morador
			</div>
		<p></p>
		</div><!-- Fecha div row -->
	
		<div class="row">
			<!-- Fecha div col-md-3 -->
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
				<label>Tipo de correspondencia</label>
				<select id="co_tipo_item_correio" class="form-control"></select>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
				<label for="exampleInputEmail1">Identificação</label>
				<input type="text" class="form-control" id="ds_item" placeholder="Ex. AA123456789BR" required>
			</div>			
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	            <label for="exampleInputEmail1">Data/hora da chegada</label>
                <div class='input-group datetimepicker' id='datetimepicker'>
                    <input type='text' id="dt_hr_chegada" value="<?php echo date("d/m/Y H:i")?>" class="form-control date_time" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>				
			</div>
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
		
		<input type="hidden" id="co_funcionario_recebimento" value="<?php echo $_SESSION['credencial']['co_pessoa']?>" >
	</form>

  </div>
</div>

<!-- Modal confirma CPF -->
<div class="modal fade" id="modal-confirmar-impressao" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-confirmar-impressao">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			Imprimir comprovante
			</div>
            <div class="modal-body text-center" id="iframeCorreio">
								
            </div>
            <div class="modal-footer">
                  <button id="btn-cancelar" class="btn btn-default">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$('#ds_observacao').maxlength({
	max: 100,
	feedbackText: '{r} caracteres (máximo de {m})', 
}); 

var carregaTorres = function(selecionado) {
	var options = "<option>Selecione</option>";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/torres/carregarListaTorres.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_torre + '" '+(val.co_torre==selecionado ? 'selected' : '')+'>Torre ' + val.no_torre + '</option>';
		});
		$("#co_torre").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaTorres(null);

var carregaUnidades = function(co_torre) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/unidades/listarUnidadesPorTorre.php",
	  data: { co_torre: co_torre }
	}).done(function( data ){
		var options = "<option>Selecione</option>";
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_unidade + '">' + val.nu_numero + ' (' + val.no_tipo_unidade + ')</option>';
		});
		$("#co_unidade").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

$( "#co_torre" ).change(function() {
	if($( "#co_torre" ).val()>0){
		carregaUnidades($("#co_torre").val());
	}else{
		$("#co_unidade").html("<option>Selecione</option>");
	}
});

$( "#ajuda-correio-entrada" ).click(function() {
	$( "#img-ajuda" ).attr('src','img/ajuda/entrada-correspondencias.png');
	$( "#modal-ajuda" ).modal('show');
});


var carregaTipoItemCorreio = function(selecionado) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/tipo-item-correio/listarTipoItemCorreioJSON.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_tipo_item_correio + '" '+(val.co_tipo_item_correio==selecionado ? 'selected' : '')+'>' + val.no_tipo_item_correio + '</option>';
		});
		$("#co_tipo_item_correio").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaTipoItemCorreio(null);


//Tooltip do CPF do morador
$( '[for=cpfMorador]' ).tooltip({
    track: true,
    content: "<div class='msgTooltip'>Caso haja algum erro no CPF, envie uma mensagem para ajuda@condominiosanraphael.com.br</div>"
});
//Tooltip do CPF do morador
$( '[for=empresaContratante]' ).tooltip({
    track: true,
    content: "<div>Nome da empresa terceirizada pelo condomínio responável pelo funcionário.</div>"
});


var ValidaCampoCorreio = function() {	
    if ($("#co_unidade").val() == "Selecione"){
    	mostrarAlertas("erro","Unidade não identificada!");
    	$("#co_unidade").focus();
        return false;
    }
    if ($("#co_tipo_item_correio").val() == ""){
    	mostrarAlertas("erro","Tipo de correspondência não identificada!");
    	$("#co_tipo_item_correio").focus();
        return false;
    }
   
    if ($("#ds_item").val() == ""){
    	mostrarAlertas("erro","Identificação não preenchida!");
        $("#ds_item").focus();
        return false;
    }
    if ($("#dt_hr_chegada").val() == ""){
    	mostrarAlertas("erro","Data do recebimento não preenchido!");
        $("#dt_hr_chegada").focus();
        return false;
    }
        
    return true;
};


$( "#btn-cancelar" ).click(function() {
	$('#iframeCorreio').html(null);
	$('#modal-confirmar-impressao').modal('hide');	
});

$( "#btn-salvar-correspondencia" ).click(function() {
	if(ValidaCampoCorreio()){
		gravarCorreio();
	}
});

var abreModalImpressao = function(id) {
	varWindow = window.open ( "http://<?php echo $_SESSION['credencial']['ambiente']=="DEV" ? "localhost/condominiosanraphael" : "www.condominiosanraphael.com.br" ?>/condominio/views/correios/impressao.html?co_item_correio="+id,
							  'Impressão',
							  "width=100, height=50, top=100, left=400, scrollbars=no" );
};

var gravarCorreio = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/correios/gravar.php",
	  data: { co_unidade: $('#co_unidade').val(),
		      co_tipo_item_correio: $('#co_tipo_item_correio').val(),
		      ds_item: $('#ds_item').val(),
		      co_funcionario_recebimento: $('#co_funcionario_recebimento').val(),
		      dt_hr_chegada: $('#dt_hr_chegada').val(),
		      ds_observacao: $('#ds_observacao').val()
		    } 
	}).done(function( data ){
		abreModalImpressao(data.id);
		limpaCamposEntradaCorrespondencia();
		mostrarAlertas(data.tipo,data.msg);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

var limpaCamposEntradaCorrespondencia = function() {
	carregaTorres(null);
	$("#co_unidade").html("<option>Selecione</option>");
    $('#ds_item').val(null);
    $('#ds_observacao').val(null);
}
</script>
