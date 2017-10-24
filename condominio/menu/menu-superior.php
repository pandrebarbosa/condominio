<!-- Static navbar -->
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="?ido=inicio" style="font-family: 'Allura', cursive; font-size: 30px;">San Raphael</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		
			<ul class="nav navbar-nav navbar-right">
			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuSys)) {?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">SYS <span class="caret"></span></a>
					<ul class="dropdown-menu">
	                  	<li class="dropdown-header">Controller</li>
						<li><a href="?ido=controller-listar">Cadastrar</a></li>
						<li><a href="?ido=controller-vincular">Vincular</a></li>
						<li role="separator" class="divider"></li>
	                  	<li class="dropdown-header">Tipos de usuários</li>
						<li><a href="?ido=tipos-usuarios-listar">Manter</a></li>
					</ul>
				</li>
			<?php }?>			
			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuAdmin)) {?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Admin <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="dropdown-header">Cadastro de Pessoas</li>					
						<li><a href="?ido=usuarios-listar">Usuários</a></li>
						<li><a href="?ido=funcionarios-listar">Funcionários</a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Cadastro de unidades</li>
						<li><a href="?ido=unidades-listar">Unidades</a></li>
						<li><a href="?ido=tipos-de-unidade-listar">Tipos de unidade</a></li>						
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Cadastro variados</li>
						<li><a href="?ido=tipos-de-moradores-listar">Tipos de moradores</a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Mensagens</li>
						<li><a href="?ido=mensagens-listar">Listar</a></li>
						<li><a href="?ido=mensagens-manter">Cadastrar</a></li>
					</ul>
				</li>
			<?php }?>
			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuConsultas)) {?>		
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Consultas <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?ido=unidades-listar-por-morador">Ficha completa das unidades</a></li>
						<li><a href="?ido=moradores-consultar">Moradores</a></li>
						<li><a href="?ido=veiculos-consultar">Veículos</a></li>
					</ul>
				</li>
			<?php }?>
			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuCorreios)) {?>		
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Correios <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?ido=correios-listar">Listagem geral</a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Registro</li>
						<li><a href="?ido=correios-entrada"><span class="glyphicon glyphicon-resize-small"></span> Entrada de correspondência</a></li>
					</ul>
				</li>
			<?php }?>
			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuMonitoramento)) {?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Monitoramento <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?ido=monitoramento-emails">Aceitação de emails</a></li>
						<li><a href="?ido=monitoramento-mensagens">Leitura de mensagens</a></li>
						<li><a href="?ido=monitoramento-logs">Logs</a></li>
					</ul>
				</li>
			<?php }?>			
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Meu login <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?ido=login-manter">Alterar senha</a></li>
					</ul>
				</li>
			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuRelatorios)) {?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Relatorios <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Pessoas</li>					
						<li><a href="?ido=relatorio-funcionarios">Funcionários</a></li>
						<li><a href="?ido=relatorio-moradores">Moradores</a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Correios</li>
						<li><a href="?ido=relatorio-geral-correios">Geral de Correspondências</a></li>
						<li><a href="?ido=relatorio-diario-entrada-correios">Recebimentos Diários</a></li>
					</ul>
				</li>
			<?php }?>			
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					Sobre <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?ido=sobre">Sobre</a></li>
						<li><a href="?ido=termo-de-uso">Termo de uso</a></li>
					</ul>
				</li>
				<li>
					<a href="services/login/logout.php">Sair <span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
				</li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
	<!--/.container-fluid -->
</nav>