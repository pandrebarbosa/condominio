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
	  <li><a href="?ido=usuarios-listar">Usuários</a></li>
	  <li class="active">Cadastro</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-usuarios" id="frm-usuarios">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<label for="exampleInputEmail1">Tipo de usuário:</label>
					<select id="co_tipo_usuario" class="form-control"></select>
				</div>
				<div class="col-md-2 torre-unidade">
				  <label>Escolha a torre:</label><br />
					<select id="co_torre" class="form-control"></select>
				</div>
				<div class="col-md-2 torre-unidade">
				  <label>Escolha a unidade:</label><br />
					<select id="co_unidade" class="form-control">
					<option>Selecione a torre</option>
					</select>
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
			</div><!-- Fecha div row -->
			
			<p></p>
			<div class="row">
				<div class="col-md-6">
					<label class="tooltipster" title="Caso não liste nenhum nome, cadastre primeiro como morador ou funcionário.">Nome: <span class="glyphicon glyphicon-question-sign" aria-hidden="true" ></span></label>
					<select id="co_pessoa" class="form-control">
					<option>Selecione...</option>
					</select>	
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-3"></div>
			</div><!-- Fecha div row -->
	
			<p></p>
			<div class="row">
				<div class="col-md-6">
					<label for="exampleInputEmail1">Email:</label>
					<input type="email" class="form-control" id="ds_email" placeholder="Email" required>
				</div>			
				<div class="col-md-3">
					<label class="tooltipster" title="Use o email como login. Antes do @">Login: <span class="glyphicon glyphicon-question-sign" aria-hidden="true" ></span></label>
					<input type="text" class="form-control" id="ds_login" maxlength="15" placeholder="Login" required>					
				</div><!-- Fecha div col-md-3 -->
				<div class="col-md-3 torre-unidade" id="notificacao-moradores">
					<label for="exampleInputEmail1">Receber notificações?</label><p></p>
					<label class="radio-inline">
					  <input type="radio" name="st_autorizado" id="st_autorizado1" value="1" checked="checked"> Sim
					</label>
					<label class="radio-inline">
					  <input type="radio" name="st_autorizado" id="st_autorizado0" value="0"> Não
					</label>				
				</div>
				<div class="col-md-6"></div>
			</div><!-- Fecha div row -->
	
		</div><!-- Fecha div col-md-12 -->
	
	</div><!-- Fim div row -->
	
	<br />
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>">
	</form>

  </div>
</div>

<script>
var ValidarCampos = function() {
    if ($("#co_pessoa").val() <=0 ){
    	mostrarAlertas("erro","Escolha um usuário!");
        $("#no_pessoa").focus();
        return false;
    }
    if ($("#ds_email").val() == ""){
    	mostrarAlertas("erro","Email não preenchido!");
        $("#ds_email").focus();
        return false;
    }
    if ($("#ds_login").val() == ""){
    	mostrarAlertas("erro","Login não preenchido!");
        $("#ds_login").focus();
        return false;
    }
        
    return true;
};


var carregaTiposUsuarios = function(co_tipo_usuario) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/tipos-usuarios/carregarListaTiposUsuarios.php"
	}).done(function( data ){
		options = '<option>Selecione</option>';
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_tipo_usuario + '" '+(co_tipo_usuario==val.co_tipo_usuario ? "selected" : '')+'>' + val.no_tipo_usuario + '</option>';
		});
		$("#co_tipo_usuario").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaTiposUsuarios(null);


var carregaTorres = function(co_torre) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/torres/carregarListaTorres.php"
	}).done(function( data ){
		options = '<option>Selecione...</option>';
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_torre + '" '+(co_torre==val.co_torre ? "selected" : '')+'>Torre ' + val.no_torre + '</option>';
		});
		$("#co_torre").append(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaTorres(null);


var carregaUnidadeTorres = function(co_torre, co_unidade) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/unidades/listarUnidadesPorTorre.php",
	  data: { co_torre: co_torre }
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_unidade + '" '+(co_unidade == val.co_unidade ? "selected" : '')+'>' + val.nu_numero + ' (' + val.no_tipo_unidade + ')</option>';
		});
		$("#co_unidade").append(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};


var carregaComboUsuarios = function(co_unidade, co_pessoa) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/moradores/listarMoradoresUsuariosPorUnidade.php",
	  data: { co_unidade: co_unidade }
	}).done(function( data ){
		$("#co_pessoa").html(null);
		$("#co_pessoa").append("<option>Selecione...</option>");
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_pessoa + '" '+(co_pessoa == val.co_pessoa ? "selected" : '')+'>' + val.no_pessoa + '</option>';
		});
		$("#co_pessoa").append(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var carregaComboFuncionarios = function(co_pessoa) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/funcionarios/listarFuncionario.php"
	}).done(function( data ){
		$("#co_pessoa").html(null);
		$("#co_pessoa").append("<option>Selecione...</option>");
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_pessoa + '" '+(co_pessoa == val.co_pessoa ? "selected" : '')+'>' + val.no_pessoa + '</option>';
		});
		$("#co_pessoa").append(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var abrirDivMorador = function( co_tipo_usuario, co_funcionario ) {
	if( co_tipo_usuario >= 3 ){
		$(".torre-unidade").show('slow');
	}else{
		$(".torre-unidade").hide('slow');
		carregaComboFuncionarios(co_funcionario);
	}
};

$( "#co_tipo_usuario" ).change(function() {
	$("#co_pessoa").html(null);
	$("#co_pessoa").append("<option>Selecione...</option>");
	abrirDivMorador( $( "#co_tipo_usuario" ).val(), null );
});

$( "#co_torre" ).change(function() {
	carregaUnidadeTorres( $( "#co_torre" ).val() );
});

$( "#co_unidade" ).change(function() {
	carregaComboUsuarios( $( "#co_unidade" ).val(), null );
});

var carregaAutorizacaoNotificacao = function(co_pessoa, co_unidade) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,
	  url: "services/usuarios/verificarRecebimentoNotificacoes.php",
	  data: { co_pessoa: co_pessoa, co_unidade: co_unidade }
	}).done(function( data ){
		$("#st_autorizado" + data).attr('checked','checked');		
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var carregaUsuario = function(co_pessoa) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/usuarios/listarUsuario.php",
	  data: { co_pessoa: co_pessoa }
	}).done(function( data ){
		$("#co_pessoa").val( data[0].co_pessoa );
		$("#ds_login").val( data[0].ds_login);
		$("#ds_email").val( data[0].ds_email);
		carregaTorres(data[0].co_torre);
		carregaUnidadeTorres(data[0].co_torre, data[0].co_unidade);
		carregaTiposUsuarios(data[0].co_tipo_usuario);
		//Se for Sindico, Conselho, Morador ou SYS-ADM
		if(data[0].co_tipo_usuario >= 3){
			carregaComboUsuarios(data[0].co_unidade, data[0].co_pessoa);
			$("#notificacao-moradores").removeClass('hide');
			carregaAutorizacaoNotificacao(data[0].co_pessoa,data[0].co_unidade);
		}else{
			carregaComboFuncionarios(data[0].co_pessoa);
		}
		$("#st_ativo" + data[0].st_ativo).attr('checked','checked');
		abrirDivMorador(data[0].co_tipo_usuario, data[0].co_pessoa);
		$("#co_pessoa").attr("readonly",true);
		$("#co_torre").attr("disabled",true);
		$("#co_unidade").attr("disabled",true);
				
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};


var gravarUsuario = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/usuarios/gravar.php",
	  data: { co_pessoa:  $('#co_pessoa').val(),
		  	  ds_email:   $('#ds_email').val(),
		  	  co_tipo_usuario: $('#co_tipo_usuario').val(),
		  	  ds_login:   $('#ds_login').val(),
		  	  ds_senha:   $('#ds_senha').val(),
		  	  co_unidade: $('#co_unidade').val(),
		  	  st_ativo:   $( "input:radio[name=st_ativo]:checked" ).val(),
		  	  st_autorizado:   $( "input:radio[name=st_autorizado]:checked" ).val(),
		  	  co_pessoa_registro: $('#co_pessoa_registro').val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
		carregaUsuario(data.id);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var limpaCampos = function() {
	$("#co_pessoa").val(null);
	$("#ds_email").val(null);
	$("#ds_login").val(null);
	$("#co_unidade").val(null);
	$("#co_torre").val(null);
};


$( "#btn-salvar" ).click(function() {
	if(ValidarCampos()){
		gravarUsuario();
	}
});

if( myParam.co_pessoa > 0 ){
	carregaUsuario( myParam.co_pessoa );
}
</script>