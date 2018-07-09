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
	  <li class="active">Listagem Completa de Unidades</li>
	</ol>
  </div>
  <div class="panel-body">		
    <table id="grid" class="table table-condensed table-hover table-striped">
        <thead>
            <tr>
                <th data-column-id="co_unidade" data-type="string" data-visible="false">unidade</th>
                <th data-column-id="nu_numero"  data-type="string" data-visible="false">numero</th>
                <th data-column-id="no_torre"   data-type="string" data-visible="false">torre</th>
                <th data-column-id="tipo"       data-type="string" data-width="10%">Tipo</th>
                <th data-column-id="morador"    data-type="string" data-width="27%">Morador</th>
                <th data-column-id="unidade"    data-type="string" data-width="17%">Unidade</th>
                <th data-column-id="commands"   data-formatter="commands" data-sortable="false" data-width="10%"></th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
var grid = $("#grid").bootgrid({
    ajax: true,
    post: function ()
    {
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },    
    url: "services/unidades/listarCompletaUnidades.json.php",
    formatters: {
        "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-primary btn-xs btn-default detalhar\" data-row-coUnidade=\"" + row.co_unidade + "\" data-row-nuNumero=\"" + row.nu_numero + "\" data-row-noTorre=\"" + row.no_torre + "\"><span class=\"glyphicon glyphicon-zoom-in\"></span></button> ";
        }
    }
}).on("loaded.rs.jquery.bootgrid", function(){
    grid.find(".detalhar").on("click", function(e) {
    	document.location.href='default.php?ido=<?php echo base64_encode("abrir-ficha-unidade")?>&co_unidade=' + $(this).data("row-counidade") + '&nu_numero=' + $(this).data("row-nunumero") + '&no_torre=' + $(this).data("row-notorre");
    });
});
</script>