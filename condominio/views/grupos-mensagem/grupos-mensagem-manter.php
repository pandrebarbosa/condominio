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
	  <li><a href="?ido=grupos-mensagem-listar">Listagem de Grupos</a></li>
	  <li class="active">Manutenção de Grupo</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-unidades" id="frm-unidades">
	<div class="row">
		<div class="col-md-4">
			<label for="exampleInputEmail1">Nome</label>
			<input type="text" class="form-control" id="no_grupo" placeholder="Nome do Grupo" required>
		</div>
		<div class="col-md-4">
			<label for="exampleInputEmail1">Descrição</label>
			<input type="text" class="form-control" id="ds_descricao" placeholder="Descrição" required>
		</div>	
		<div class="col-md-4">
			<label for="exampleInputEmail1">Método (PHP)</label>
			<input type="text" class="form-control" id="no_metodo" placeholder="Método PHP" required>		
		</div>	
	</div>
	<!-- Fim div row -->
	<p></p><p></p>
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_grupo" value="<?php echo isset($_GET['co_grupo']) ? $_GET['co_grupo'] : ''?>" >
	</form>


  </div>
</div>

<script>
var ValidaCampos = function() {
    if ($("#no_grupo").val() == ""){
    	mostrarAlertas("erro","Nome não preenchido!");
    	$("#no_grupo").focus();
        return false;
    }
    if ($("#ds_descricao").val() == ""){
    	mostrarAlertas("erro","Descrição não preechida!");
        $("#ds_descricao").focus();
        return false;
    }
    if ($("#no_metodo").val() == ""){
    	mostrarAlertas("erro","Método não preechido!");
        $("#no_metodo").focus();
        return false;
    }
            
    return true;
};

$( "#btn-salvar" ).click(function() {
	if(ValidaCampos()){
		gravaGrupo();
	}
});

var carregaGrupo = function(co_grupo) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/grupos-mensagem/listarGrupo.php",
		  data: { co_grupo: co_grupo }
		}).done(function( data ){
			$("#co_grupo").val( data[0].co_grupo );
			$("#no_grupo").val( data[0].no_grupo );
			$("#ds_descricao").val( data[0].ds_descricao );
			$("#no_metodo").val( data[0].no_metodo );
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};
if( $("#co_grupo").val()!='' ){
	carregaGrupo( $("#co_grupo").val() )
}

var gravaGrupo = function(co_tipo_unidade) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/grupos-mensagem/grupos-gravar.php",
	  data: { co_grupo:     $("#co_grupo").val(),
		  	  no_grupo:     $("#no_grupo").val(),
		  	  ds_descricao: $("#ds_descricao").val(),
		  	  no_metodo:    $("#no_metodo").val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var limpaCampos = function() {
	$("#co_grupo").val(null);
	$("#no_grupo").val(null);
	$("#ds_descricao").val(null);
	$("#no_metodo").val(null);
};
</script>