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
	  <li class="active">Usuários</li>
	</ol>
  </div>
  <div class="panel-body">
		<div class="row">
		  <div class="col-md-5">
				<button class="btn btn-primary" id="btn-novo">Novo usuário</button>		
		  </div>
		  <div class="col-md-4"></div>
		  		  <div class="col-md-5">
		  </div>
		</div><!-- Fecha div row -->			

	<hr>		
	
    <table id="grid" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true">
        <thead>
            <tr>
                <th data-column-id="nome" data-type="string" data-identifier="true">Nome</th>
                <th data-column-id="login" data-type="string">Login</th>
                <th data-column-id="tipo" data-type="string">Tipo</th>
                <th data-column-id="ativo" data-type="string">Ativo</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false" style="width:6%"></th>
            </tr>
        </thead>
    </table>

  </div>
</div>´

<!-- Modal confirma Resetar Senha -->
<div class="modal fade" id="modal-confirmar-reset" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-confirmar-reset">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			Atenção!
			</div>
            <div class="modal-body text-center">
				<span>A senha será resetada para o padrão e um email será enviado ao usuário. Continuar?</span>
				<input type="hidden" id="co_pessoa">				
            </div>
            <div class="modal-footer">
                <button id="btn-confirmar-reset" type="button" class="btn btn-primary">Sim</button>
                <button id="btn-cancelar-reset" type="button" class="btn btn-default">Não</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$( "#btn-confirmar-reset" ).click(function() {
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  url: "services/usuarios/resetarSenha.php",
		  data: {co_pessoa: $("#co_pessoa").val() } 
		}).done(function( data ){
			mostrarAlertas(data.tipo,data.msg);
			$("#modal-confirmar-reset").modal('hide');
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
});

$( "#btn-cancelar-reset" ).click(function() {
	$("#co_pessoa").val( null );
	$("#modal-confirmar-reset").modal('hide');
});

var resetarSenhaUsuario = function(co_pessoa){
	$("#co_pessoa").val(co_pessoa);
	$("#modal-confirmar-reset").modal('show');
}

var grid = $("#grid").bootgrid({
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
    url: "services/usuarios/listarUsuarios.json.php",
    formatters: {
        "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-primary btn-xs btn-default editar\" data-row-co-pessoa=\"" + row.co_pessoa + "\"><span class=\"glyphicon glyphicon-pencil\"></span></button> " + 
                   "<button type=\"button\" class=\"btn btn-success btn-xs btn-default resetar\" data-row-co-pessoa=\"" + row.co_pessoa + "\"><span class=\"glyphicon glyphicon-repeat\"></span></button>";
        }
    }
}).on("loaded.rs.jquery.bootgrid", function(){
    /* Executes after data is loaded and rendered */
    grid.find(".editar").on("click", function(e) {
    	document.location.href="default.php?ido=<?php echo base64_encode("usuarios-manter")?>&co_pessoa=" + $(this).data("row-co-pessoa");
    }).end().find(".resetar").on("click", function(e) {        
    	resetarSenhaUsuario( $(this).data("row-co-pessoa") );
    });
});

$( "#btn-novo" ).click(function() {
	document.location.href='?ido=<?php echo base64_encode("usuarios-manter")?>';
});
</script>