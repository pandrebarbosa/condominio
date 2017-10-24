    <div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                <a class="navbar-brand" style="font-family: 'Allura', cursive; font-size: 30px;">San Raphael</a>
            </div>

            <!-- Search -->
            <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
                <span class="glyphicon glyphicon-search"></span>
            </a>

            <!-- Search body -->
            <div id="search" class="panel-collapse collapse">
                <div class="panel-body">
                    <form class="navbar-form" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Busca...">
                        </div>
                        <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-ok"></span></button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

			<li><a href="?ido=inicio"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Início</a></li>

			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuAdmin)) {?>
            <!-- Menu SYS -->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl2">
                    <span class="glyphicon glyphicon-user"></span> Administrador <span class="caret"></span>
                </a>
                <div id="dropdown-lvl2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
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
                    </div>
                </div>
            </li>
            <?php }?>

			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuConsultas)) {?>
            <!-- Menu SYS -->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl3">
                    <span class="glyphicon glyphicon-list-alt"></span> Consultas <span class="caret"></span>
                </a>
                <div id="dropdown-lvl3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
							<li><a href="?ido=unidades-listar-por-morador">Ficha completa das unidades</a></li>
							<li><a href="?ido=moradores-consultar">Moradores</a></li>
							<li><a href="?ido=veiculos-consultar">Veículos</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php }?>

			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuCorreios)) {?>
            <!-- Menu SYS -->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl4">
                    <span class="glyphicon glyphicon-envelope"></span> Correios <span class="caret"></span>
                </a>
                <div id="dropdown-lvl4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
							<li><a href="?ido=correios-listar">Listagem geral</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Registro</li>
							<li><a href="?ido=correios-entrada"><span class="glyphicon glyphicon-resize-small"></span> Entrada de correspondência</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php }?>

			<li><a href="?ido=mensagens-listar-minhas"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Mensagens</a></li>

			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuMonitoramento)) {?>
            <!-- Menu SYS -->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl5">
                    <span class="glyphicon glyphicon-dashboard"></span> Monitoramento <span class="caret"></span>
                </a>
                <div id="dropdown-lvl5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
							<li><a href="?ido=monitoramento-emails">Aceitação de emails</a></li>
							<li><a href="?ido=monitoramento-mensagens">Leitura de mensagens</a></li>
							<li><a href="?ido=monitoramento-logs">Logs</a></li>
						</ul>
                    </div>
                </div>
            </li>
            <?php }?>

            <li><a href="?ido=login-manter"><span class="glyphicon glyphicon-send"></span> Meu login</a></li>
            
			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuRelatorios)) {?>
            <!-- Menu SYS -->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl6">
                    <span class="glyphicon glyphicon-list-alt"></span> Relatórios <span class="caret"></span>
                </a>
                <div id="dropdown-lvl6" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Pessoas</li>					
							<li><a href="?ido=relatorio-funcionarios">Funcionários</a></li>
							<li><a href="?ido=relatorio-moradores">Moradores</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Correios</li>
							<li><a href="?ido=relatorio-geral-correios">Geral de Correspondências</a></li>
							<li><a href="?ido=relatorio-diario-entrada-correios">Recebimentos Diários</a></li>
						</ul>
                    </div>
                </div>
            </li>
            <?php }?>

			<?php if(in_array($_SESSION['credencial']['no_tipo_usuario'], $menuSys)) {?>
            <!-- Menu SYS -->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-cog"></span> SYS <span class="caret"></span>
                </a>
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
		                  	<li class="dropdown-header">Controller</li>
							<li><a href="?ido=controller-listar">Cadastrar</a></li>
							<li><a href="?ido=controller-vincular">Vincular</a></li>
							<li role="separator" class="divider"></li>
		                  	<li class="dropdown-header">Grupos de Mensagem</li>
							<li><a href="?ido=grupos-mensagem-manter">Criar Grupo</a></li>
							<li><a href="?ido=grupos-mensagem-listar">Listar Grupos</a></li>
							<li role="separator" class="divider"></li>
		                  	<li class="dropdown-header">Tipos de usuários</li>
							<li><a href="?ido=tipos-usuarios-listar">Manter</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php }?>
                        
            <li><a href="?ido=sobre"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Sobre</a></li>
            <li><a href="services/login/logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair</a></li>

        </ul>
    </div><!-- /.navbar-collapse -->
	</nav>
    
    </div>