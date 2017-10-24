<p></p>      
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
		  	<input type="text" class="form-control" id="criterio" placeholder="Digite nome ou login do usuário">
		  </div>
		  <div class="col-md-5">
				<button class="btn btn-info" id="btn-buscar">Buscar</button>
				<button class="btn btn-warning" id="btn-reset">Limpar</button>
				<button class="btn btn-primary" id="btn-novo">Nova mensagem</button>		
		  </div>
		  <div class="col-md-4"></div>

		</div><!-- Fecha div row -->			

	<hr>		
	
	<div id="grid"></div>

  </div>
</div>
<script>
var paginacao = function(total, qtdRegPg, pagina, criterio) {

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
            	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + menos + ",'" + criterio + "')\">anterior</a></li>";
            }

            // Listando as paginas
            for (var i=1;i<=pgs;i++) {
                if (i != pagina) {
                	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + i + ",'" + criterio + "')\">" + i + "</a></li>";
                } else {
                	paginacao += "<li class=\"disabled\"><a>" + i + "</a></li>";
                }
            }

            if (mais <= pgs) {
            	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + mais + ",'" + criterio + "')\">próxima</a></li>";
    		}
    	}
        paginacao += "</ul>";

    	return paginacao;
};

var montaResultadoTabela = function(result, header, divResultado, pagina, criterio, maximo) {
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
			tabela += "<a class='btn btn-primary btn-sm' title='Detalhar' href='default.php?ido=mensagens-manter&co_mensagem="+val.co_mensagem+"'><i class='glyphicon glyphicon-pencil'></i></a>";
			tabela += "</td>";
			tabela += "</tr>";
		}else{
			total = val.total;
		}
		i++;
	});
	tabela += "</table>";
	
	tabela += paginacao(total, maximo, pagina, criterio);
	
	$('#' + divResultado).html(tabela).fadeIn('slow');
};

var grid = function(maximo, pagina ,criterio) {	
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,	  
	  url: "services/mensagens/listar.php",
	  data: { pagina: pagina, criterio: criterio, maximo: maximo }
	}).done(function( data ) {
		var header = ["Título", "Data hora"];
		montaResultadoTabela(data, header, "grid", pagina, criterio, maximo);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; grid(10, null, null);


	$( "#btn-buscar" ).click(function() {
	  grid(10,null,$("#criterio").val());
	});
	$( "#criterio" ).keypress(function(e) {
	  if(e.which == 13) {
		grid(10,null,$("#criterio").val());
	  }
	});
	$( "#btn-reset" ).click(function() {
	  grid(10,null,null);
	  $("#appendedInputButtons").val('');
	});
	$( "#btn-novo" ).click(function() {
		document.location.href='?ido=mensagens-manter';
	});
</script>