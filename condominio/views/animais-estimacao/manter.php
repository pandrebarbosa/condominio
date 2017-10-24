<form role="form" name="frm-animais" id="frm-animais">
	<div class="row">
		<div class="col-md-3">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="thumbnail" id="container_image_animal">
					</div>
					<input type="hidden" id="ds_foto_animal">
				</div>
			</div>
		</div>

		<div class="col-md-9">
			<div class="row">
				<div class="col-md-3">
					<label for="exampleInputEmail1">Tipo de animal doméstico</label>
					<select id="co_tipo_animal" class="form-control"></select>
				</div>
				<div class="col-md-9">
					<label for="exampleInputEmail1">Nome</label>
					<input type="text" class="form-control" id="ds_nome" name="ds_nome" placeholder="Nome do animal" required>
				</div>				
			</div><!-- Fecha div row -->
			<p></p>
			<div class="row">
				<div class="col-md-3">
					<label for="exampleInputEmail1">Cor</label>
					<input type="text" class="form-control" id="ds_cor_animal" name="ds_cor_animal" placeholder="Cor do animal" required>
				</div>				
				<div class="col-md-9">
					<label class="tooltipster" for="teste" title="Começe digitando o texto. Caso o termo já exista, clique nele. Caso contrário, complete o cadastro.">Raça <span class="glyphicon glyphicon-info-sign" aria-hidden="true" ></span></label>
					<input type="text" class="form-control" id="no_raca" name="no_raca" placeholder="Raça do animal" required>
					<input type="hidden" class="form-control" id="co_raca" name="co_raca">
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar-animal">Gravar</button>
		<button type="reset" class="btn btn-default" id="btn-reset-animal">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_animal_domestico">	
</form>
<script>
$( "#no_raca" ).click(function() {
	$( "#no_raca" ).val(null);
	$( "#co_raca" ).val(null);
});

var carregaTipoAnimal = function(selecionado) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/tipos-de-animais/listarTiposDeAnimaisJSON.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_tipo_animal + '" '+(val.co_tipo_animal==selecionado ? 'selected' : '')+'>' + val.no_tipo_animal + '</option>';
		});
		$("#co_tipo_animal").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaTipoAnimal(null);

var limpaCamposAnimais = function() {
	$('#co_animal_domestico').val(null);
	$('#ds_cor_animal').val(null);
	$('#no_raca').val(null);
	$('#co_raca').val(null);
	$('#ds_nome').val(null);
	$('#ds_foto_animal').val(null);
	$('.picture-element-image').attr("src",'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
};

var ValidaCampoAnimais = function() {
    if ($("#co_unidade").val() == ""){
    	mostrarAlertas("erro","Unidade não identificada!");
        return false;
    }
    if ($("#co_tipo_animal").val() == ""){
    	mostrarAlertas("erro","Tipo do animal de estimação não identificado!");
        $("#co_tipo_animal").focus();
        return false;
    }
    if ($("#ds_nome").val() == ""){
    	mostrarAlertas("erro","Nome do animal de estimação não preenchido!");
        $("#ds_nome").focus();
        return false;
    }
    if ($("#ds_cor_animal").val() == ""){
    	mostrarAlertas("erro","Cor do animal de estimação não preenchida!");
        $("#ds_cor_animal").focus();
        return false;
    }
    if ($("#no_raca").val() == ""){
    	mostrarAlertas("erro","Raça do animal de estimação não preenchido!");
        $("#no_raca").focus();
        return false;
    }
        
    return true;
};

$( "#btn-salvar-animal" ).click(function() {
	if(ValidaCampoAnimais()){
		gravaAnimal();
	}
});

var options = {
		url: function(phrase) {
			return "services/raca/listarRacaAutoComplete.php?no_raca=" + phrase + "&format=json";
		},
		getValue: "no_raca",
		adjustWidth:false,
		list: {

			onSelectItemEvent: function() {
				var co_raca = $("#no_raca").getSelectedItemData().co_raca;

				$("#co_raca").val(co_raca).trigger("change");
			}
		}		
	};
$("#no_raca").easyAutocomplete(options);

var carregaAnimal = function(co_animal_domestico) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/animais-estimacao/listarAnimal.php",
		  data: { co_animal_domestico: co_animal_domestico }
		}).done(function( data ){
			$("#co_animal_domestico").val( data[0].co_animal_domestico );
			$("#no_raca").val( data[0].no_raca );
			$("#co_raca").val( data[0].co_raca );
			$("#ds_nome").val( data[0].ds_nome );
			if( data[0].ds_foto!='' ){
				$('.picture-element-image').attr("src",'<?php echo $_SESSION['credencial']['ambiente']=="DEV" ? "/condominiosanraphael" : "" ?>/arquivos/imagens/animais/'+data[0].ds_foto);
			}
			$('#ds_foto_animal').val( data[0].ds_foto );			
			$("#ds_cor_animal").val( data[0].ds_cor);
			$("#co_tipo_animal" + data[0].co_tipo_animal).attr('selected','selected');
			$('#linkAbas a[href="#animais-estimacao"]').tab('show');
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};
$( "#btn-reset-animal" ).click(function() {
	limpaCamposAnimais();
	gridAnimais();
	$('#linkAbas a[href="#ficha"]').tab('show');
});
var gravaAnimal = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/animais-estimacao/gravar.php",
	  data: { co_unidade:  $('#co_unidade').val(),
		  	  co_animal_domestico:  $('#co_animal_domestico').val(),
		  	  co_tipo_animal: $('#co_tipo_animal').val(),
		  	  ds_cor: $('#ds_cor_animal').val(),
		  	  no_raca: $('#no_raca').val(),
		  	  ds_foto:  $('#ds_foto_animal').val(),
		  	  co_raca: $('#co_raca').val(),
		  	  ds_nome: $('#ds_nome').val(),
		  	  co_pessoa_registro: $('#co_pessoa_registro').val()
		    } 
	}).done(function( data ){
		if( data.tipo=="erro" ){
			mostrarAlertas(data.tipo,data.msg);
		}else{
			mostrarAlertas(data.tipo,data.msg);
			limpaCamposAnimais();
			gridAnimais();
			$('#linkAbas a[href="#ficha"]').tab('show');
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

$("#container_image_animal").PictureCut({
    InputOfImageDirectory       : "image",
    PluginFolderOnServer        : "<?php echo $_SESSION['credencial']['ambiente']=="DEV" ? "/condominiosanraphael" : "" ?>/condominio/bootstrap-3.3.6-dist/jQuery-Picture-Cut-master/",
    FolderOnServer              : "<?php echo $_SESSION['credencial']['ambiente']=="DEV" ? "/condominiosanraphael" : "" ?>/arquivos/imagens/animais/",
    EnableCrop                  : true,
    CropOrientation             : true,
    EnableButton                : true,
    CropModes                   : { widescreen: true, letterbox: true, free: false },
    CropWindowStyle             : "Bootstrap",
    ImageButtonCSS              : { border:"1px #CCC solid",
							        width :214,
							        height:286
							      },
    UploadedCallback            : function(data){                    
    	$("#ds_foto_animal").val(data.currentFileName); //data.options.FolderOnServer+data.currentFileName
    }
});
</script>