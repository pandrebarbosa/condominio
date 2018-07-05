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
	  <li><a href="?ido=<?php echo base64_encode("inicio")?>">Início</a></li>
	  <li><a href="?ido=<?php echo base64_encode("unidades-listar")?>">Unidades</a></li>
	  <li class="active">Cadastro</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-unidades" id="frm-unidades">
	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-4">
					<label for="exampleInputEmail1">Tipo de unidade</label>
					<select id="co_tipo_unidade" name="co_tipo_unidade" class="form-control">
					<?php
					$res_tacesso = $banco->seleciona ( "tb_tipo_unidade", "*", "", "", "no_tipo_unidade ASC", "", FALSE );
					if (is_array ( $res_tacesso )) {
						foreach ( $res_tacesso as $acesso ) {?>
					  <option value="<?php echo $acesso['co_tipo_unidade'] ?>" id="co_tipo_unidade<?php echo $acesso['co_tipo_unidade'] ?>"><?php echo $acesso['no_tipo_unidade'] ?></option>
					<?php } } ?>
					</select>
				</div>
				<div class="col-md-2" id="div-torre-unidade">
					<label for="exampleInputEmail1">Torre</label> <input
						type="number" min="1" max="4" class="form-control" id="co_torre" name="co_torre"
						placeholder="Torre" required>
				</div>
				<div class="col-md-3">
					<label for="exampleInputEmail1">Número</label> <input
						type="number" class="form-control" id="nu_numero" name="nu_numero"
						placeholder="Numero" required>
				</div>					
				<div class="col-md-3">
					<label for="exampleInputEmail1">Metragem</label> <input
						type="text" class="form-control" id="nu_metragem" name="nu_metragem"
						placeholder="Metragem" required>
				</div>								
			</div>
		</div>
		<!-- Fecha div col-md-12 -->
	</div>
	<!-- Fim div row -->
	<p></p><p></p>
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_unidade" value="<?php echo isset($_GET['co_unidade']) ? $_GET['co_unidade'] : ''?>">	
	</form>


  </div>
</div>

<script>
var ValidaCampoUnidade = function() {
    if ($("#co_tipo_unidade").val() == ""){
    	mostrarAlertas("erro","Tipo da unidade não identificada!");
    	$("#co_tipo_unidade").focus();
        return false;
    }
    if ($("#co_torre").val() == ""){
    	mostrarAlertas("erro","Torre não identificada!");
        $("#co_torre").focus();
        return false;
    }
    if ($("#nu_numero").val() == ""){
    	mostrarAlertas("erro","Número da unidade não identificada!");
        $("#nu_numero").focus();
        return false;
    }
            
    return true;
};

$( "#btn-salvar" ).click(function() {
	if(ValidaCampoUnidade()){
		gravaUnidade();
	}
});

var carregaUnidade = function(co_unidade) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/unidades/listarUnidade.php",
		  data: { co_unidade: co_unidade }
		}).done(function( data ){
			$("#co_unidade").val( data[0].co_unidade );
			$("#co_torre").val( data[0].co_torre );
			$("#nu_numero").val( data[0].nu_numero );
			$("#nu_metragem").val( data[0].nu_metragem );
			$("#co_tipo_unidade" + data[0].co_tipo_unidade).attr('selected','selected');
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};
if( $("#co_unidade").val()!='' ){
	carregaUnidade( $("#co_unidade").val() )
}

var gravaUnidade = function(co_unidade) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/unidades/gravar.php",
	  data: { co_unidade: $("#co_unidade").val(),
			  co_torre: $("#co_torre").val(),
			  nu_numero: $("#nu_numero").val(),
			  nu_metragem: $("#nu_metragem").val(),
			  co_tipo_unidade: $("#co_tipo_unidade").val(),
			  co_pessoa_registro: $('#co_pessoa_registro').val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var limpaCampos = function() {
	$("#co_torre").val( null );
	$("#nu_numero").val( null );
	$("#nu_metragem").val( null );
	$("#co_unidade").val( null );
};
</script>