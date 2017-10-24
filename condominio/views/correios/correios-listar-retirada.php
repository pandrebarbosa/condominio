<p></p>
<!--Alertas-->
<div class="alert alert-dismissable" style="display: none;" id="alertas">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
	<strong>Atenção!</strong>
</div>
<!--/Alertas--> 
<p></p>      
<div class="panel panel-default">
  <div class="panel-heading">
	<ol class="breadcrumb">
	  <li><a href="?ido=inicio">Início</a></li>
	  <li class="active">Lista de correspondências para retirada</li>
	</ol>
  </div>
  <div class="panel-body">	
  
    <table id="grid" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true">
        <thead>
            <tr>
                <th data-column-id="item" data-type="string" data-identifier="true">Item</th>
                <th data-column-id="unidade" data-type="string">Unidade</th>
                <th data-column-id="recebedor" data-type="string">Recebedor</th>
                <th data-column-id="chegada" data-type="string" data-order="desc">Chegada</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false" style="width:6%"></th>
            </tr>
        </thead>
    </table>

  </div>
</div>
<!-- Modal confirma CPF -->
<div class="modal fade" id="modal-confirmar-impressao" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-confirmar-impressao">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			Imprimir comprovante
			</div>
            <div class="modal-body text-center" id="iframeCorreio">
								
            </div>
            <div class="modal-footer">
                  <button id="btn-fechar-modal-impressao" class="btn btn-default" aria-hidden="true">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal confirma CPF -->
<div class="modal fade" id="modal-confirmar-exclusao" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-confirmar-exclusao">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			Excluir
			</div>
            <div class="modal-body text-center">
				Deseja excluir esta correspondência?
            </div>
            <div class="modal-footer">
            <input type="hidden" id="co_item_correio_excluir">
                  <button id="btn-excluir" class="btn btn-default">Confirmar</button>
                  <button id="btn-cancelar" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var abreModalImpressao = function(id) {
	//var html = '<iframe src="http://www.condominiosanraphael.com.br/condominio/views/correios/impressao.html?co_item_correio=' + id+'" id="iframeCorreio" width="100%" frameBorder="0" scrolling="no"></iframe>';
	var html = '<iframe src="http://localhost/condominiosanraphael/condominio/views/correios/impressao.html?co_item_correio=' + id+'" id="iframeCorreio" width="100%" frameBorder="0" scrolling="no"></iframe>';
	$('#iframeCorreio').html(html);
	$('#modal-confirmar-impressao').modal('show');	
};

$( "#btn-fechar-modal-impressao" ).click(function() {
	$('#iframeCorreio').html(null);
	$('#modal-confirmar-impressao').modal('hide');	
});


var abreModalExclusao = function(id) {
	$('#co_item_correio_excluir').val(id);
	$('#modal-confirmar-exclusao').modal('show');	
};
$( "#btn-excluir" ).click(function() {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,	  
	  url: "services/correios/excluir.php",
	  data: { co_item_correio: $('#co_item_correio_excluir').val() }
	}).done(function( data ) {
		$('#co_item_correio_excluir').val(null);
		grid(10, null, null);
		$('#modal-confirmar-exclusao').modal('hide');
		mostrarAlertas(data.tipo,data.msg);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
});
$( "#btn-cancelar" ).click(function() {
	$('#co_item_correio_excluir').val(null);
});

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
    url: "services/correios/listarRetirada.php",
    formatters: {
        "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-success btn-xs btn-default retirar\" data-row-id=\"" + row.co_item_correio + "\"><span class=\"glyphicon glyphicon-export\"></span></button> ";
        }
    }
}).on("loaded.rs.jquery.bootgrid", function(){
    /* Executes after data is loaded and rendered */
    grid.find(".retirar").on("click", function(e) {
    	document.location.href="default.php?ido=correios-retirada&co_item_correio=" + $(this).data("row-id");
    });
});

$( "#btn-novo" ).click(function() {
	document.location.href='?ido=correios-entrada';
});
</script>