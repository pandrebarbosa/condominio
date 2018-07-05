<script>
function grid(pagina,criterio){		
	$.ajax({
	  type: "POST",
	  loading: true,	  
	  url: "services/moradores/listar.php",
	  data: { pagina: pagina, criterio: criterio }
	}).done(function( data ) {			
		$('#grid').hide().html(data).fadeIn('slow');
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}grid(null,null);
</script>
<p></p>      
<div class="panel panel-default">
  <div class="panel-heading">
	<ol class="breadcrumb">
	  <li><a href="?ido=<?php echo base64_encode("inicio")?>">Início</a></li>
	  <li class="active">Moradores</li>
	</ol>
  </div>
  <div class="panel-body">


		<div class="row">
		  
		  <div class="col-md-5">
		  	<input type="text" class="form-control" id="criterio" placeholder="Digite o numero do apartamento ou o nome do morador">
		  </div>
		  <div class="col-md-7">		  
				<button class="btn btn-info" id="btn-buscar">Buscar</button>
				<button class="btn btn-warning" id="btn-reset">Limpar</button>
				<button class="btn btn-primary" id="btn-novo">Novo <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>	
		  </div>
		  <div class="col-md-4"></div>

		</div><!-- Fecha div row -->			

	<hr>		
	
	<div id="grid"></div>

  </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="modal-cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <form class="form-horizontal" id="form-bairro">
                    <fieldset>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label">Bairro</label>
                            <div class="controls">
                                <input id="no_bairro" name="no_bairro" type="text" placeholder="Digite o nome do bairro" class="input-xlarge" required="">
								<input type="hidden" name="co_bairro" id="co_bairro" value="">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-salvar" name="btn-salvar" type="button"
                    class="btn btn-primary">Salvar</button>
                <button id="btn-voltar" name="btn-voltar"
                    class="btn btn-default" data-dismiss="modal"
                    aria-hidden="true">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal de Edição -->


<script>
	$( "#btn-novo" ).click(function() {
		abreJanelaCadastro();
	});

	var abreJanelaCadastro = function( id,torre,numero,tipo_unidade ) {
		$('#modal-cadastro').modal('show');
		if( (id) && (torre) && (numero) && (tipo_unidade) ){
			$('#no_bairro').val(id,torre,numero,tipo_unidade);
		}
	};
	
	$( "#btn-buscar" ).click(function() {
	  grid(null,$("#criterio").val());
	});
	$( "#criterio" ).keypress(function(e) {
	  if(e.which == 13) {
		grid(null,$("#criterio").val());
	  }
	});
	$( "#btn-reset" ).click(function() {
	  grid(null,null);
	  $("#appendedInputButtons").val('');
	});	
</script>