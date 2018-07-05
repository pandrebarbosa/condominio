<!-- Conteúdo da aba inicio  -->
<div class="row">
	<div class="col-md-4">
		<h3>Mensagens</h3>
		<ul id="lista-mensagens">
		</ul>
	</div>

	<div class="col-md-4">
		<h3>
			Caixa de correio <span class="glyphicon glyphicon-envelope"></span>
		</h3>
		<div class="alert alert-warning hide" role="alert" id="gridCorreio"></div>
		<hr />
		<div class="checkbox">
			<label>
			<input type="checkbox" id="receber-email_correio">
			<span id="texto-mensagem-check"></span>
			<span id="aviso-polegar" class="glyphicon"></span>
			</label>
			<input type="hidden" value="<?php echo $_SESSION['credencial']['co_unidade']?>" id="co_unidade">
			<input type="hidden" value="<?php echo $_SESSION['credencial']['co_pessoa'] ?>" id="co_pessoa_registro">
		</div>
	</div>
	
	<div class="col-md-4 text-center">
		<h3>Funcionários</h3>
		<a href="?ido=<?php echo base64_encode("funcionarios-conhecer")?>"><img src="img/group.png" />
		<p>Conheça os funcionários do nosso condomínio.</p></a>
	</div>
</div>
<!-- Conteúdo da aba inicio -->
<script>
	  function gridChegouCorrespondencia(){		
			$.ajax({
			  type: "POST",
			  dataType: "json",
			  loading: true,	  
			  url: "services/correios/listarCorreioDisponivelPorUnidade.json.php",
			  data: {co_unidade: $("#co_unidade").val()}
			}).done(function( data ) {
				if(data===true){
					$("#gridCorreio").removeClass("hide");
					$("#gridCorreio").html("Você possui uma nova correspondência!");
				}
			}).fail(function(jqXHR, textStatus, errorThrown) {
				alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
				loading(false);
		    });
		}//gridChegouCorrespondencia();
		
	  function gridMensagens(co_pessoa_registro){
		  var i=0;		
			$.ajax({
			  type: "POST",
			  dataType: "json",
			  loading: true,	  
			  url: "services/mensagens/listar-por-usuario.php",
			  data: {co_pessoa: co_pessoa_registro, criterio: null, maximo: 5 }
			}).done(function( data ) {
				$.each(data, function (k, v) {
					if(i>0 && i <=5){
						$('#lista-mensagens').append("<li><a href='?ido=mensagens-visualizar&co_mensagem=" + v.co_mensagem + "'>" + v.ds_titulo + " - <small>" + v.dt_hr_registro + "</small></a></li>");
					}
					i++;
				});
			}).fail(function(jqXHR, textStatus, errorThrown) {
				alert( "Erro: " + textStatus + "\n" + jqXHR.responseText );
				loading(false);
		    });
		}gridMensagens($("#co_pessoa_registro").val());
	</script>