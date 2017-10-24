<p></p>
<!--Alertas-->
<div class="alert alert-dismissable" style="display: none;" id="alertas">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
	<strong>Atenção!</strong>
</div>
<!--/Alertas-->
<p></p>      
<div class="panel panel-default">
  <div class="panel-heading">
	<ol class="breadcrumb">
	  <li><a href="?ido=inicio">Início</a></li>
	  <li>Meu login</li>
	  <li class="active">Alterar</li>
	</ol>
  </div>
  <div class="panel-body">
	<div class="row">
    	<div class="col-md-12">
				<form role="form" name="frm-moradores" id="frm-moradores">
				<div class="row">
		
					<div class="col-md-9">
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<label for="exampleInputEmail1">Login:</label>
								<input type="text" class="form-control" id="ds_login" maxlength="10" readonly="readonly">
							</div>
						</div><!-- Fecha div row -->
		
						<p></p>
		
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<label for="exampleInputEmail1">Senha: </label>
									<input type="password" class="form-control" id="ds_senha" maxlength="25" required>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<label for="exampleInputEmail1">Confirmação da senha: </label>
									<input type="password" class="form-control" id="ds_confirmar_senha" maxlength="25" required>
							</div>
						</div><!-- Fecha div row -->
		
					</div><!-- Fecha div col-md-12 -->
		
				</div><!-- Fim div row -->
				<p></p>
		
				<div class="panel-footer text-right">
					<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
					<button type="reset" class="btn btn-default">Cancelar</button>
				</div>
				<!-- Fim div panel-footer -->
				<input type="hidden" id="co_pessoa" value="<?php echo isset($_SESSION['credencial']['co_pessoa']) ? $_SESSION['credencial']['co_pessoa'] : ''?>">	
			</form>
        </div><!-- Fim da col-md-12 -->
	        
	</div><!-- Fim da row -->

  </div>
</div>
<script>
var ValidaCampos = function() {	
    if ($("#ds_senha").val() == ""){
    	mostrarAlertas("erro","Digite uma senha!");
    	$("#ds_senha").focus();
        return false;
    }
    if ($("#ds_confirmar_senha").val() != $("#ds_senha").val()){
    	mostrarAlertas("erro","As senhas não estão iguais!");
    	$("#ds_confirmar_senha").focus();
        return false;
    }
        
    return true;
};

var carregaDadosLogin = function(co_pessoa) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/login/listarDados.php",
	  data: { co_pessoa: co_pessoa }
	}).done(function( data ){
		$("#co_pessoa").val( data[0].co_pessoa );
		$("#ds_login").val( data[0].ds_login );
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};
carregaDadosLogin( $( "#co_pessoa" ).val() );


$( "#btn-salvar" ).click(function() {
	if(ValidaCampos()){
		gravarLogin();
	}
});

var gravarLogin = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/login/gravar.php",
	  data: { co_pessoa: $('#co_pessoa').val(),
		  	  ds_login:  $('#ds_login').val(),
		  	  ds_senha: $('#ds_senha').val(),
		  	  co_pessoa_registro: $('#co_pessoa_registro').val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

</script>