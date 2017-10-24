<p></p>      
<div class="panel panel-default">
  <div class="panel-heading">
	<ol class="breadcrumb">
	  <li><a href="?ido=inicio">Início</a></li>
	  <li class="active">Consulta de veículos</li>
	</ol>
  </div>
  <div class="panel-body">

		<div class="form-inline">
		  <div class="form-group">
		    <input type="text" class="form-control placa" style="text-transform:uppercase" placeholder="Placa" id="ds_placa">
		  </div>
		  <div class="form-group">
			<input type="text" class="form-control" id="no_modelo_veiculo" placeholder="Nome/modelo">
			<input type="hidden" id="co_modelo_veiculo">
		  </div>
		  <button class="btn btn-info" id="btn-buscar">Buscar</button>
		  <button class="btn btn-warning" id="btn-reset">Limpar</button>
		</div>		
				
	<hr>		
	<div id="grid"></div>
  </div>
</div>

<script>
var paginacao = function(total, qtdRegPg, pagina, ds_placa, co_modelo_veiculo) {

	pagina = (pagina > 0) ? pagina : 1;
    var menos = pagina - 1;
    var mais = pagina + 1;
    var divisao = total/qtdRegPg;
    var pgs = Math.ceil(divisao);
    
    var paginacao = "<ul class='pagination'>"; 
    	paginacao += ""; 
        if (pgs > 1) {

            // Mostragem de pagina
            if (menos > 0) {
            	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + menos + ",'" + ds_placa+ "','" + co_modelo_veiculo + "')\">anterior</a></li>";
            }

            // Listando as paginas
            for (var i=1;i<=pgs;i++) {
                if (i != pagina) {
                	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + i + ",'" + ds_placa+ "','" + co_modelo_veiculo + "')\">" + i + "</a></li>";
                } else {
                	paginacao += "<li class=\"disabled\"><a>" + i + "</a></li>";
                }
            }

            if (mais <= pgs) {
            	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + mais + ",'" + ds_placa+ "','" + co_modelo_veiculo + "')\">próxima</a></li>";
    		}
    	}
        paginacao += "</ul>";

    	return paginacao;
};

var montaResultadoTabela = function(result, header, divResultado, pagina, ds_placa, co_modelo_veiculo, maximo) {
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
		if(i>1){
			$.each(header, function (k, v) {
				tabela += "<td>" + val[v] + "</td>";
			});
			tabela += "<td>";
			tabela += "<a class='btn btn-primary btn-sm' title='Detalhar' href='default.php?ido=moradores-visualizar&co_unidade="+val.co_unidade+"&nu_numero="+val.nu_numero+"&no_torre="+val.co_torre+"'><i class='glyphicon glyphicon-zoom-in'></i></a>";
			tabela += "</td>";
			tabela += "</tr>";
		}else{
			total = val.total;
		}
		i++;
	});
	tabela += "</table>";
	
	tabela += paginacao(total, maximo, pagina, ds_placa, co_modelo_veiculo);
	
	$('#' + divResultado).html(tabela).fadeIn('slow');
};

var grid = function(maximo, pagina, ds_placa, co_modelo_veiculo) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,	  
	  url: "services/veiculos/listar.php",
	  data: { maximo: maximo, pagina: pagina, ds_placa: ds_placa, co_modelo_veiculo: co_modelo_veiculo }
	}).done(function( data ) {
		var header = ["Tipo", "Veículo", "Placa", "Garagem"];
		montaResultadoTabela(data, header, "grid", pagina, ds_placa, co_modelo_veiculo, maximo);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; grid(10, null, $("#ds_placa").val(), $("#co_modelo_veiculo").val());


$( "#btn-buscar" ).click(function() {
  grid(10, null, $("#ds_placa").val(), $("#co_modelo_veiculo").val());
});
$( "#ds_placa" ).keypress(function(e) {
  if(e.which == 13) {
  	grid(10, null, $("#ds_placa").val(), $("#co_modelo_veiculo").val());
  }
});
$( "#no_modelo_veiculo" ).keypress(function(e) {
	  if(e.which == 13) {
	  	grid(10, null, $("#ds_placa").val(), $("#co_modelo_veiculo").val());
	  }
});	
$( "#btn-reset" ).click(function() {
	$("#no_modelo_veiculo").val(null);
	$("#co_modelo_veiculo").val(null);
	$("#ds_placa").val(null);
	grid(10, null, $("#ds_placa").val(), $("#co_modelo_veiculo").val());
});	

$( "#no_modelo_veiculo" ).focus(function() {
	$("#ds_placa").val(null);
});
$( "#ds_placa" ).focus(function() {
	$("#no_modelo_veiculo").val(null);
	$("#co_modelo_veiculo").val(null);
});
var options = {
		url: function(phrase) {
			return "services/veiculos/listarVeiculoModeloAutoComplete.php?no_modelo_veiculo=" + phrase + "&format=json";
		},
		getValue: "no_modelo_veiculo",
		adjustWidth:false,
		list: {

			onSelectItemEvent: function() {
				var co_modelo_veiculo = $("#no_modelo_veiculo").getSelectedItemData().co_modelo_veiculo;

				$("#co_modelo_veiculo").val(co_modelo_veiculo).trigger("change");
			}
		}		
	};
$("#no_modelo_veiculo").easyAutocomplete(options);	
</script>