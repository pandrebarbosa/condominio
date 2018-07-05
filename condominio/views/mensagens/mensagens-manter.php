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
	  <li><a href="?ido=<?php echo base64_encode("mensagens-listar")?>">Mensagens</a></li>
	  <li class="active">Cadastro</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-usuarios" id="frm-usuarios">

	<div class="row">
		<div class="col-md-2">
		<div class="checkbox">
			<label>
			<br />
				<input type="checkbox" id="enviar-agora" checked="checked"> Enviar agora!
			</label>
		</div>		
		</div>
		<div class="col-md-4" id="combo-destinatario">
		<label>Destinatário:</label>
		<select id="co_grupo" class="form-control"></select>
		</div>
		<div class="col-md-6"></div>
	</div>
	
	<div class="row">
		<div class="col-md-8 torre-unidade">
			<label for="exampleInputEmail1">Título:</label>
			<input type="text" class="form-control" id="ds_titulo" required>
		</div>							
		<div class="col-md-4">
			<label for="exampleInputEmail1">Ativo:</label><p></p>
			<label class="radio-inline">
			  <input type="radio" name="st_ativo" id="st_ativo1" value="1" checked="checked"> Sim
			</label>
			<label class="radio-inline">
			  <input type="radio" name="st_ativo" id="st_ativo0" value="0"> Não
			</label>				
		</div>
	</div>
	<!-- Fecha div row -->
	<p></p>
	<div class="row">
		<div class="col-md-12">
		<label for="exampleInputEmail1">Conteúdo</label>
		<textarea class="form-control" rows="10" id="ds_conteudo"></textarea>				
		</div>
	</div><!-- Fecha div row -->
	
	<!-- Fim div row -->
	<br />
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_mensagem" value="<?php echo isset($_GET['co_mensagem']) ? $_GET['co_mensagem'] : ''?>">
	<input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>">
	</form>

  </div>
</div>

<script>
$('#ds_conteudo').wysihtml5();

$( "#enviar-agora" ).click(function() {
	if( $('#enviar-agora').prop('checked') === true ){
		$('#combo-destinatario').show('slow');
		carregaGrupos(null);
	}else{
		$('#combo-destinatario').hide('slow');
	}
});

var carregaGrupos = function(selecionado) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/grupos-mensagem/listarGrupo.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_grupo + '" '+(val.co_grupo==selecionado ? 'selected' : '')+'>' + val.no_grupo + '</option>';
		});
		$("#co_grupo").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaGrupos(null);

var ValidarCampos = function() {
    if ($("#ds_titulo").val() == ""){
    	mostrarAlertas("erro","Título não preenchido!");
        $("#ds_titulo").focus();
        return false;
    }
    if ($("#ds_conteudo").val() == ""){
    	mostrarAlertas("erro","Conteúdo não preenchido!");
        $("#ds_conteudo").focus();
        return false;
    }
        
    return true;
};

var gravarMensagem = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/mensagens/gravar.php",
	  data: { ds_titulo:    $('#ds_titulo').val(),
		  	  ds_conteudo:  $('#ds_conteudo').val(),
		  	  co_grupo:     $('#co_grupo').val(),
		  	  co_mensagem:  $('#co_mensagem').val(),
		  	  ds_imagem:    'user.jpg',
		  	  enviar_agora: $('#enviar-agora').prop('checked'),
		  	  co_pessoa_registro:  $('#co_pessoa_registro').val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
		carregarMensagem(data.id);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var carregarMensagem = function(co_mensagem) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/mensagens/carregarMensagem.php",
	  data: { co_mensagem: co_mensagem }
	}).done(function( data ){
		$('#co_mensagem').val(data[0].co_mensagem);
		$('#ds_titulo').val(data[0].ds_titulo);
		//$('#ds_conteudo').wysihtml5();
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
};carregaMensagem();


$( "#btn-salvar" ).click(function() {
	if(ValidarCampos()){
		gravarMensagem();
	}
});

var limpaCampos = function() {
	$("#co_mensagem").val(null);
	$("#ds_titulo").val(null);
};

</script>