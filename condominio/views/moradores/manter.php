<form role="form" name="frm-moradores" id="frm-moradores">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
		    <div class="image-editor">
				<div class="cropit-preview" style="margin-left: 25px;"></div>	
				<p></p>
				
				<div class="btns">
			    	<span class="rotate-ccw icon-rotate-left"></span>
			    	<span class="rotate-cw icon-rotate-right"></span>
					<input type="range" class="cropit-image-zoom-input">
			    </div>
				<div class="inputFile" style="margin-left: 40px; margin-top: 8px;">
				    <span>Selecione um arquivo</span>
				    <input type="file" class="cropit-image-input" accept="image/*" />
				</div>
		    </div>		
			<input type="hidden" id="ds_foto">
		</div>

		<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9">
			<div class="row">	
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<label class="tooltipster" title="Nos casos do morador ser o proprietário ou o locatário, o preencimento do CPF é obrigatório.">Tipo de morador <span class="glyphicon glyphicon-question-sign" aria-hidden="true" ></span></label>
					<select id="co_tipo_morador" class="form-control"></select>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<label for="exampleInputEmail1">Data de entrada no imóvel</label>
					<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
						<input type="text" class="form-control mascara-data" id="dt_inicio" name="dt_inicio" value="<?php echo date("d/m/Y")?>">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-lg-4">
					<label class="tooltipster" title="A foto será exibida SOMENTE aqui dentro do sistema San Raphael para que os vizinhos te conheçam melhor. Caso não queira, basta clicar em não.">Permite publicação da foto? <span class="glyphicon glyphicon-question-sign" aria-hidden="true" ></span></label>
					<br />
					<label class="radio-inline">
					  <input type="radio" name="st_foto_publica" id="st_foto_publica1" value="1"> Sim
					</label>
					<label class="radio-inline">
					  <input type="radio" name="st_foto_publica" id="st_foto_publica0" value="0" checked="checked"> Não
					</label>					
				</div>
			</div>
			<!-- Fecha div row -->
			<p></p>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
					<label class="tooltipster" title="Caso haja algum erro no CPF, envie uma mensagem para ajuda@condominiosanraphael.com.br">CPF <span class="glyphicon glyphicon-question-sign" aria-hidden="true" ></span></label>
					<input type="text" class="form-control mascara-cpf" id="nu_cpf" name="nu_cpf" required>
				</div><!-- Fecha div col-md-3 -->
				
				<div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
					<label for="exampleInputEmail1">RG</label>
					<input type="text" class="form-control" id="nu_rg" name="nu_rg" placeholder="3243 SSP/DF" required>
				</div>
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<label for="exampleInputEmail1">Nome</label>
					<input type="text" class="form-control" id="no_pessoa" name="no_pessoa" placeholder="Nome do morador" required>
				</div><!-- Fecha div col-md-3 -->				

			</div><!-- Fecha div row -->

			<p></p>

			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<label for="exampleInputEmail1">Data de nascimento</label>
					<div class="input-group date" data-provide="datepicker"
						data-date-format="dd/mm/yyyy">
						<input type="text" class="form-control mascara-data"
							id="dt_nascimento" name="dt_nascimento">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
				</div>
				<!-- Fecha div col-md-3 -->
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<label class="tooltipster" for="teste" title="Começe digitando o texto. Caso o termo já exista, clique nele. Caso contrário, complete o cadastro.">Profissão <span class="glyphicon glyphicon-info-sign" aria-hidden="true" ></span></label>
					<input type="text" class="form-control" id="no_profissao" name="no_profissao" required>
					<input type="hidden" id="co_profissao">				
					<input type="hidden" id="imagem-anterior">				
				</div>
				<!-- Fecha div col-md-3 -->
				<div class="col-md-4 col-lg-4"></div>
				<!-- Fecha div col-md-3 -->
			</div><!-- Fecha div row -->

			<p></p>

			<div class="well hide" style="width: 99%;" id="div_contato">
				<div class="alert alert-warning" role="alert">
				  <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Clique no botão gravar para adicionar mais contatos
				</div>
				<div class="row">
					<div class="col-xs-5 col-sm-4 col-md-3 col-lg-3">
						<label for="exampleInputEmail1">Tipo de contato:</label>
						<select id="co_tipo_contato" name="co_tipo_contato" class="form-control">
						<?php
						$res_tcontato = $banco->seleciona ( "tb_tipo_contato", "*", "", "", "", "", FALSE );
						if (is_array ( $res_tcontato )) {
							foreach ( $res_tcontato as $tcontato ) {?>
						  <option value="<?php echo $tcontato['co_tipo_contato'] ?>" id="co_tipo_contato<?php echo $tcontato['co_tipo_contato'] ?>"><?php echo $tcontato['no_tipo_contato'] ?></option>
						<?php } } ?>
						</select>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-6 col-lg-6">
						<label for="exampleInputEmail1">Contato</label>
						<input type="text" class="form-control phone" id="ds_contato" name="ds_contato">
					</div>
					<div class="col-xs-3 col-sm-4 col-md-3 col-lg-3">
						<a class="btn btn-success btn-sm" style="margin-top:26px;" title="add" id="btn-salvar-contato">Gravar</a>
					</div>	
				</div><!-- Fecha div row -->
				<p></p>
				<div class="row" id="gridContatos"></div>
			</div><!-- Fim do well -->

		</div><!-- Fecha div col-md-12 -->

	</div><!-- Fim div row -->

	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar-morador">Salvar Morador</button>
		<button type="reset" id="btn-reset-morador" class="btn btn-default">Cancelar</button>
	</div><!-- Fim div panel-footer -->
</form>

<!-- Modal confirma CPF -->
<div class="modal fade" id="modal-confirmar-cpf" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-confirmar-cpf">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			Atenção!
			</div>
            <div class="modal-body text-center">
				<span id="msg-pessoa-cpf"></span>
				<input type="hidden" id="co_pessoaTemp">
				<input type="hidden" id="no_pessoaTemp">
				<input type="hidden" id="nu_cpfTemp">
				<input type="hidden" id="nu_rgTemp">
				<input type="hidden" id="dt_nascimentoTemp">				
            </div>
            <div class="modal-footer">
                <button id="btn-confirmar-pessoa" type="button" class="btn btn-primary">Sim</button>
                <button id="btn-cancelar-pessoa" type="button" class="btn btn-default">Não</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
$( "#co_tipo_contato" ).change(function() {
	if($( "#co_tipo_contato" ).val() == 3){
		$( "#ds_contato" ).removeClass("phone");
		$( "#ds_contato" ).unmask();
	}else{
		$( "#ds_contato" ).addClass("phone");
	}
	$( "#ds_contato" ).val(null);
});

$( "#no_profissao" ).click(function() {
	$( "#no_profissao" ).val(null);
	$( "#co_profissao" ).val(null);
});

var edicaoPessoa = function() {
	if( $("#co_pessoa").val() > 0 && $("#nu_cpf").val() != '' ){
		$("#nu_cpf").attr("disabled","true");
	}else{
		$("#nu_cpf").removeAttr("disabled","true");
	}
};edicaoPessoa();

var limpaCamposMoradores = function() {
	$("#co_pessoa").val(null);
	esconderCamposContatos();
	$("#no_pessoa").val(null);
	$("#nu_cpf").val(null);
	$("#nu_rg").val(null);
	$("#dt_nascimento").val(null);
	$("#dt_inicio").val(null);
	$("#no_profissao").val(null);
	$("#co_profissao").val(null);
	$("#ds_foto").val(null);
	$("#co_pessoaTemp").val( null );
	$("#no_pessoaTemp").val( null );
	$("#nu_cpfTemp").val( null );
	$("#nu_rgTemp").val( null );
	$("#dt_nascimentoTemp").val( null );
	limparImagem();
	edicaoPessoa();
};


var montaResultadoTabela = function(result, header, divResultado) {
	var total=0;
	var tabela = "<table class='table table-striped'>";
		tabela += "<tr>";
		$.each(header, function (key, val) {
			tabela += "<th>" + val + "</th>";
		});
		tabela += "<th>Ação</th>";
		tabela += "</tr>";

	var i=1;
	$.each(result, function (key, val) {
		tabela += "<tr>";
		$.each(header, function (k, v) {
			tabela += "<td>" + val[v] + "</td>";
		});
		tabela += "<td>";
		tabela += "<a class='btn btn-danger btn-xs' title='Excluir' href='javascript:apagaContato("+val.co_contato+","+val.co_pessoa+");'><i class='glyphicon glyphicon-minus-sign'></i></a>";
		tabela += "</td>";
		tabela += "</tr>";
		i++;
	});
	tabela += "</table>";
	
	$('#' + divResultado).html(tabela).fadeIn('slow');
};

var gridContatos = function(co_pessoa) {	
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,
	  url: "services/contatos/listarContatosPorPessoa.php",
	  data: { co_pessoa: co_pessoa }
	}).done(function( data ) {
		var header = ["Tipo de contato", "Contato"];
		montaResultadoTabela(data, header, "gridContatos");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};


var mostrarCamposContatos = function() {
	$("#div_contato").removeClass('hide');
	$("#div_contato").addClass('show').fadeIn('slow');
};

var esconderCamposContatos = function() {
	$("#div_contato").removeClass('show');
	$("#div_contato").addClass('hide').fadeIn('slow');
};

var carregaTipoMorador = function(selecionado) {
	var options = "";
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/tipos-de-moradores/listarTipoMorador.php"
	}).done(function( data ){
		$.each(data, function (key, val) {
			options += '<option value="' + val.co_tipo_morador + '" '+(val.co_tipo_morador==selecionado ? 'selected' : '')+'>' + val.no_tipo_morador + '</option>';
		});
		$("#co_tipo_morador").html(options);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; carregaTipoMorador(null);

var ValidaCampoMorador = function() {
    if ($("#co_unidade").val() == ""){
    	mostrarAlertas("erro","Unidade não identificada!");
        return false;
    }
    if ($("#co_tipo_morador").val() == ""){
    	mostrarAlertas("erro","Tipo de morador não identificado!");
        return false;
    }

    //Obrigar o preenchimento do CPF somente para Moradorou Proprietário
    if ($("#co_tipo_morador").val() == 1 || $("#co_tipo_morador").val() == 4){
        if ($("#nu_cpf").val() == "" ||
                $("#nu_cpf").val() == "000.000.000-00" ||
                $("#nu_cpf").val() == "111.111.111-11" ||
                $("#nu_cpf").val() == "222.222.222-22" ||
                $("#nu_cpf").val() == "333.333.333-33" ||
                $("#nu_cpf").val() == "444.444.444-44" ||
                $("#nu_cpf").val() == "555.555.555-55" ||
                $("#nu_cpf").val() == "666.666.666-66" ||
                $("#nu_cpf").val() == "777.777.777-77" ||
                $("#nu_cpf").val() == "888.888.888-88" ||
                $("#nu_cpf").val() == "999.999.999-99") {
                    
            	mostrarAlertas("erro","CPF do <b>proprietário ou locatário</b> inválido!");
                $("#nu_cpf").focus();
                return false;
            }
    }
   
    if ($("#no_pessoa").val() == ""){
    	mostrarAlertas("erro","Nome do morador não preenchido!");
        $("#no_pessoa").focus();
        return false;
    }
    if ($("#dt_inicio").val() == ""){
    	mostrarAlertas("erro","Data de início não preenchido!");
        $("#dt_inicio").focus();
        return false;
    }
        
    return true;
};

var ValidaContato = function() {
    if ($("#co_unidade").val() == ""){
    	mostrarAlertas("erro","Unidade não identificada!");
        return false;
    }
    if ($("#ds_contato").val() == ""){
    	mostrarAlertas("erro","Contato do morador não preenchido!");
        $("#ds_contato").focus();
        return false;
    } 
        
    return true;
};

var options = {
		url: function(phrase) {
			return "services/profissao/listarProfissaoAutoComplete.php?no_profissao=" + phrase + "&format=json";
		},
		getValue: "no_profissao",
		adjustWidth:false,
		list: {

			onSelectItemEvent: function() {
				var co_profissao = $("#no_profissao").getSelectedItemData().co_profissao;
				$("#co_profissao").val(co_profissao).trigger("change");
			}
		}		
	};
$("#no_profissao").easyAutocomplete(options);

$( "#btn-salvar-morador" ).click(function() {
	if(ValidaCampoMorador()){
		var imageData = $('.image-editor').cropit('export');
		var foto = $('#ds_foto').val();
		if(typeof imageData != "undefined" && $('#imagem-anterior').val() != imageData){
			salvarImagem();
		}else{
			gravaMorador();
		}
	}
});

var carregaMorador = function(co_pessoa) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/moradores/listarMorador.php",
		  data: { co_pessoa: co_pessoa }
		}).done(function( data ){
			$("#co_pessoa").val( data[0].co_pessoa );
			$("#no_pessoa").val( data[0].no_pessoa );
			carregaImagem( data[0].ds_foto);
			$('#ds_foto').val( data[0].ds_foto );
			$("#nu_cpf").val( data[0].nu_cpf );
			$("#nu_rg").val( data[0].nu_rg );
			$("#dt_inicio").val( data[0].dt_inicio);
			$("#no_profissao").val( data[0].no_profissao);
			$("#co_profissao").val( data[0].co_profissao);
			$("#dt_nascimento").val( data[0].dt_nascimento);
			carregaTipoMorador(data[0].co_tipo_morador);
			$("#st_foto_publica" + data[0].st_foto_publica).attr('checked','checked');
			gridContatos( data[0].co_pessoa );
			mostrarCamposContatos();
			edicaoPessoa();
			$('#linkAbas a[href="#moradores"]').tab('show');
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};

$('#nu_cpf').blur(function() {
	if( $('#nu_cpf').val()!='' ){
		if(		$("#nu_cpf").val() != "000.000.000-00" &&
		        $("#nu_cpf").val() != "111.111.111-11" &&
		        $("#nu_cpf").val() != "222.222.222-22" &&
		        $("#nu_cpf").val() != "333.333.333-33" &&
		        $("#nu_cpf").val() != "444.444.444-44" &&
		        $("#nu_cpf").val() != "555.555.555-55" &&
		        $("#nu_cpf").val() != "666.666.666-66" &&
		        $("#nu_cpf").val() != "777.777.777-77" &&
		        $("#nu_cpf").val() != "888.888.888-88" &&
		        $("#nu_cpf").val() != "999.999.999-99" ) {
				carregaPessoaPorCpf( $('#nu_cpf').val() );
		}
	}
});

var carregaPessoaPorCpf = function(nu_cpf) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/pessoas/listarPessoa.php",
		  data: { nu_cpf: nu_cpf }
		}).done(function( data ){
			if(data){
				$("#co_pessoaTemp").val( data[0].co_pessoa );
				$("#no_pessoaTemp").val( data[0].no_pessoa );
				$("#nu_cpfTemp").val( data[0].nu_cpf );
				$("#nu_rgTemp").val( data[0].nu_rg );
				$("#dt_nascimentoTemp").val( data[0].dt_nascimento);
				carregaImagem( data[0].ds_foto);				
				msgConfirmaUsuario(data);		
			}
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};

var msgConfirmaUsuario = function(data) {
	var mensagem = "O CPF <b>"+data[0].nu_cpf +"</b> já está vinculado a <b>" + data[0].no_pessoa + "</b>. Deseja continuar?";
	$("#msg-pessoa-cpf").html(mensagem);
	$("#modal-confirmar-cpf").modal('show');
};

$( "#btn-confirmar-pessoa" ).click(function() {
	$("#co_pessoa").val( $("#co_pessoaTemp").val() );
	$("#no_pessoa").val( $("#no_pessoaTemp").val() );
	$("#nu_cpf").val( $("#nu_cpfTemp").val() );
	$("#nu_rg").val( $("#nu_rgTemp").val() );
	$("#dt_nascimento").val( $("#dt_nascimentoTemp").val() );
	edicaoPessoa();
	$("#modal-confirmar-cpf").modal('hide');
});

$( "#btn-cancelar-pessoa" ).click(function() {
	$("#co_pessoaTemp").val( null );
	$("#no_pessoaTemp").val( null );
	$("#nu_cpfTemp").val( null );
	$("#nu_rgTemp").val( null );
	$("#dt_nascimentoTemp").val( null);
	$("#nu_cpf").val( null );
	$("#modal-confirmar-cpf").modal('hide');
});

$( "#btn-reset-morador" ).click(function() {
	limpaCamposMoradores();
	gridMoradores();
	$('#linkAbas a[href="#ficha"]').tab('show');
});

var gravaMorador = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/moradores/gravar.php",
	  data: { co_pessoa: $('#co_pessoa').val(),
		  	  co_unidade:  $('#co_unidade').val(),
		  	  ds_foto:  $('#ds_foto').val(),
		  	  co_tipo_morador: $('#co_tipo_morador').val(),
		  	  dt_inicio: $('#dt_inicio').val(),
		  	  dt_nascimento: $('#dt_nascimento').val(),
		  	  no_pessoa: $('#no_pessoa').val(),
		  	  nu_cpf: $('#nu_cpf').val(),
		  	  nu_rg: $('#nu_rg').val(),
		  	  co_profissao: $("#co_profissao").val(),
		  	  no_profissao: $("#no_profissao").val(),
		  	  st_foto_publica: $( "input:radio[name=st_foto_publica]:checked" ).val(),
		  	  co_pessoa_registro: $('#co_pessoa_registro').val()
		    } 
	}).done(function( data ){
		if( data.tipo=="erro" ){
			mostrarAlertas(data.tipo,data.msg);
			edicaoPessoa();
		}else{
			mostrarAlertas(data.tipo,data.msg);
			limpaCamposMoradores();
			gridMoradores();
			$('#linkAbas a[href="#ficha"]').tab('show');
		}		

	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}


$( "#btn-salvar-contato" ).click(function() {
	if(ValidaContato()){
		gravaContato();
	}
});

var gravaContato = function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/contatos/gravar.php",
	  data: { co_pessoa: $('#co_pessoa').val(),
		  	  co_tipo_contato: $('#co_tipo_contato').val(),
		  	  ds_contato: $('#ds_contato').val()
		    } 
	}).done(function( data ){
		if( data.tipo=="erro" ){
			mostrarAlertas(data.tipo,data.msg);
		}else{
			gridContatos( data.id );
		  	$('#ds_contato').val(null);			
		}		

	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}
var apagaContato = function(co_contato,co_pessoa) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/contatos/excluir.php",
	  data: { co_contato:  co_contato,
		  	  co_pessoa:   co_pessoa
		  	}
	}).done(function( data ){
		gridContatos(data.id);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};

var salvarImagem = function() {
	var imageData = $('.image-editor').cropit('export');
	$('#imagem-anterior').val(imageData);
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: "services/uploads/upload-images.php",
	  data: {imageData: imageData,
			 folder: '/arquivos/imagens/pessoas/'
			 }
	}).done(function( data ){
		$("#ds_foto").val(null);
		$("#ds_foto").val(data.arquivo);

		//TODO Fazer separado de maneira sincrona
		gravaMorador();
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
	});
};
var limparImagem = function() {
	$('.cropit-preview').css('background-image', 'none');
	$('.cropit-image-loaded').css('background-image', 'none');
	$('.cropit-preview-image').attr('src', null);
};
var carregaImagem = function(arquivo) {
	var src = '<?php echo $_SESSION['credencial']['ambiente']=="DEV" ? "/condominiosanraphael" : "" ?>/arquivos/imagens/pessoas/' + arquivo;
	limparImagem();
	$('.cropit-preview').css('background-image', 'url(' + src + ')');
};

</script>