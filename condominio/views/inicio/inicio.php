<?php
$depurar = isset($_GET['debug']) ? true : false;
if($depurar){
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
} ?>
<!-- Modal de Mensagens -->
<div class="modal fade" id="modal-msg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-header">
        		<h2 id="titulo-modal"></h2>
        	</div>
            <div class="modal-body">
            	<div class="row">
            		<div class="col-sm-4" id="imagem-modal">
            			<img class="thumbnail" id="img-modal" />
            		</div>
            		<div class="col-sm-8" id="conteudo-modal">
            		</div>
            	</div>
            </div><!-- modal-body -->
            <div class="modal-footer">
				<div class="row">
            		<div class="col-sm-10">
            			<small class="text-danger text-center">
							O sistema gravará a leitura da mensagem e não a mostrará novamente.
            			</small>          			
            		</div>
            		<div class="col-sm-2">
            		    <div class="checkbox">
							<span><input type="checkbox" id="habilitar-leitura"> Entendi!</span>
						</div>
            		    <button id="btn-li-msg" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" disabled>OK</button>
                		<input type="hidden" id="co_pessoa" value="<?php echo $_SESSION['credencial']['co_pessoa']?>" >
            			<input type="hidden" id="co_mensagem" >
            		</div>
            	</div>            
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal de Edição -->	

<script>
function mostraMensagemPopup(co_pessoa){		
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/mensagens/mostrarMensagemPopup.php",
	  data: { co_pessoa: co_pessoa }
	}).done(function( data ) {
		if(data){
			$("#titulo-modal").html(data[0].ds_titulo);
			$("#conteudo-modal").html(data[0].ds_conteudo);
			$("#co_mensagem").val(data[0].co_mensagem);
			$("#img-modal").attr('src','img/'+data[0].ds_imagem);
			$("#modal-msg").modal("show");
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}mostraMensagemPopup(<?php echo $_SESSION['credencial']['co_pessoa']?>);

$( "#btn-li-msg" ).click(function() {
	registrarLeituraDeMensagem();
});

$( "#habilitar-leitura" ).click(function() {
	if($('#habilitar-leitura').prop('checked') === true){
		$( "#btn-li-msg" ).removeAttr('disabled');
	}else{
		$( "#btn-li-msg" ).attr('disabled','disabled');
	}
});

function registrarLeituraDeMensagem(){		
	$.ajax({
	  type: "POST",
	  loading: false,	  
	  url: "services/mensagens/registrarLeituraMensagem.php",
	  data: { co_pessoa: $("#co_pessoa").val(), co_mensagem: $("#co_mensagem").val() }
	}).done(function() {
		$("#titulo-modal").html(null);
		$("#conteudo-modal").html(null);
		$("#co_mensagem").val(null);
		$("#modal-msg").modal("hide");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}
</script>	

<?php 
//Se a senha for a inicial: 123456789, redireciona para a mudança dela.
if($_SESSION['credencial']['ds_senha'] == "25f9e794323b453885f5181f1b624d0b"){
	echo "<script>alert('Troque sua senha, saia do sistema e entre novamente.');document.location.href='default.php?ido=login-manter'</script>";
}
?>
<p></p>
<!--Alertas-->
<div class="alert alert-dismissable" style="display: none;" id="alertas">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
	<strong>Atenção!</strong>
</div>
<!--/Alertas-->  

<div class="page-header text-center">
  <h2>Bem vindo, <small><?php echo $_SESSION['credencial']['Nome']?></small></h2>
  <p>Seu perfil de acesso é <em><?php echo $_SESSION['credencial']['no_tipo_usuario']?>  [<?php print $_SESSION['credencial']['ambiente']; ?>]</em></p>
</div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
    	<a href="#aba-inicio" aria-controls="aba-inicio" role="tab" data-toggle="tab">Início</a>
    </li>    
    <?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $abaDadosGerais)) {?>
    <li role="presentation">
    	<a href="#aba-admin" aria-controls="profile" role="tab" data-toggle="tab">Dados Gerais</a>
    </li>
    <?php }?>
    <?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $abaAcessos)) {?>
    <li role="presentation">
    	<a href="#aba-acessos" aria-controls="profile" role="tab" data-toggle="tab">Acessos</a>
    </li>
    <?php }?>
    <?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $abaMinhasUnidades)) {?>
    <li role="presentation">
    	<a href="#aba-minhas-unidades" aria-controls="aba-minhas-unidades" role="tab" data-toggle="tab">Minhas Unidades</a>
    </li>
    <?php }?>
    <?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $abaMinhasUnidades)) {?>
    <li role="presentation">
    	<a href="#aba-correspondencias" aria-controls="aba-correspondencias" role="tab" data-toggle="tab">Correspondências</a>
    </li>
    <?php }?>    
    <li role="presentation" >
    	<a href="#aba-corpo-diretivo" aria-controls="aba-corpo-diretivo" role="tab" data-toggle="tab">Síndico/Conselho</a>
    </li>
    <li role="presentation" >
    	<a href="#aba-documentos" aria-controls="aba-documentos" role="tab" data-toggle="tab">Documentos</a>
    </li>
    <?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $abaPendencias)) {?>
<!--     <li role="presentation" > -->
<!--    	<a href="#aba-pendencias" aria-controls="aba-pendencias" role="tab" data-toggle="tab" style="color: red;">Pendências</a> -->
<!--     </li> -->
    <?php }?>   
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="aba-inicio">
		  <?php 
		  	switch ($_SESSION['credencial']['no_tipo_usuario']) {
		  		case "Ag. Portaria":
		  		include('aba-inicial-portaria.php');
		  		break;		  			
		  		case "Administrador":
		  		include('aba-inicial-admin.php');
		  		break;
		  		
		  		case "Morador":
		  		case "SYS-ADM":
		  		include('aba-inicial-morador.php');
		  		break;
		  	}
		  ?>
		<input type="hidden" value="<?php echo $_SESSION['credencial']['co_pessoa'] ?>" id="co_pessoa_registro">
		<input type="hidden" value="<?php echo $_SESSION['credencial']['co_unidade'] ?>" id="co_unidade">
	</div><!-- Aba Início -->
	  
  	<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $abaDadosGerais)) {?>
    <div role="tabpanel" class="tab-pane" id="aba-admin">

		<div class="row">
			<div class="col-sm-4">
				<h5 class="text-center">Moradores cadastrados</h5>
				<h1 id="gridMoradores" class="text-center"></h1>			
			</div>			
			<div class="col-sm-4">
				<h5 class="text-center">Moradores por unidade</h5>
				<div id="gridMoradoresPorUnidade" class="div-inicio-scroll"></div>
			</div>
			<div class="col-sm-4">
				<h5 class="text-center">Veículos por unidade</h5>
				<div id="gridVeiculos" class="div-inicio-scroll"></div>			
			</div>					
		</div>

	</div><!-- Aba Admin -->
	<?php }?>
  	<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $abaAcessos)) {?>
    <div role="tabpanel" class="tab-pane" id="aba-acessos">

		<div class="row">
			<div class="col-sm-4">
				<h5 class="text-center">Últimos acessos</h5>
				<div id="gridUltimosAcessos" class="div-inicio-scroll"></div>
			</div>		
			<div class="col-sm-4">
				<h5 class="text-center">Acessos por usuários</h5>
				<div id="gridAcessosPorUsuarios" class="div-inicio-scroll"></div>
			</div>
			<div class="col-sm-4">
				<h5 class="text-center">S.O</h5>
				<div id="gridSO" class="div-inicio-scroll"></div>			
			</div>
		</div>

	</div><!-- Aba Acessos -->
	<?php }?>
		
    <div role="tabpanel" class="tab-pane" id="aba-minhas-unidades">
	  <div id="gridUnidades"></div>
	  <div class="alert alert-info" role="alert">
		Clique <a href="?ido=unidades-moradores-manter&co_pessoa=<?php echo $_SESSION['credencial']['co_pessoa'] ?>"><b>aqui</b> <span class="glyphicon glyphicon-plus"></span></a> para incluir, em sua propriedade, uma nova vaga na garagem.
	 </div>
	</div><!-- Aba Unidades -->
	
    <div role="tabpanel" class="tab-pane" id="aba-correspondencias">
        <table id="gridCorrespondencias" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true">
            <thead>
                <tr>
                    <th data-column-id="item" data-type="string" data-identifier="true">Item</th>
                    <th data-column-id="unidade" data-type="string">Unidade</th>
                    <th data-column-id="recebedor" data-type="string">Recebedor</th>
                    <th data-column-id="chegada" data-type="string" data-order="desc">Chegada</th>
                    <th data-column-id="retirada" data-type="string">Retirada</th>
                </tr>
            </thead>
        </table>	
	</div><!-- Aba Correspondências -->	
	
    <div role="tabpanel" class="tab-pane" id="aba-corpo-diretivo">
		<h2>Síndico</h2>
		Hernani - <small>Interfone: 2110</small>
		<h3>Sub síndico</h3>
		Paulo André Barbosa - <small>Interfone: 1406</small>
		<h3>Conselho consultivo</h3>
		Alan Monteiro<br />
		João Paulo<br />
		Vitor Recondo
	</div><!-- Aba Unidades -->
    <div role="tabpanel" class="tab-pane" id="aba-documentos">
		<h4><a href="../arquivos/documentos/ato-regimental.pdf" target="_blank">Ato Regimental</a></h4>
		<h4><a href="../arquivos/documentos/convencao.pdf" target="_blank">Convenção</a></h4>
		<h4><a href="../arquivos/documentos/cpf.pdf" target="_blank">Comunicado - 27/10/2016 <small>Obrigatoriedade do CPF para o cadastro do proprietários e locatários.</small></a></h4>
		<h4><a href="../arquivos/documentos/instrumento_particular_procuracao.pdf" target="_blank">Instrumento Particular de Procuração.</a></h4>
	</div><!-- Aba Unidades -->
	
<!--     <div role="tabpanel" class="tab-pane" id="aba-pendencias"> -->
<!-- 		<div id="gridPendencias"></div> -->
<!-- 	</div> -->
			
  </div><!-- Tab panes -->

<!-- Modal confirma Parar de receber email -->
<div class="modal fade" id="modal-confirmar-exclusao" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-confirmar-exclusao">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			Parar de receber emails
			</div>
            <div class="modal-body text-center">
				Deseja mesmo cancelar o recebimento de emails?
            </div>
            <div class="modal-footer">
                  <button id="btn-confirmar-cancelamento-email" class="btn btn-danger">Confirmar</button>
                  <button id="btn-cancelar" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
/*
 * Ao mudar de abas limpa os campos da aba moradores
 * somente se sair da aba de moradores 
 */
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	var url = e.target;
	var urlString = url.toString();
	var tab = urlString.split("#");

	if(tab[1] == "aba-admin"){
		gridQtdMoradores();
		gridQtdMoradoresPorUnidade();
		gridQtdVeiculos();
	}else if(tab[1] == "aba-acessos"){
		gridUltimosAcessos();
		gridQtdAcessosPorUsuarios();
		gridQtdSO();
	}else if(tab[1] == "aba-minhas-unidades"){
		gridUnidades();
	}else if(tab[1] == "aba-pendencias"){
		gridPendencias();
	}else if(tab[1] == "aba-correspondencias"){
		$("#grid").bootgrid("reload");
	}

});

var montaResultadoTabela = function(result, header, divResultado) {
	var tabela = "<table class='table table-striped'>";
		tabela += "<tr>";
		$.each(header, function (key, val) {
			tabela += "<th>" + val + "</th>";
		});
		tabela += "</tr>";		
	$.each(result, function (key, val) {
		tabela += "<tr>";
		$.each(header, function (k, v) {
			tabela += "<td>" + val[v] + "</td>";
		});
		tabela += "</tr>";
	});
	tabela += "</table>";
	
	$('#' + divResultado).html(tabela).fadeIn('slow');
};

function gridUnidades(){		
	$.ajax({
	  type: "POST",	
	  loading: false,	  
	  url: "services/unidades/listarUnidadesPorMorador.php"
	}).done(function(data, textStatus, jqXHR) {
		$("#gridUnidades").html(data).fadeIn('slow');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

function gridPendencias(){		
	$.ajax({
	  type: "POST",	
	  loading: false,	  
	  url: "services/pendencias/listarPendencias.php"
	}).done(function(data, textStatus, jqXHR) {
		$("#gridPendencias").html(data).fadeIn('slow');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

var grid = $("#gridCorrespondencias").bootgrid({
    ajax: true,
    ajaxSettings: {
        method: "POST",
        cache: false
    },
    post: function ()
    {
        /* To accumulate custom parameter with the request object */
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },    
    url: "services/correios/listarCorreioDisponivelPorUnidade.json.php"
});

function gridQtdMoradoresPorUnidade(){		
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/moradores/listarQuantidadeMoradoresPorUnidade.php"
	}).done(function( data ) {
		var header = ["Unidade", "Total"];
		montaResultadoTabela(data, header, "gridMoradoresPorUnidade");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

function gridQtdMoradores(){		
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/moradores/listarQuantidadeMoradores.php"
	}).done(function( data ) {
		$("#gridMoradores").html(data[0].qtd);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

function gridQtdVeiculos(){		
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/veiculos/listarQuantidadeVeiculos.php"
	}).done(function( data ) {
		var header = ["Unidade", "Total"];
		montaResultadoTabela(data, header, "gridVeiculos");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}


function gridQtdAcessosPorUsuarios(){		
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/acessos/listarQuantidadeAcessosPorUsuarios.php"
	}).done(function( data ) {
		var header = ["Usuário", "Total"];
		montaResultadoTabela(data, header, "gridAcessosPorUsuarios");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

function gridQtdSO(){		
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/acessos/listarQuantidadeSO.php"
	}).done(function( data ) {
		var header = ["SO", "Total"];
		montaResultadoTabela(data, header, "gridSO");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

function gridUltimosAcessos(){		
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/acessos/listarUltimosAcessos.php"
	}).done(function( data ) {
		var header = ["Data/hora", "Usuário"];
		montaResultadoTabela(data, header, "gridUltimosAcessos");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

$( "#receber-email_correio" ).click(function() {
	if($('#receber-email_correio').prop('checked') === false){
		$('#modal-confirmar-exclusao').modal('show');
	}else{
		gravarRecebimentoEmail();
	}
});
$( "#btn-confirmar-cancelamento-email" ).click(function() {
	gravarRecebimentoEmail();
	$('#modal-confirmar-exclusao').modal('hide');
});
$( "#btn-cancelar" ).click(function() {
	autorizacaoEmail();
});


function gravarRecebimentoEmail(){
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/emails/gravarAutorizacaoNotificacao.php",
	  data: {co_pessoa: $( "#co_pessoa_registro" ).val(),
		     co_unidade: $( "#co_unidade" ).val(),
		     st_autorizado: $('#receber-email_correio').prop('checked'),
		     co_pessoa_registro: $( "#co_pessoa_registro" ).val()}
	}).done(function( data ) {
		autorizacaoEmail();
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}

function autorizacaoEmail(){
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: false,	  
	  url: "services/usuarios/retornaAutorizacaoRecebimentoEmail.php",
	  data: {co_pessoa: $( "#co_pessoa_registro" ).val(), co_unidade: $( "#co_unidade" ).val()}
	}).done(function( data ) {
		if(data == 1 ){
			$( "#receber-email_correio" ).prop('checked', true);
			$('#texto-mensagem-check').html('Desejo <b>PARAR</b> de receber emails quando uma nova correspondência chegar! ');
			$("#aviso-polegar").addClass('glyphicon-thumbs-down');
			$("#aviso-polegar").removeClass('glyphicon-thumbs-up');
		}else{
			$("#receber-email_correio").prop('checked', false);
			$("#texto-mensagem-check").html('Desejo receber email quando uma nova correspondência chegar! ');
			$("#aviso-polegar").removeClass('glyphicon-thumbs-down');
			$("#aviso-polegar").addClass('glyphicon-thumbs-up');
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}autorizacaoEmail();
</script>