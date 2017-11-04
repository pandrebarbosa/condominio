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
	  <li><a href="?ido=monitoramento-emails">Alertas de emails</a></li>
	  <li class="active">Manter</li>
	</ol>
  </div>
  <div class="panel-body">
  
  <div class="alert alert-info" role="alert">
  Dados da Unidade</div>
  
	<div class="row">
    	<div class="col-md-12">
			<form role="form" name="frm-notificacao" id="frm-notificacao">

                <table class="table table-bordered" id="resultado">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Receber email</th>
                            <th style="width: 50%;">Email</th>
                        </tr>
                    </thead>                                                                                  
                </table>

				<p></p>
				<div class="panel-footer text-right">
					<button type="button" class="btn btn-default">Voltar</button>
					<input type="hidden" id="co_pessoa_registro" value="<?php echo $_SESSION['credencial']['co_pessoa']?>" >
				</div>
				<!-- Fim div panel-footer -->
			</form>
        </div><!-- Fim da col-md-12 -->
	        
	</div><!-- Fim da row -->

  </div> <!-- Fim panel-body -->
</div>

<script>
var alternaGravacaoNotificacao = function(data,co_pessoa,co_unidade){
	$.ajax({
		  type: "POST",
		  dataType: "json",
		  loading: true,
		  url: "services/emails/gravarAutorizacaoNotificacao.php",
		  data: { co_pessoa: co_pessoa, co_unidade: co_unidade, st_autorizado:data.checked, co_pessoa_registro: $("#co_pessoa_registro").val()  }
		}).done(function( data ){
			loading(false);
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
			loading(false);
	    });
}

var carregaListaMoradores = function(co_unidade) {
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  loading: true,
	  url: "services/contatos/listarContatosPorUnidade.json.php",
	  data: { co_unidade: co_unidade }
	}).done(function( data ){
		montaResultadoTabela(data, "resultado");
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
		loading(false);
    });
};
carregaListaMoradores( myParam.co_unidade );


var montaResultadoTabela = function(result, divResultado) {
	var tabela = "";
	$.each(result, function (key, val) {
		tabela += "<tr>";
			tabela += "<td>";
    			tabela += "<label class=\"switch switch-primary\">";
    			tabela += "<input type=\"checkbox\" "+ (val.st_autorizado != null ? "checked=\"\"" : "") +" onClick=\"javascript:alternaGravacaoNotificacao(this,"+val.co_pessoa+","+val.co_unidade+");\">";
    			tabela += "<span class=\"switch\"></span>";
    			tabela += "</label>";
			tabela += "</td>";
			tabela += "<td>"+val.ds_contato+"</td>";
		tabela += "</tr>";
	});
	
	$('#' + divResultado).append(tabela).fadeIn('slow');
};


</script>