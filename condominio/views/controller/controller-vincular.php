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
	  <li class="active">Vincular</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="form" id="frm-unidades">
	<div class="row">
		<div class="col-md-4">
			<label for="exampleInputEmail1">Perfil do usuário</label>
			<select id=co_tipo_usuario class="form-control"></select>
		</div>
		<div class="col-md-8"></div>
	</div>
	<br />
	<div class="row">
		<div class="col-md-5">
			<label for="exampleInputEmail1">Controllers disponíveis</label>
			<select name="List1" id="List1" size="10" multiple="multiple" class="form-control"></select>
		</div>
		<div class="col-md-1">
		<br />
			<input type="button" class="btn btn-primary" name="insere" value=">>" OnClick="TrocaList(document.form.List1,document.form.List2)"><br /><br />
			<input type="button" class="btn btn-primary" name="deleta" value="<<" OnClick="TrocaList(document.form.List2,document.form.List1)">
		</div>
		<div class="col-md-6">
			<label for="exampleInputEmail1">Controllers selecionadas</label>
			<select name="List2" id="List2" size="10" multiple="multiple" class="form-control"></select>
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
var carregaTiposDeUsuarios = function() {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/tipos-usuarios/carregarListaTiposUsuarios.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_tipo_usuario + '" id="co_tipo_usuario'+val.co_tipo_usuario+'">' + val.no_tipo_usuario + '</option>';
		});
		$("#co_tipo_usuario").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaTiposDeUsuarios();

var carregaControllersDisponiveis = function(co_tipo_usuario) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/controller/listarControllerDisponivelPorTipoUsuario.php",
	  data: {co_tipo_usuario:co_tipo_usuario}
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option ondblclick="TrocaList(document.form.List1,document.form.List2)" value="' + val.co_controller + '" >'+val.co_controller+' - ' + val.no_controller + '</option>';
		});
		$("#List1").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaControllersDisponiveis(1);

var carregaControllersDoTipoUsuario = function(co_tipo_usuario) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/controller/listarControllerPorTipoUsuario.php",
	  data: {co_tipo_usuario:co_tipo_usuario}
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option ondblclick="TrocaList(document.form.List2,document.form.List1)" value="' + val.co_controller + '" >'+val.co_controller+' - ' + val.no_controller + '</option>';
		});
		$("#List2").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaControllersDoTipoUsuario(1);

$( "#co_tipo_usuario" ).change(function() {
	carregaControllersDoTipoUsuario($( "#co_tipo_usuario" ).val());
	carregaControllersDisponiveis($( "#co_tipo_usuario" ).val());
});

var TrocaList = function(ListOrigem,ListDestino) {
	var i;
	for (i = 0; i < ListOrigem.options.length ; i++){
		if (ListOrigem.options[i].selected == true){
			var Op = document.createElement("OPTION");
			Op.text = ListOrigem.options[i].text;
			Op.value = ListOrigem.options[i].value;
			ListDestino.options.add(Op);
			ListOrigem.options.remove(i);
			i--;
		}
	}
}


$( "#btn-salvar" ).click(function() {
	gravaControllerAcesso();
});


var gravaControllerAcesso = function() {
	$('#List2 option').prop('selected', true);
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/controller/gravarControleAcesso.php",
	  data: { co_tipo_usuario: $("#co_tipo_usuario").val(),
		  	  co_controller: $('select[name=List2]').val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
		carregaControllersDoTipoUsuario(data.id);
		carregaControllersDisponiveis(data.id);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};
</script>