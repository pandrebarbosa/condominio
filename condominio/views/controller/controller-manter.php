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
	  <li><a href="?ido=<?php echo base64_encode("controller-listar")?>">Listagem</a></li>
	  <li class="active">Controller</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-unidades" id="frm-unidades">
	<div class="row">
		<div class="col-md-4">
			<label for="exampleInputEmail1">Nome</label>
			<input type="text" class="form-control" id="no_controller" placeholder="Nome" required>
		</div>
		<div class="col-md-4">
			<label for="exampleInputEmail1">Descrição</label>
			<input type="text" class="form-control" id="ds_controller" placeholder="Descrição" required>
		</div>
		<div class="col-md-4">
			<label for="exampleInputEmail1">Caminho do template</label>
			<input type="text" class="form-control" id="ds_caminho" value="views/" required>
		</div>		
	</div>
	<!-- Fim div row -->
	<p></p><p></p>
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_controller" value="<?php echo isset($_GET['co_controller']) ? $_GET['co_controller'] : ''?>">	
	</form>


  </div>
</div>

<script>
var ValidaCampoController = function() {
    if ($("#no_controller").val() == ""){
    	mostrarAlertas("erro","Nome não preenchido!");
    	$("#no_controller").focus();
        return false;
    }
    if ($("#ds_controller").val() == ""){
    	mostrarAlertas("erro","Descrição não preechida!");
        $("#ds_controller").focus();
        return false;
    }
    if ($("#ds_caminho").val() == ""){
    	mostrarAlertas("erro","Caminho não preenchido!");
        $("#ds_caminho").focus();
        return false;
    }
            
    return true;
};

$( "#btn-salvar" ).click(function() {
	if(ValidaCampoController()){
		gravaController();
	}
});

var carregaController = function(co_controller) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/controller/listarController.php",
		  data: { co_controller: co_controller }
		}).done(function( data ){
			$("#co_controller").val( data[0].co_controller );
			$("#no_controller").val( data[0].no_controller );
			$("#ds_controller").val( data[0].ds_controller );
			$("#ds_caminho").val( data[0].ds_caminho );
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};
if( $("#co_controller").val()!='' ){
	carregaController( $("#co_controller").val() )
}

var gravaController = function(co_controller) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/controller/gravar.php",
	  data: { co_controller: $("#co_controller").val(),
			  no_controller: $("#no_controller").val(),
			  ds_controller: $("#ds_controller").val(),
			  ds_caminho: $("#ds_caminho").val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var limpaCampos = function() {
	$("#no_controller").val( null );
	$("#ds_controller").val( null );
	$("#ds_caminho").val( null );
	$("#co_controller").val( null );
};
</script>