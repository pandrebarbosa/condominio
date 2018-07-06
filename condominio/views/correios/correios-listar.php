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
	  <li><a href="?ido=<?php echo base64_encode("inicio")?>">Início</a></li>
	  <li class="active">Listagem geral de correspondências</li>
	</ol>
  </div>
  <div class="panel-body">
		<div class="row">
		  <div class="col-sm-7 col-md-6 col-lg-6">
				<button class="btn btn-primary" id="btn-novo">Registrar entrada</button>
				<button class="btn btn-warning" id="btn-retirada">Retirada pelo Morador</button>		
		  </div>
		</div><!-- Fecha div row -->			

	<hr>		
	
    <table id="grid" class="table table-condensed table-hover table-striped">
        <thead>
            <tr>
                <th data-column-id="id"        data-type="numeric" data-identifier="true" style="width:6%">Id</th>
                <th data-column-id="item"      data-type="string">Item</th>
                <th data-column-id="unidade"   data-type="string">Unidade</th>
                <th data-column-id="recebedor" data-type="string">Recebedor</th>
                <th data-column-id="chegada"   data-type="string" data-order="desc">Chegada</th>
                <th data-column-id="retirada"  data-type="string">Retirada</th>
                <th data-column-id="commands"  data-formatter="commands" data-sortable="false" style="width:6%"></th>
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
            <div class="modal-body text-center" id="iframeCorreio"></div>
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
				Deseja excluir esta correspondência? Cód:<span id="id-mensagem-correio"></span>
            </div>
            <div class="modal-footer">
            <input type="hidden" id="co_item_correio_excluir">
                  <button id="btn-excluir" class="btn btn-default">Confirmar</button>
                  <button id="btn-cancelar" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal confirma senha Usuario -->
<div class="modal fade" id="modal-confirmar-retirada" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-confirmar-retirada">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header text-center">
				<b>O Morador está retirando <span>4</span> correspondências.</b>
			</div>
            <div class="modal-body text-center">
        		<div class="row">
        			<div class="col-md-6">
        				Digite os 4 últimos digitos de seu CPF: <br />
        				<input type="password" maxlength="4" class="form-control" id="ultimos_digitos_cpf" />       				
        			</div>										
        		</div>	
            </div>
            <div class="modal-footer">
                  <button id="btn-retirar" class="btn btn-default">Confirmar</button>
                  <button id="btn-cancelar" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var abreModalImpressao = function(id) {
    varWindow = window.open (
    "http://<?php echo $_SESSION['credencial']['ambiente']=="DEV" ? "localhost/condominiosanraphael" : "www.condominiosanraphael.com.br" ?>/condominio/views/correios/impressao.html?co_item_correio="+id,
    'Impressão',
    "width=100, height=50, top=100, left=400, scrollbars=no" );
};

$( "#btn-fechar-modal-impressao" ).click(function() {
	$('#iframeCorreio').html(null);
	$('#modal-confirmar-impressao').modal('hide');	
});

$( "#btn-retirada" ).click(function() {
	$('#modal-confirmar-retirada').modal('show');	
});


var abreModalExclusao = function(id) {
	$('#co_item_correio_excluir').val(id);
	$('#id-mensagem-correio').html(id);
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
		$('#id-mensagem-correio').html('');
		$('#modal-confirmar-exclusao').modal('hide');
		mostrarAlertas(data.tipo,data.msg);
		$("#grid").bootgrid("reload");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
});

$( "#btn-cancelar" ).click(function() {
	$('#co_item_correio_excluir').val(null);
});

var rowIds = [];
var grid = $("#grid").bootgrid({
    ajax: true,
    post: function ()
    {
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },    
    url: "services/correios/listarCorrespondencias.json.php",
    selection: true,
    multiSelect: true,
    rowSelect: true,
    keepSelection: true,
    formatters: {
        "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-primary btn-xs btn-default imprimir\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-print\"></span></button> " + 
                   "<button type=\"button\" class=\"btn btn-success btn-xs btn-default retirar\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-export\"></span></button> " + 
                   "<button type=\"button\" class=\"btn btn-danger btn-xs btn-default excluir\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
        }
    }
}).on("selected.rs.jquery.bootgrid", function(e, rows)
{
    for (var i = 0; i < rows.length; i++)
    {
        if(rowIds.indexOf(rows[i].id)){
        	rowIds.push(rows[i].id);
        }
    }
	console.log(rowIds);
}).on("deselected.rs.jquery.bootgrid", function(e, rows)
{
    for (var i = 0; i < rows.length; i++)
    {
    	rowIds.splice(rows[i].id, 1);
    }
    console.log(rowIds);
}).on("loaded.rs.jquery.bootgrid", function(){
    /* Executes after data is loaded and rendered */
    grid.find(".imprimir").on("click", function(e) {
    	abreModalImpressao($(this).data("row-id"));
    }).end().find(".retirar").on("click", function(e) {
    	document.location.href="default.php?ido=<?php echo base64_encode("correios-retirada")?>&co_item_correio=" + $(this).data("row-id");
    }).end().find(".excluir").on("click", function(e) {
    	abreModalExclusao($(this).data("row-id"));
    });
});

$( "#btn-novo" ).click(function() {
	 document.location.href='?ido=<?php echo base64_encode("correios-entrada")?>';
});
</script>