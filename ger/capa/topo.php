			<script type="text/javascript">
				function trocaBackground(cod){
					document.getElementById('trocaBackground-6').style.background="transparent url('<?php echo $configUrl;?>f/i/default/menu-default/menu-inativo.gif') left top no-repeat";
					document.getElementById('trocaBackground-5').style.background="transparent url('<?php echo $configUrl;?>f/i/default/menu-default/menu-inativo.gif') left top no-repeat";
					document.getElementById('trocaBackground-4').style.background="transparent url('<?php echo $configUrl;?>f/i/default/menu-default/menu-inativo.gif') left top no-repeat";
					document.getElementById('trocaBackground-'+cod).style.background="transparent url('<?php echo $configUrl;?>f/i/default/menu-default/menu-ativo.gif') left bottom no-repeat";
				}
			</script>
			<div id="topo">
				<div id="topo-esq">
					<p class="slogan"><a style="padding-top:5px; padding-bottom:13px;" title="<?php echo $nomeEmpresa;?>" href="<?php echo $configUrl;?>"><img style="padding-left:14px;" src="<?php echo $configUrlGer;?>f/i/comp.png" height="55"/></a></p>
					<div id="menu">
						<p class="<?php echo $url[3] == 'atendimento' || $url[3] == '' ? 'menu-atendimento-ativo' : 'menu-atendimento';?>"><a href="javascript:trocaBackground(5);"  id="trocaBackground-5" onClick="mostraItens(5)" >Atendimento</a></p>
						<p class="<?php echo $url[3] == 'cadastros' ? 'menu-cadastros-ativo' : 'menu-cadastros';?>"><a href="javascript:trocaBackground(6);"  id="trocaBackground-6" onClick="mostraItens(6)" >Cadastros</a></p>
						<p class="<?php echo $url[3] == 'imoveis' ? 'menu-imoveis-ativo' : 'menu-imoveis';?>"><a href="javascript:trocaBackground(4);"  id="trocaBackground-4" onClick="mostraItens(4)" >Imóveis</a></p>
					</div>
				</div>
				<div id="topo-dir">
					<div id="icones-topo">
						<p class="icone-configuracoes" style="border-right:none;"><a href="<?php echo $configUrl;?>configuracoes/" title="" >Configurações</a></p>
						<br class="clear" />
					</div>
					<br class="clear" />
					<div id="dados-usuario-topo">
						<div id="dados-cliente-topo">

<?php
	$sqlImagemUsuario = "SELECT * FROM usuariosImagens WHERE codUsuario = ".$_COOKIE['codAprovado'.$cookie]." ORDER BY codUsuarioImagem DESC LIMIT 0,1";
	$resultImagemUsuario = $conn->query($sqlImagemUsuario);
	$dadosImagemUsuario = $resultImagemUsuario->fetch_assoc();
	if($dadosImagemUsuario['codUsuario'] != ""){	
		$imagemUsuario = $configUrl."configuracoes/minha-foto/".$dadosImagemUsuario['codUsuario']."-".$dadosImagemUsuario['codUsuarioImagem']."-G.".$dadosImagemUsuario['extUsuarioImagem'];
	}else{
		$imagemUsuario = $configUrl."f/i/default/topo-default/avatar.gif";
	}
?>	
							<p class="nome-cliente"><?php echo $nomeEmpresaMenor;?></p>
							<p class="nome-usuario"><span class="titulo-usuario">Usuário:</span> <?php echo $_COOKIE['loginAprovado'.$cookie];?></p>
							<p class="icone-sair"><a href="<?php echo $configUrl;?>sair.php" title=""><span class="oculto">Sair</span></a></p>
						</div>
						<div id="imagem-cliente-topo">
							<a href="<?php echo $configUrl;?>configuracoes/minha-foto/" title="Alterar foto" ><img style="border-radius:5px;" src="<?php echo $imagemUsuario;?>" alt="" /></a>
						</div>
					</div>
				</div>
				<br class="clear" />
				<div id="barra-menu">
					<div id="menu-dinamico">
						<div id="atendimento" <?php echo $url[3] == "" ? "style='display:none;'" : "";?>>
							<ul>
								<li><a <?php echo $url[4] == "leads" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>atendimento/leads/">Leads</a></li>
								<li><a <?php echo $url[4] == "relatorios" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>atendimento/relatorios/">Relatórios de Acessos</a></li>
								<li><a <?php echo $url[4] == "informacoes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>atendimento/informacoes/">Informações</a></li>
							</ul>
						</div>			
						<div id="cadastros" <?php echo $url[3] == "" ? "style='display:none;'" : "";?>>
							<ul>
								<li><a <?php echo $url[4] == "banners" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>cadastros/banners/">Banners Capa</a></li>
								<li><a <?php echo $url[4] == "quemSomos" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>cadastros/quemSomos/">Quem Somos</a></li>				
								<li><a <?php echo $url[4] == "blog" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>cadastros/blog/">Blog</a></li>					
								<li><a <?php echo $url[4] == "balnearioGaivota" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>cadastros/balnearioGaivota/">Balneário Gaivota</a></li>
							</ul>
						</div>			
						<div id="imoveis" <?php echo $url[3] == "" ? "style='display:none;'" : "";?>>
							<ul>
								<li><a <?php echo $url[4] == "usuarios" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/usuarios/">Usuários</a></li>					
								<li><a <?php echo $url[4] == "clientes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/clientes/">Clientes</a></li>					
								<li><a <?php echo $url[4] == "proprietarios" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/proprietarios/">Proprietários</a></li>					
								<li><a <?php echo $url[4] == "pais" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/pais/">País</a></li>					
								<li><a <?php echo $url[4] == "cidades" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/cidades/">Cidades</a></li>
								<li><a <?php echo $url[4] == "bairros" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/bairros/">Bairros</a></li>
								<li><a <?php echo $url[4] == "quadras" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/quadras/">Quadras</a></li>
								<li><a <?php echo $url[4] == "lotes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/lotes/">Lotes</a></li>
								<li><a <?php echo $url[4] == "caracteristicas" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/caracteristicas/">Características</a></li>								
								<li><a <?php echo $url[4] == "tipoImovel" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/tipoImovel/">Tipo Imóvel</a></li>								
								<li><a <?php echo $url[4] == "imoveis" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/imoveis/">Imóveis</a></li>
							</ul>
						</div>			
					</div>
					<div id="menu-normal">
						<div id="atendimento" <?php echo $url[3] == "atendimento" || $url[3] == "" ? "style='display:block;'" : "style='display:none;'";?>>
							<ul>
								<li><a <?php echo $url[4] == "leads" || $url[4] == "" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>atendimento/leads/">Leads</a></li>
								<li><a <?php echo $url[4] == "relatorios" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>atendimento/relatorios/">Relatórios de Acessos</a></li>
								<li><a <?php echo $url[4] == "informacoes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>atendimento/informacoes/">Informações</a></li>
							</ul>
						</div>			
						<div id="cadastros" <?php echo $url[3] == "cadastros" ? "style='display:block;'" : "style='display:none;'";?>>
							<ul>
								<li><a <?php echo $url[4] == "banners" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>cadastros/banners/">Banners Capa</a></li>
								<li><a <?php echo $url[4] == "quemSomos" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>cadastros/quemSomos/">Quem somos</a></li>	
								<li><a <?php echo $url[4] == "blog" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>cadastros/blog/">Blog</a></li>
								<li><a <?php echo $url[4] == "balnearioGaivota" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>cadastros/balnearioGaivota/">Balneário Gaivota</a></li>
							</ul>
						</div>			
						<div id="imoveis" <?php echo $url[3] == "imoveis" ? "style='display:block;'" : "style='display:none;'";?>>
							<ul>
								<li><a <?php echo $url[4] == "usuarios" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/usuarios/">Usuários</a></li>					
								<li><a <?php echo $url[4] == "clientes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/clientes/">Clientes</a></li>					
								<li><a <?php echo $url[4] == "proprietarios" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/proprietarios/">Proprietários</a></li>	
								<li><a <?php echo $url[4] == "pais" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/pais/">País</a></li>									
								<li><a <?php echo $url[4] == "cidades" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/cidades/">Cidades</a></li>
								<li><a <?php echo $url[4] == "bairros" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/bairros/">Bairros</a></li>
								<li><a <?php echo $url[4] == "quadras" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/quadras/">Quadras</a></li>
								<li><a <?php echo $url[4] == "lotes" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/lotes/">Lotes</a></li>
								<li><a <?php echo $url[4] == "caracteristicas" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/caracteristicas/">Características</a></li>								
								<li><a <?php echo $url[4] == "tipoImovel" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/tipoImovel/">Tipo Imóvel</a></li>								
								<li><a <?php echo $url[4] == "imoveis" ? "class='ativo'" : "";?> href="<?php echo $configUrl;?>imoveis/imoveis/">Imóveis</a></li>
							</ul>
						</div>						
					</div>
				</div>
			</div>
