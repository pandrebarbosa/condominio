<p></p>      
<div class="panel panel-default">
	<div class="panel-heading">
		<ol class="breadcrumb">
			<li><a href="?ido=inicio">Início</a></li>
			<li class="active">Moradores</li>
		</ol>
	</div>
	<div class="panel-body">

		<div class="row">

			<div class="col-md-5">
				<input type="text" class="form-control" id="criterio" placeholder="Digite o nome do morador">
			</div>
			<div class="col-md-7">
				<button class="btn btn-info" id="btn-buscar">Buscar</button>
				<button class="btn btn-warning" id="btn-reset">Limpar</button>
			</div>
			<div class="col-md-4"></div>

		</div>
		<hr>
        <table id="grid" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true">
            <thead>
                <tr>
                    <th data-column-id="co_unidade" data-type=numeric data-identifier="true" data-visible="false"></th>
                    <th data-column-id="co_torre" data-type="numeric" data-identifier="true" data-visible="false"></th>
                    <th data-column-id="nu_numero" data-type="numeric" data-identifier="true" data-visible="false"></th>
                    <th data-column-id="co_pessoa" data-type="numeric" data-identifier="true" data-visible="false"></th>
                    <th data-column-id="unidade" data-type="string" data-order="asc">Torre / Unidade</th>
                    <th data-column-id="morador" data-type="string" data-order="asc">Morador</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false" style="width:6%"></th>
                </tr>
            </thead>
        </table>
	</div>
</div>
<script>

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
    url: "services/moradores/listar.json.php",
    formatters: {
        "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-primary btn-xs btn-default morador\" data-row-unidade=\"" + row.co_unidade + "\" data-row-torre=\"" + row.co_torre + "\" data-row-numero=\"" + row.nu_numero + "\"><span class=\"glyphicon glyphicon-zoom-in\"></span></button>";
        }
    }
}).on("loaded.rs.jquery.bootgrid", function(){
    grid.find(".morador").on("click", function(e) {
    	document.location.href="default.php?ido=moradores-visualizar&co_unidade="+$(this).data("row-unidade")+"&nu_numero="+$(this).data("row-numero")+"&no_torre="+$(this).data("row-torre");
    });
});


</script>