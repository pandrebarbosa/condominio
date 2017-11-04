<?php
include('services/lib/inicializa.php');
$banco = new banco();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="googlebot" content="noindex" />
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="favicon.ico">

    <title>Condomínio San Raphael</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap-3.3.6-dist/extend/css/jasny-bootstrap.min.css" rel="stylesheet">    

    <!-- Custom styles for this template -->
    <link href="bootstrap-3.3.6-dist/css/justified-nav.css" rel="stylesheet">
    <link href="bootstrap-3.3.6-dist/ui/jquery-ui-bootstrap/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/workaround/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    
    <!-- Outros estilos do sistema -->
    <link href="css/estilo-geral.css" rel="stylesheet">
    
    <link href="css/estiloBotaoSwitch.css" rel="stylesheet">
    
    <!-- Estilo do BSCallout -->
    <link href="css/bs-callout.css" rel="stylesheet"> 

    <script src="assets/workaround/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    <script src="bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.6-dist/extend/js/jasny-bootstrap.min.js"></script>
    <script src="assets/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
    
    <script src="bootstrap-3.3.6-dist/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
    <link href="bootstrap-3.3.6-dist/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css" rel="stylesheet">
    
    <script src="bootstrap-3.3.6-dist/jQuery-Picture-Cut-master/src/jquery.picture.cut.js"></script>

	<script type="text/javascript" src="bootstrap-3.3.6-dist/bootstrap-datetimepicker-master/build/js/moment.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.6-dist/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js"></script>
	<link rel="stylesheet" href="bootstrap-3.3.6-dist/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css" />

	<!-- Autocomplete JS file -->
	<script src="assets/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script> 
	<!-- Autocomplete CSS file -->
	<link rel="stylesheet" href="assets/EasyAutocomplete-1.3.5/easy-autocomplete.min.css">
	
	<!-- MaxLenth do Textarea -->
	<link rel="stylesheet" type="text/css" href="assets/limit-textarea/jquery.maxlength.css"> 
	<script type="text/javascript" src="assets/limit-textarea/jquery.plugin.js"></script> 
	<script type="text/javascript" src="assets/limit-textarea/jquery.maxlength.js"></script>

	<!-- WYSIWYG -->
	<script type="text/javascript" src="assets/bootstrap3-wysihtml5-bower-master/dist/bootstrap3-wysihtml5.all.min.js"></script> 
	<script type="text/javascript" src="assets/bootstrap3-wysihtml5-bower-master/dist/bootstrap3-wysihtml5.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3-wysihtml5-bower-master/dist/bootstrap3-wysihtml5.min.css">
	
	<!-- BOOTGRID -->
	<script type="text/javascript" src="assets/bootgrid/jquery.bootgrid.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="assets/bootgrid/jquery.bootgrid.min.css"> 	
	
	<!-- CROPIT -->
	<link rel="stylesheet" href="css/cropit.css">
	<script type="text/javascript" src="assets/cropit-master/dist/jquery.cropit.js"></script>

	<!-- TOOLTIP -->
	<link rel="stylesheet" type="text/css" href="assets/tooltipster-master/dist/css/tooltipster.bundle.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/tooltipster-master/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css" />
	<script type="text/javascript" src="assets/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>
	
	<link href="css/tabs-novos.css" rel="stylesheet">
	<link href="css/input-file.css" rel="stylesheet">
	<link href="css/side-menu.css" rel="stylesheet">
	
	<!-- Font do logo -->
	<link href="https://fonts.googleapis.com/css?family=Allura" rel="stylesheet"> 

    <script src="js/loading.js"></script>	
	<script src="js/messages.js"></script>
	<script src="js/urlQuery.js"></script>
	<script src="js/side-menu.js"></script>
	
	<!-- INICIALIZAÇÃO DE ALGUNS JS, MASK, DATEPICKER -->
	<script src="js/inicializacao.js"></script>

  </head>

  <body class="fundo-logo">

	<!-- Modal de LOADING -->
	<div class="modal fade" id="loading" tabindex="1000" data-backdrop="static" role="dialog" aria-labelledby="loading" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-body">
			<div class="progress progress-striped active">
			  <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				<span>Carregando...</span>
			  </div>
			</div>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal de LOADING -->
	
	<!-- Modal HELP -->
	<div class="modal fade bs-example-modal-lg" id="modal-ajuda" tabindex="-1" role="dialog"  aria-labelledby="modal-ajuda">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-body text-center">
					<img src="" id="img-ajuda" class="img-responsive">			
	            </div>
	            <div class="modal-footer">
	                  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Fechar</button>
	            </div>
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	


	<div class="row">
    <!-- Menu -->
	<?php include("menu/menu-lateral.php") ?>
    
	<?php $ido = isset($_REQUEST['ido']) ? $_REQUEST['ido'] : ''; ?> 

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
           <?php include("controller.php") ?>
        </div>
    </div>
</div>
    
    
  </body>
</html>