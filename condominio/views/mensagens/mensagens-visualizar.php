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
	  <li><a href="?ido=mensagens-listar">Mensagens</a></li>
	  <li class="active">Leitura</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-usuarios" id="frm-usuarios">
		
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8 torre-unidade">
					<label for="exampleInputEmail1">Título:</label><br />
					<span id="ds_titulo"></span>
				</div>							
				<div class="col-md-4"></div>
			</div>
			<!-- Fecha div row -->
			<p></p>
			<div class="row">
				<div class="col-md-12">
				<label for="exampleInputEmail1">Conteúdo</label><br />
				<span id="ds_conteudo"></span>		
				</div>
			</div><!-- Fecha div row -->
	
		</div><!-- Fecha div col-md-12 -->
	
	</div><!-- Fim div row -->
	<br />
	<div class="panel-footer text-right">
		<button type="button" onclick="javascript: history.go(-1);" class="btn btn-default">Voltar</button>
	</div>	
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_mensagem" value="<?php echo isset($_GET['co_mensagem']) ? $_GET['co_mensagem'] : ''?>">
	<input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>">
	</form>

  </div>
</div>

<script>
var carregarMensagem = function(co_mensagem) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/mensagens/mostrarMensagemLeitura.php",
	  data: { co_mensagem: co_mensagem }
	}).done(function( data ){
		$('#ds_titulo').html(data[0].ds_titulo);
		$('#ds_conteudo').html(data[0].ds_conteudo);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};
var carregaMensagem = function() {
	if( $("#co_mensagem").val() > 0 ){
		carregarMensagem($("#co_mensagem").val());
	}
};
carregaMensagem();
</script>