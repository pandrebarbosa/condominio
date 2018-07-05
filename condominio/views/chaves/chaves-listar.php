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
	  <li class="active">Lista de Chaves</li>
	</ol>
  </div>
  <div class="panel-body">	
  
    <table id="grid" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true">
        <thead>
            <tr>
                <th data-column-id="unidade" data-type="string" data-identifier="true">Unidade</th>
                <th data-column-id="numero-chave" data-type="string">Numero da Chave</th>
            </tr>
        </thead>
    </table>

  </div>
</div>

<script>
var grid = $("#grid").bootgrid({
    ajax: true,   
    url: "services/chaves/chaves-lista.json"
});
</script>