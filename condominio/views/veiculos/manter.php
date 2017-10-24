<form role="form" name="frm-veiculos" id="frm-veiculos">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<label for="exampleInputEmail1">Tipo de veículo</label>
					<select id="co_tipo_veiculo" class="form-control"></select>
				</div>
				
				<div class="col-md-4">
				  <label>Escolha a garagem:</label><br />
					<select id="co_tipo_unidade" class="form-control"></select>
				</div>
				<div class="col-md-4">
				  <label>Escolha a vaga:</label><br />
					<select id="co_vaga" class="form-control"></select>
				</div>
			</div>
			<!-- Fecha div row -->
			<br />
			<div class="row">
				<div class="col-md-4">
					<label class="tooltipster" for="teste" title="Começe digitando o texto. Caso o termo já exista, clique nele. Caso contrário, complete o cadastro.">Nome/modelo <span class="glyphicon glyphicon-info-sign"></span></label>
					<input type="text" class="form-control" id="no_modelo_veiculo" placeholder="Nome/modelo" required>
					<input type="hidden" id="co_modelo_veiculo">
				</div><!-- Fecha div col-md-3 -->
				<div class="col-md-4">
					<label for="exampleInputEmail1">Cor</label>
					<input type="text" class="form-control" id="ds_cor" name="ds_cor" placeholder="Cor" required>
				</div><!-- Fecha div col-md-3 -->
				<div class="col-md-4">
					<label for="exampleInputEmail1">Placa</label>
					<input type="text" class="form-control placa" style="text-transform:uppercase" id="ds_placa" name="ds_placa" placeholder="Placa" required>
				</div>
				
			</div><!-- Fecha div row -->
			<p></p>
		</div><!-- Fecha div col-md-12 -->
		
	</div>
	<!-- Fim div row -->

	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar-veiculo">Gravar</button>
		<button type="reset" class="btn btn-default" id="btn-reset-veiculo">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_veiculo" value="<?php echo isset($_GET['co_veiculo']) ? $_GET['co_veiculo'] : ''?>">	
</form>
<script>
$( "#no_modelo_veiculo" ).click(function() {
	$( "#no_modelo_veiculo" ).val(null);
	$( "#co_modelo_veiculo" ).val(null);
});

var carregaTipoVeiculo = function(selecionado) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/tipos-de-veiculos/listarTiposDeVeiculosJSON.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_tipo_veiculo + '" '+(val.co_tipo_veiculo==selecionado ? 'selected' : '')+'>' + val.no_tipo_veiculo + '</option>';
		});
		$("#co_tipo_veiculo").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaTipoVeiculo(null);

var ValidaCampoVeiculos = function() {
    if ($("#co_unidade").val() == ""){
    	mostrarAlertas("erro","Unidade não identificada!");
        return false;
    }
    if ($("#co_tipo_veiculo").val() == ""){
    	mostrarAlertas("erro","Tipo de veículo não identificado!");
        $("#co_tipo_veiculo").focus();
        return false;
    }
    if ($("#co_tipo_unidade").val() == ""){
    	mostrarAlertas("erro","Garagem não selecionada!");
        $("#co_tipo_unidade").focus();
        return false;
    }    
    if ($("#co_vaga").val() == ""){
    	mostrarAlertas("erro","Vaga não escolhida!");
        $("#co_vaga").focus();
        return false;
    }    
    if ($("#no_modelo_veiculo").val() == ""){
    	mostrarAlertas("erro","Nome/modelo do veículo não preenchido!");
        $("#no_modelo_veiculo").focus();
        return false;
    }
    if ($("#ds_placa").val() == ""){
    	mostrarAlertas("erro","Placa do veículo não preenchida!");
        $("#ds_placa").focus();
        return false;
    }
    if ($("#ds_cor").val() == ""){
    	mostrarAlertas("erro","Cor do veículo não preenchida!");
        $("#ds_cor").focus();
        return false;
    }
            
    return true;
};
$( "#btn-salvar-veiculo" ).click(function() {
	if(ValidaCampoVeiculos()){
		gravaVeiculo();
	}
});

var options = {
		url: function(phrase) {
			return "services/veiculos/listarVeiculoModeloAutoComplete.php?no_modelo_veiculo=" + phrase + "&format=json";
		},
		getValue: "no_modelo_veiculo",
		adjustWidth:false,
		list: {

			onSelectItemEvent: function() {
				var co_modelo_veiculo = $("#no_modelo_veiculo").getSelectedItemData().co_modelo_veiculo;

				$("#co_modelo_veiculo").val(co_modelo_veiculo).trigger("change");
			}
		}		
	};
$("#no_modelo_veiculo").easyAutocomplete(options);

var limpaCamposVeiculos = function() {
	$("#co_veiculo").val(null);
	$("#no_modelo_veiculo").val(null);
	$("#co_modelo_veiculo").val(null);
	$("#nu_vaga").val(null);
	$("#ds_placa").val(null);
	$("#ds_cor").val(null);
	$("#co_vaga").val(null);
	carregaGaragem();
	carregaVagasGaragem(3,null);
};

$( "#btn-reset-veiculo" ).click(function() {
	limpaCamposVeiculos();
	gridVeiculos();
	$('#linkAbas a[href="#ficha"]').tab('show');
});
var gravaVeiculo = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/veiculos/gravar.php",
	  data: { co_unidade:  $('#co_unidade').val(),
		  	  co_veiculo: $('#co_veiculo').val(),
		  	  co_tipo_veiculo: $('#co_tipo_veiculo').val(),
		  	  co_vaga: $('#co_vaga').val(),
		  	  co_modelo_veiculo: $('#co_modelo_veiculo').val(),
		  	  no_modelo_veiculo: $('#no_modelo_veiculo').val(),
		  	  ds_placa: $('#ds_placa').val(),
		  	  ds_cor: $('#ds_cor').val(),
		  	  co_pessoa_registro: $('#co_pessoa_registro').val()
		    }
	}).done(function( data ){
		if( data.tipo=="erro" ){
			mostrarAlertas(data.tipo,data.msg);
		}else{
			mostrarAlertas(data.tipo,data.msg);
			limpaCamposVeiculos();
			gridVeiculos();
			$('#linkAbas a[href="#ficha"]').tab('show');			
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

var carregaVeiculo = function(co_veiculo) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/veiculos/listarVeiculo.php",
		  data: { co_veiculo: co_veiculo }
		}).done(function( data ){
			$("#co_veiculo").val( data[0].co_veiculo );
			$("#no_modelo_veiculo").val( data[0].no_modelo_veiculo );
			$("#co_modelo_veiculo").val( data[0].co_modelo_veiculo );
			$("#ds_placa").val( data[0].ds_placa );
			$("#ds_cor").val( data[0].ds_cor);
			carregaTipoVeiculo(data[0].co_tipo_veiculo);
			$("#co_tipo_unidade" + data[0].co_tipo_unidade).attr('selected','selected');
			carregaVagasGaragem(data[0].co_tipo_unidade,data[0].co_vaga);
			$('#linkAbas a[href="#veiculos"]').tab('show');
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};

var carregaGaragem = function() {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/tipos-de-unidade/carregarListaTiposUnidades.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_tipo_unidade + '" id="co_tipo_unidade'+val.co_tipo_unidade+'">' + val.no_tipo_unidade + '</option>';
		});
		$("#co_tipo_unidade").html(options);
		carregaVagasGaragem(data[0].co_tipo_unidade,null);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaGaragem();

$( "#co_tipo_unidade" ).change(function() {
	carregaVagasGaragem($( "#co_tipo_unidade" ).val());
});
var carregaVagasGaragem = function(co_tipo_unidade, selecionado) {
	var options;
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/unidades/carregarListaVagasGaragem.php",
	  data: { co_tipo_unidade: co_tipo_unidade }
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_unidade + '" '+(val.co_unidade==selecionado ? 'selected' : '')+'>' + val.nu_numero + '</option>';
		});
		$("#co_vaga").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};
</script>