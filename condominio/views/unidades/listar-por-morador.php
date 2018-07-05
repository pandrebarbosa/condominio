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
	  <li class="active">Listagem</li>
	</ol>
  </div>
  <div class="panel-body">
		<div class="row">
		  <div class="col-md-2">
			<select id="co_tipo_unidade" name="co_tipo_unidade" class="form-control">
			<?php
			$res_tacesso = $banco->seleciona ( "tb_tipo_unidade", "*", NULL, NULL, "no_tipo_unidade ASC", NULL, FALSE );
			if (is_array ( $res_tacesso )) {
				foreach ( $res_tacesso as $acesso ) {?>
			  <option value="<?php echo $acesso['co_tipo_unidade'] ?>" id="co_tipo_unidade<?php echo $acesso['co_tipo_unidade'] ?>"><?php echo $acesso['no_tipo_unidade'] ?></option>
			<?php } } ?>
			</select>		  	
		  </div>		
		  <div class="col-md-5">
		  	<input type="text" class="form-control" id="criterio" placeholder="Digite nome do morador ou o numero da unidade">
		  </div>
		  <div class="col-md-5">
				<button class="btn btn-info" id="btn-buscar">Buscar</button>
				<button class="btn btn-warning" id="btn-reset">Limpar</button>	  
		  </div>
		  <div class="col-md-4"></div>

		</div><!-- Fecha div row -->			
	<hr>		
	<div id="grid"></div>
  </div>
</div>

<script>
var paginacao = function(total, qtdRegPg, pagina, criterio, tipo_unidade) {

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
            	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + menos + ",'" + criterio + "'," + tipo_unidade + ")\">anterior</a></li>";
            }

            // Listando as paginas
            for (var i=1;i<=pgs;i++) {
                if (i != pagina) {
                	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + i + ",'" + criterio + "'," + tipo_unidade + ")\">" + i + "</a></li>";
                } else {
                	paginacao += "<li class=\"disabled\"><a>" + i + "</a></li>";
                }
            }

            if (mais <= pgs) {
            	paginacao += "<li class=\"active\"><a style=\"cursor: pointer;\" href=\"javascript:grid("+qtdRegPg+"," + mais + ",'" + criterio + "'," + tipo_unidade + ")\">próxima</a></li>";
    		}
    	}
        paginacao += "</ul>";

    	return paginacao;
};

var montaResultadoTabela = function(result, header, divResultado, pagina, criterio, maximo, tipo_unidade) {
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
			tabela += "<a class='btn btn-primary btn-sm' title='Detalhar' href='default.php?ido=<?php echo base64_encode("abrir-ficha-unidade")?>&co_unidade=" + val.co_unidade + "&nu_numero=" + val.nu_numero + "&no_torre=" + val.no_torre + "'><i class='glyphicon glyphicon-pencil'></i></a>";
			tabela += "</td>";
			tabela += "</tr>";
		}else{
			total = val.total;
		}
		i++;
	});
	tabela += "</table>";
	
	tabela += paginacao(total, maximo, pagina, criterio, tipo_unidade);
	
	$('#' + divResultado).html(tabela).fadeIn('slow');
};

var grid = function(maximo, pagina , criterio, co_tipo_unidade) {		
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/unidades/listar.php",
	  data: { maximo: maximo, pagina: pagina, criterio: criterio, co_tipo_unidade:co_tipo_unidade }
	}).done(function( data ) {
		if(data != null){
			if(co_tipo_unidade == 1 || co_tipo_unidade == 4) {
				var header = ["Tipo", "Morador", "Unidade"];
			}else{
				var header = ["Tipo", "Unidade"];
			}
			montaResultadoTabela(data, header, "grid", pagina, criterio, maximo, co_tipo_unidade);
		}else{
			mostrarAlertas("erro","A Pesquisa não retornou resultados.");
			grid(10, null, null, 1);
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
}; grid(10, null, null, 1);


$( "#btn-buscar" ).click(function() {
  grid(10, null, $("#criterio").val(), $("#co_tipo_unidade").val());
});
$( "#criterio" ).keypress(function(e) {
  if(e.which == 13) {
	grid(10, null, $("#criterio").val(), $("#co_tipo_unidade").val());
  }
});

$( "#co_tipo_unidade" ).change(function() {
	grid(10, null, $("#criterio").val(), $("#co_tipo_unidade").val());
});	

$( "#btn-reset" ).click(function() {
	grid(10, null, null, 1);
  $("#appendedInputButtons").val('');
  $( "#criterio" ).val(null);
});
</script>