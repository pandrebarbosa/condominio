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
	  <li><a href="?ido=tipos-de-unidade-listar">Listagem</a></li>
	  <li class="active">Tipos de unidade</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-unidades" id="frm-unidades">
	<div class="row">
		<div class="col-md-4">
			<label for="exampleInputEmail1">Nome</label>
			<input type="text" class="form-control" id="no_tipo_unidade" placeholder="Nome" required>
		</div>
		<div class="col-md-4">
			<label for="exampleInputEmail1">Descrição</label>
			<input type="text" class="form-control" id="sg_sigla_unidade" placeholder="Sigla" required>
		</div>	
	</div>
	<!-- Fim div row -->
	<p></p><p></p>
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_tipo_unidade" value="<?php echo isset($_GET['co_tipo_unidade']) ? $_GET['co_tipo_unidade'] : ''?>">
	<input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>" >
	</form>


  </div>
</div>

<script>
var ValidaCampoTipoUnidade = function() {
    if ($("#no_tipo_unidade").val() == ""){
    	mostrarAlertas("erro","Nome não preenchido!");
    	$("#no_tipo_unidade").focus();
        return false;
    }
    if ($("#sg_sigla_unidade").val() == ""){
    	mostrarAlertas("erro","Sigla não preechida!");
        $("#sg_sigla_unidade").focus();
        return false;
    }
            
    return true;
};

$( "#btn-salvar" ).click(function() {
	if(ValidaCampoTipoUnidade()){
		gravaTipoUnidade();
	}
});

var carregaTipoUnidade = function(co_tipo_unidade) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/tipos-de-unidade/listarTipoUnidade.php",
		  data: { co_tipo_unidade: co_tipo_unidade }
		}).done(function( data ){
			$("#co_tipo_unidade").val( data[0].co_tipo_unidade );
			$("#no_tipo_unidade").val( data[0].no_tipo_unidade );
			$("#sg_sigla_unidade").val( data[0].sg_sigla_unidade );
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};
if( $("#co_tipo_unidade").val()!='' ){
	carregaTipoUnidade( $("#co_tipo_unidade").val() )
}

var gravaTipoUnidade = function(co_tipo_unidade) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/tipos-de-unidade/gravar.php",
	  data: { co_tipo_unidade: $("#co_tipo_unidade").val(),
			  no_tipo_unidade: $("#no_tipo_unidade").val(),
			  sg_sigla_unidade: $("#sg_sigla_unidade").val(),
			  co_pessoa_registro: $("#co_pessoa_registro").val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var limpaCampos = function() {
	$("#no_tipo_unidade").val( null );
	$("#sg_sigla_unidade").val( null );
	$("#co_tipo_unidade").val( null );
};
</script>