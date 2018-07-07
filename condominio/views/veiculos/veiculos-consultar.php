<p></p>      
<div class="panel panel-default">
  <div class="panel-heading">
	<ol class="breadcrumb">
	  <li><a href="?ido=<?php echo base64_encode("inicio")?>">Início</a></li>
	  <li class="active">Consulta de veículos</li>
	</ol>
  </div>
  <div class="panel-body">		
	<table id="grid" class="table table-condensed table-hover table-striped">
        <thead>
            <tr>
                <th data-column-id="tipo"      data-type="string" data-sortable="true" data-width="10%">Tipo</th>
                <th data-column-id="veiculo"   data-type="string" data-sortable="true" data-width="23%">Veículo</th>
                <th data-column-id="placa"     data-type="string" data-sortable="false" data-width="20%">Placa</th>
                <th data-column-id="garagem"   data-type="string" data-sortable="true" data-width="13%">Garagem</th>
                <th data-column-id="torre"     data-type="string" data-sortable="true" data-width="13%">Torre</th>
                <th data-column-id="unidade"   data-type="string" data-sortable="true" data-width="13%">Unidade</th>
                <th data-column-id="commands"  data-formatter="commands" data-sortable="false" data-width="9%"></th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
/**
 * Função do grid
 */
var grid = $("#grid").bootgrid({
    ajax: true,
    post: function ()
    {
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },    
    url: "services/veiculos/listarVeiculos.json.php",
    formatters: {
        "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-primary btn-xs btn-default detalhar\" data-row-counidade=\"" + row.co_unidade + "\" data-row-unidade=\"" + row.unidade + "\" data-row-torre=\"" + row.torre + "\"><span class=\"glyphicon glyphicon-zoom-in\"></span></button> ";
        }
    }
}).on("loaded.rs.jquery.bootgrid", function(){
    grid.find(".detalhar").on("click", function(e) {
    	document.location.href="default.php?ido=<?php echo base64_encode("moradores-visualizar")?>&co_unidade=" + $(this).data("row-counidade") + "&nu_numero=" + $(this).data("row-unidade") + "&no_torre=" + $(this).data("row-torre");
    });
});
</script>