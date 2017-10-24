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
	  <li><a href="?ido=tipos-de-moradores-listar">Listagem</a></li>
	  <li class="active">Tipos de moradores</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-unidades" id="frm-unidades">
	<div class="row">
		<div class="col-md-4">
			<label for="exampleInputEmail1">Nome</label>
			<input type="text" class="form-control" id="no_tipo_morador" placeholder="Nome" required>
		</div>
	</div>
	<!-- Fim div row -->
	<p></p><p></p>
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_tipo_morador" value="<?php echo isset($_GET['co_tipo_morador']) ? $_GET['co_tipo_morador'] : ''?>">
	<input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>" >
	</form>


  </div>
</div>

<script>
var ValidaCampoTipoMorador = function() {
    if ($("#no_tipo_morador").val() == ""){
    	mostrarAlertas("erro","Nome não preenchido!");
    	$("#no_tipo_morador").focus();
        return false;
    }
            
    return true;
};

$( "#btn-salvar" ).click(function() {
	if(ValidaCampoTipoMorador()){
		gravaTipoMorador();
	}
});

var carregaTipoMorador = function(co_tipo_morador) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/tipos-de-moradores/listarTipoMorador.php",
		  data: { co_tipo_morador: co_tipo_morador }
		}).done(function( data ){
			$("#co_tipo_morador").val( data[0].co_tipo_morador );
			$("#no_tipo_morador").val( data[0].no_tipo_morador );
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};
if( $("#co_tipo_morador").val()!='' ){
	carregaTipoMorador( $("#co_tipo_morador").val() )
}

var gravaTipoMorador = function(co_tipo_morador) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/tipos-de-moradores/gravar.php",
	  data: { co_tipo_morador: $("#co_tipo_morador").val(),
			  no_tipo_morador: $("#no_tipo_morador").val(),
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
	$("#no_tipo_morador").val( null );
	$("#co_tipo_morador").val( null );
};
</script>