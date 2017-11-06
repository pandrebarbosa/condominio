<p></p>
<!--Alertas-->
<div class="alert alert-dismissable text-center" style="display: none;" id="alertas">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
	<strong>Atenção!</strong>
</div>
<!--/Alertas-->
<div class="row">
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
			  <div class="panel-heading">
				<ol class="breadcrumb">
				  <li><a href="?ido=inicio">Início</a></li>
				  <li><a href="?ido=unidades-listar-por-morador">Lista de unidades</a></li>
				  <li class="active">Ficha da unidade</li>
				</ol>
			  </div><!-- Fim do breadcrumb -->
                <div class="panel-heading" id="linkAbas">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#ficha" data-toggle="tab">Ficha da unidade <?php echo $_GET['no_torre'].$_GET['nu_numero']?></a></li>
						<li><a href="#moradores" data-toggle="tab">Moradores</a></li>
						<li><a href="#veiculos" data-toggle="tab">Veículos</a></li>
						<li><a href="#animais-estimacao" data-toggle="tab">Animais de estimação</a></li>
						<?php if($_SESSION['credencial']['co_tipo_usuario']==1) {?><li><a href="#ocorrencias" data-toggle="tab">Ocorrências</a></li><?php }?>
					</ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="ficha">
	                        <div class="panel panel-info">
							  <div class="panel-heading">Moradores
								<button type="button" id="novo-morador" class="btn btn-primary btn-xs">
								  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Novo
								</button>
							  </div>
							  <div class="panel-body" id="gridMoradores"></div>
							</div>
							
	                        <div class="panel panel-info">
							  <div class="panel-heading">Veículos
								<button type="button" id="novo-veiculo" class="btn btn-primary btn-xs">
								  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Novo
								</button>
							  </div>
							  <div class="panel-body" id="gridVeiculos"></div>
							</div>

	                        <div class="panel panel-info">
							  <div class="panel-heading">Animais de estimação
								<button type="button" id="novo-animal" class="btn btn-primary btn-xs">
								  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Novo
								</button>
							  </div>
							  <div class="panel-body" id="gridAnimais"></div>
							</div>

	                        <div class="panel panel-info">
							  <div class="panel-heading">Ocorrências
								<?php if($_SESSION['credencial']['co_tipo_usuario']==1) {?>
								<button type="button" id="novo-ocorrencia" class="btn btn-primary btn-xs">
								  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Novo
								</button>
								<?php }?>
							  </div>
							  <div class="panel-body" id="gridOcorrencias"></div>
							</div>

						</div><!-- Fim de ficha -->
                        
                        <div class="tab-pane fade" id="moradores">
							<?php include('views/moradores/manter.php') ?>
						</div><!-- Fim de moradores -->
						
                        <div class="tab-pane fade" id="veiculos">
							<?php include('views/veiculos/manter.php') ?>
						</div><!-- Fim de veiculos -->
						
						
                        <div class="tab-pane fade" id="animais-estimacao">
							<?php include('views/animais-estimacao/manter.php') ?>
						</div><!-- Fim de animais-estimacao -->
						
						
                        <div class="tab-pane fade" id="ocorrencias">
							<?php include('views/ocorrencias/manter.php') ?>
						</div><!-- Fim de ocorrencias -->
						
						<input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>">
						<input type="hidden" id="co_pessoa" value="">
						<input type="hidden" id="co_unidade" value="<?php echo isset($_GET['co_unidade']) ? $_GET['co_unidade'] : ''?>">
						<input type="hidden" id="co_torre" value="<?php echo $_GET['no_torre']?>">
						<input type="hidden" id="nu_numero" value="<?php echo $_GET['nu_numero']?>">                        
                    </div>
                </div><!-- Fim da panel-body -->
                
            </div><!-- Fim da panel with-nav-tabs panel-default -->
        </div><!-- Fim da col-md-12 -->
</div><!-- Fim da row -->

<!-- Modal Excluir morador do apartamento -->
<div class="modal fade" id="modal-excluir-morador" tabindex="-1" role="dialog" data-backdrop="static"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
				<h3 class="text-center">Deseja excluir o morador da unidade selecionada?</h3>
				<p>Ao excluir o morador, ele também terá seu email removido da lista de envio 
				de correpondências e seu acesso de usuário a esta unidade revogado.</p>
            </div>
            <div class="modal-footer">
                <button id="btn-excluir-morador" name="btn-excluir-morador" type="button" class="btn btn-danger">Excluir</button>
                <button id="btn-cancelar" name="btn-cancelar" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal Excluir morador do apartamento -->

<!-- Modal Excluir veículo -->
<div class="modal fade" id="modal-excluir-veiculo" tabindex="-1" role="dialog" data-backdrop="static"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body text-center">
				<h3>Deseja excluir o veículo selecionado?</h3>
				
            </div>
            <div class="modal-footer">
                <button id="btn-excluir-veiculo" name="btn-excluir-veiculo" type="button"
                    class="btn btn-danger">Excluir</button>
                <button id="btn-cancelar" name="btn-cancelar"
                    class="btn btn-default" data-dismiss="modal"
                    aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal Excluir veículo -->

<!-- Modal Excluir Animais -->
<div class="modal fade" id="modal-excluir-animal" tabindex="-1" role="dialog" data-backdrop="static"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body text-center">
				<h3>Deseja excluir o Animal de Estimação selecionado?</h3>
				<input type="hidden" id="co_animal">
            </div>
            <div class="modal-footer">
                <button id="btn-excluir-animal" name="btn-excluir-animal" type="button"
                    class="btn btn-danger">Excluir</button>
                <button id="btn-cancelar" name="btn-cancelar" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal Excluir Animais -->

<!-- Modal Excluir Ocorrencias -->
<div class="modal fade" id="modal-excluir-ocorrencia" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body text-center">
				<h3>Deseja excluir a ocorrência selecionada?</h3>
				
            </div>
            <div class="modal-footer">
                <button id="btn-excluir-ocorrencia" name="btn-excluir-ocorrencia" type="button"
                    class="btn btn-danger">Excluir</button>
                <button id="btn-cancelar" name="btn-cancelar"
                    class="btn btn-default" data-dismiss="modal"
                    aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal Excluir Animais -->

<script>
/*
 * Botões Novo
 */
$('#novo-morador').click(function() {
	$('#linkAbas a[href="#moradores"]').tab('show');
});
$('#novo-veiculo').click(function() {
	$('#linkAbas a[href="#veiculos"]').tab('show');
});
$('#novo-animal').click(function() {
	$('#linkAbas a[href="#animais-estimacao"]').tab('show');
});
$('#novo-ocorrencia').click(function() {
	$('#linkAbas a[href="#ocorrencias"]').tab('show');
});

function gridMoradores(){		
	$.ajax({
	  type: "POST",
	  loading: true,	  
	  url: "services/moradores/listarMoradoresPorApartamento.php",
	  data: { co_unidade:$('#co_unidade').val() }
	}).done(function( data ) {
		$('#gridMoradores').hide().html(data).fadeIn('slow');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}gridMoradores();

function gridVeiculos(){		
	$.ajax({
	  type: "POST",
	  loading: false,	  
	  url: "services/veiculos/listarVeiculosPorApartamento.php",
	  data: { co_unidade:  $('#co_unidade').val() }
	}).done(function( data ) {			
		$('#gridVeiculos').hide().html(data).fadeIn('slow');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}gridVeiculos();

function gridAnimais(){		
	$.ajax({
	  type: "POST",
	  loading: true,	  
	  url: "services/animais-estimacao/listarAnimaisPorApartamento.php",
	  data: { co_unidade:  $('#co_unidade').val() }
	}).done(function( data ) {			
		$('#gridAnimais').hide().html(data).fadeIn('slow');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}gridAnimais();

function gridOcorrencias(){		
	$.ajax({
	  type: "POST",
	  loading: true,	  
	  url: "services/ocorrencias/listarOcorrenciasPorApartamento.php",
	  data: { co_unidade:  $('#co_unidade').val() }
	}).done(function( data ) {			
		$('#gridOcorrencias').hide().html(data).fadeIn('slow');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}gridOcorrencias();

var abrirModalExcluirVeiculo = function(co_veiculo) {
	$('#modal-excluir-veiculo').modal('show');
	$("#co_veiculo").val(co_veiculo);
};
$( "#btn-excluir-veiculo" ).click(function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/veiculos/excluir.php",
	  data: { co_veiculo:  $('#co_veiculo').val(),
		  	  co_unidade:  $("#co_unidade").val()
		  	}
	}).done(function( data ){
		limpaCamposVeiculos();
		gridVeiculos();
		$('#modal-excluir-veiculo').modal('hide');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
});

var abrirModalExcluirAnimal = function(co_animal) {
	$('#modal-excluir-animal').modal('show');
	$("#co_animal").val(co_animal);
};
$( "#btn-excluir-animal" ).click(function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/animais-estimacao/excluir.php",
	  data: { co_animal:   $('#co_animal').val(),
		  	  co_unidade:  $("#co_unidade").val()
		  	}
	}).done(function( data ){
		limpaCamposAnimais();
		gridAnimais();
		$('#modal-excluir-animal').modal('hide');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
});

var abrirModalExcluirOcorrencia = function(co_ocorrencia) {
	$('#modal-excluir-ocorrencia').modal('show');
	$("#co_ocorrencia").val(co_ocorrencia);
};
$( "#btn-excluir-ocorrencia" ).click(function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/ocorrencias/excluir.php",
	  data: { co_ocorrencia:  $('#co_ocorrencia').val(),
		  	  co_unidade:     $("#co_unidade").val()
		  	}
	}).done(function( data ){
		limpaCamposOcorrencias();
		gridOcorrencias();
		$('#modal-excluir-ocorrencia').modal('hide');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
});


var abrirModalExcluirMorador = function(co_pessoa) {
	$('#modal-excluir-morador').modal('show');
	$("#co_pessoa").val(co_pessoa);
};


$( "#btn-excluir-morador" ).click(function() {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/moradores/excluir.php",
		  data: { co_unidade: $('#co_unidade').val(),
			  	  co_pessoa:  $("#co_pessoa").val()
			  	}
		}).done(function( data ){
			limpaCamposMoradores();
			gridMoradores();
			$('#modal-excluir-morador').modal('hide');
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
});



var carregaOcorrencia = function(co_ocorrencia) {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/ocorrencias/listarOcorrencia.php",
		  data: { co_ocorrencia: co_ocorrencia }
		}).done(function( data ){
			$("#co_ocorrencia").val( data[0].co_ocorrencia );
			$("#co_tipo_ocorrencia" + data[0].co_tipo_ocorrencia).attr('selected','selected');
			$("#ds_titulo").val( data[0].ds_titulo );
			$("#ds_ocorrencia").val( data[0].ds_ocorrencia);
			$("#dt_hr_ocorrencia").val( data[0].dt_hr_ocorrencia);
			$('#linkAbas a[href="#ocorrencias"]').tab('show');
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
};

$( "#btn-reset-ocorrencia" ).click(function() {
	limpaCamposOcorrencias();
	gridOcorrencias();
	$('#linkAbas a[href="#ficha"]').tab('show');
});
$( "#btn-salvar-ocorrencia" ).click(function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/ocorrencias/gravar.php",
	  data: { co_unidade:  $('#co_unidade').val(),
		  	  co_ocorrencia:  $('#co_ocorrencia').val(),
		  	  co_tipo_ocorrencia: $('#co_tipo_ocorrencia').val(),
		  	  ds_titulo: $('#ds_titulo').val(),
		  	  ds_ocorrencia: $('#ds_ocorrencia').val(),
		  	  dt_hr_ocorrencia: $('#dt_hr_ocorrencia').val()
		    } //st_tipo_pessoa: $( "input:radio[name=st_tipo_pessoa]:checked" ).val(), co_cliente: $("#co_cliente").val(),co_tipo_endereco: $("#co_tipo_endereco").val(),co_bairro: $("#co_bairro").val(),nu_cep: $("#nu_cep").val(),ds_logradouro: $("#ds_logradouro").val(),ds_complemento: $("#ds_complemento").val(), contatos: sContatos
	}).done(function( data ){
		if( data.tipo=="erro" ){
			mostrarAlertas(data.tipo,data.msg);
		}else{
			mostrarAlertas(data.tipo,data.msg);
			limpaCamposOcorrencias();
			gridOcorrencias();
			$('#linkAbas a[href="#ficha"]').tab('show');
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
});


/*
 * Ao mudar de abas limpa os campos da aba moradores
 * somente se sair da aba de moradores 
 */
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	var url = e.relatedTarget ;
	var urlString = url.toString();
	var tab = urlString.slice(-9);
	//console.log(tab);
	if(tab=='moradores'){
		limpaCamposMoradores();
	}else if(tab=='#veiculos'){
		limpaCamposVeiculos();
	}else if(tab=='estimacao'){
		limpaCamposAnimais();
	}else if(tab=='orrencias'){
		limpaCamposOcorrencias();
	}
});

var limpaCamposOcorrencias = function() {
	$("#co_ocorrencia").val(null);
	$("#ds_titulo").val(null);
	$("#ds_ocorrencia").val(null);
	$("#dt_hr_ocorrencia").val(null);
};

</script>