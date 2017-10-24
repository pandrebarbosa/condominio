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
	  <li class="active">Cadastro de proprietários nas vagas de garagem</li>
	</ol>
  </div>
  <div class="panel-body">

	<form role="form" name="frm-usuarios" id="frm-usuarios">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-5">
				  <label>Proprietário:</label><br />
					<input type="text" id="no_pessoa" class="form-control" placeholder="Digite o nome do morador" >
					<input type="hidden" id="co_pessoa" value="<?php echo isset($_GET['co_pessoa']) ? $_GET['co_pessoa'] : ''?>" />
				</div>
				<div class="col-md-3">
				  <label>CPF:</label><br />
					<input type="text" id="nu_cpf" class="form-control mascara-cpf" />
				</div>	
				<div class="col-md-2">
				  <label>Escolha a garagem:</label><br />
					<select id="co_tipo_unidade" name="co_tipo_unidade" class="form-control"></select>
				</div>
				<div class="col-md-2">
				  <label>Escolha a vaga:</label><br />
					<select id="co_vaga" class="form-control"></select>
				</div>		
			</div>
			<!-- Fecha div row -->
	
		</div>
		<!-- Fecha div col-md-12 -->
	
	</div>
	<!-- Fim div row -->
	<br />
	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar">Gravar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	</form>

  </div>
</div>

<!-- Modal Excluir morador do apartamento -->
<div class="modal fade" id="modal-excluir-morador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body text-center">
				<h3>Deseja excluir o morador da unidade selecionada?</h3>
				
            </div>
            <div class="modal-footer">
                <button id="btn-excluir-morador" name="btn-excluir-morador" type="button"
                    class="btn btn-danger">Excluir</button>
                <button id="btn-cancelar" name="btn-cancelar"
                    class="btn btn-default" data-dismiss="modal"
                    aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal Excluir morador do apartamento -->


<script>
var options = {
		url: function(phrase) {
			return "services/pessoas/listarPessoasProprietariosAutoComplete.php?no_pessoa=" + phrase + "&format=json";
		},
		getValue: "no_pessoa",
		adjustWidth:false,
		list: {

			onSelectItemEvent: function() {
				var co_pessoa = $("#no_pessoa").getSelectedItemData().co_pessoa;
				var nu_cpf = $("#no_pessoa").getSelectedItemData().nu_cpf;

				$("#co_pessoa").val(co_pessoa).trigger("change");
				$("#nu_cpf").val(nu_cpf).trigger("change");
			}
		}		
	};
$("#no_pessoa").easyAutocomplete(options);
//no click do campo, zera tudo
$( "#no_pessoa" ).click(function() {
	$( "#no_pessoa" ).val(null);
	$( "#co_pessoa" ).val(null);
});

var carregaGaragem = function() {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/tipos-unidades/carregarListaTiposUnidades.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_tipo_unidade + '" id="co_tipo_unidade'+val.co_tipo_unidade+'">' + val.no_tipo_unidade + '</option>';
		});
		$("#co_tipo_unidade").html(options);
		carregaVagasGaragem(data[0].co_tipo_unidade,null);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaGaragem();

$( "#co_tipo_unidade" ).change(function() {
	carregaVagasGaragem($( "#co_tipo_unidade" ).val());
});
var carregaVagasGaragem = function(co_tipo_unidade, selecionado) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/unidades/carregarListaVagasGaragem.php",
	  data: { co_tipo_unidade: co_tipo_unidade }
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_unidade + '" '+(val.co_unidade==selecionado ? 'selected' : '')+'>' + val.nu_numero + '</option>';
		});
		$("#co_vaga").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};


var carregaPessoa = function(co_pessoa) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/pessoas/listarPessoa.php",
		  data: { co_pessoa: co_pessoa }
		}).done(function( data ){
			$("#co_pessoa").val( data[0].co_pessoa );
			$("#no_pessoa").val( data[0].no_pessoa );
			$("#nu_cpf").val( data[0].nu_cpf );
			$("#no_pessoa").attr("disabled",true);
			$("#nu_cpf").attr("disabled",true);
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};

if( $("#co_pessoa").val()>0 ){
	carregaPessoa( $("#co_pessoa").val() );
}

$( "#btn-salvar" ).click(function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/moradores/gravar.php",
	  data: { co_pessoa: $('#co_pessoa').val(),
		      no_pessoa: $('#no_pessoa').val(),
		      nu_cpf: $('#nu_cpf').val(),
		  	  co_unidade: $("#co_vaga").val(),
		  	  co_tipo_morador: 1,
		  	  dt_inicio: "00/00/0000",
		  	  co_pessoa_registro: $('#co_pessoa_registro').val()
		    }
	}).done(function( data ){
		mostrarAlertas(data.tipo,data.msg);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
});


var limpaCampos = function() {
	$("#co_pessoa").val(null);
};

</script>