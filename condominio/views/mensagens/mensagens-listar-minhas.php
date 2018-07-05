<p></p>      
<div class="panel panel-default">
  <div class="panel-heading">
	<ol class="breadcrumb">
	  <li><a href="?ido=<?php echo base64_encode("inicio")?>">Início</a></li>
	  <li class="active">Minhas mensagens</li>
	</ol>
  </div>
  <div class="panel-body">
		<div class="row">
		  <div class="col-md-5">
		  	<input type="text" class="form-control" id="criterio" placeholder="Digite algo para busca">
		  </div>
		  <div class="col-md-5">
			<button class="btn btn-info" id="btn-buscar">Buscar</button>
			<button class="btn btn-warning" id="btn-reset">Limpar</button>
		  </div>
		  <div class="col-md-4"></div>
		  <input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>" >
		</div><!-- Fecha div row -->			
	<hr>		
	<div id="grid"></div>
  </div>
</div>
<script>
var paginacao = function(total, qtdRegPg, pagina, criterio, co_pessoa) {

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
            	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + menos + ",'" + criterio + "',"+co_pessoa+")\">anterior</a></li>";
            }

            // Listando as paginas
            for (var i=1;i<=pgs;i++) {
                if (i != pagina) {
                	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + i + ",'" + criterio + "',"+co_pessoa+")\">" + i + "</a></li>";
                } else {
                	paginacao += "<li class=\"disabled\"><a>" + i + "</a></li>";
                }
            }

            if (mais <= pgs) {
            	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + mais + ",'" + criterio + "',"+co_pessoa+")\">próxima</a></li>";
    		}
    	}
        paginacao += "</ul>";

    	return paginacao;
};

var montaResultadoTabela = function(result, header, divResultado, pagina, criterio, maximo, co_pessoa) {
	var total=0;
	var tabela = "<table class='table table-striped'>";
		tabela += "<tr>";
		$.each(header, function (key, val) {
			tabela += "<th>" + val + "</th>";
		});
		tabela += "</tr>";

	var i=1;
	$.each(result, function (key, val) {
		tabela += "<tr>";
		if(i>1){
			$.each(header, function (k, v) {
				tabela += "<td><a href='?ido=mensagens-visualizar&co_mensagem=" + val.co_mensagem + "'>" + val[v] + "</a></td>";
			});
			tabela += "</tr>";
		}else{
			total = val.total;
		}
		i++;
	});
	tabela += "</table>";
	
	tabela += paginacao(total, maximo, pagina, criterio, co_pessoa);
	
	$('#' + divResultado).html(tabela).fadeIn('slow');
};

var grid = function(maximo, pagina ,criterio, co_pessoa) {	
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,	  
	  url: "services/mensagens/listar-por-usuario.php",
	  data: { pagina: pagina, criterio: criterio, maximo: maximo, co_pessoa: co_pessoa }
	}).done(function( data ) {
		var header = ["Título", "Data hora", "Leitura"];
		montaResultadoTabela(data, header, "grid", pagina, criterio, maximo, co_pessoa);
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; grid(10, null, null, $('#co_pessoa_registro').val());


	$( "#btn-buscar" ).click(function() {
	  grid(10,null,$("#criterio").val(),$('#co_pessoa_registro').val());
	});
	$( "#criterio" ).keypress(function(e) {
	  if(e.which == 13) {
		grid(10,null,$("#criterio").val(),$('#co_pessoa_registro').val());
	  }
	});
	$( "#btn-reset" ).click(function() {
	  grid(10,null,null,$('#co_pessoa_registro').val());
	  $("#appendedInputButtons").val('');
	});
	$( "#btn-novo" ).click(function() {
		document.location.href='?ido=mensagens-manter';
	});
</script>