							<div id="conteudo-interno" style="width:100%;">
								<div id="repete-imoveis-detalhes">
									<div id="bloco-titulo">
											<p class="titulo">IMÓVEIS</p>
									</div>
									<p class="botao-topo"><a href="<?php echo $configUrl;?>imoveis/">Voltar</a></p>	
									<div id="conteudo-imoveis-interno" style="width:100%;">				
										<div id="detalhes-imovel">
<?php
	$quebraUrl = explode("-", $url[3]);
	$cont = 1;

	$sqlImovel = "SELECT * FROM imoveis WHERE codImovel = '".$quebraUrl[0]."' and statusImovel = 'T' LIMIT 0,1";
	$resultImovel = $conn->query($sqlImovel);
	$dadosImovel = $resultImovel->fetch_assoc();
	
	if($dadosImovel['codImovel'] == ""){
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."imoveis/'>";	
	}

	if($_COOKIE['verificaAcesso'.$quebraUrl[0]] == ""){
		setcookie("verificaAcesso".$quebraUrl[0], 1, time()+3600, "/");
		
		$somaAcesso = $dadosImovel['acessosImovel'] + 1; 
		
		$sqlUpdate = "UPDATE imoveis SET acessosImovel = ".$somaAcesso." WHERE codImovel = ".$dadosImovel['codImovel']."";
		$resultUpdate = $conn->query($sqlUpdate);
	}

	$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = ".$dadosImovel['codTipoImovel']." LIMIT 0,1";
	$resultTipoImovel = $conn->query($sqlTipoImovel);
	$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
		
	$imovel = $dadosTipoImovel['nomeTipoImovel'];
	
	if($dadosImovel['tipoCImovel'] == 'V'){
		$comercial = "Venda";
	}else{
		$comercial = "Aluguel";
	}
	
	if($dadosImovel['precoImovel'] != "0.00"){
		$valor = "R$ ".number_format($dadosImovel['precoImovel'], 2, ",", ".");
	}else{
		$valor = "A consultar";
	}
	
	$sqlCidade = "SELECT * FROM cidades WHERE statusCidade = 'T' and codCidade = ".$dadosImovel['codCidade']." LIMIT 0,1";
	$resultCidade = $conn->query($sqlCidade);
	$dadosCidade = $resultCidade->fetch_assoc();
	
	$sqlBairro = "SELECT * FROM bairros WHERE statusBairro = 'T' and codBairro = ".$dadosImovel['codBairro']." LIMIT 0,1";
	$resultBairro = $conn->query($sqlBairro);
	$dadosBairro = $resultBairro->fetch_assoc();	
?>
			
<?php
	$sqlImagens = "SELECT * FROM imoveisImagens WHERE codImovel = '".$dadosImovel['codImovel']."' ORDER BY ordenacaoImovelImagem ASC, codImovelImagem ASC";
	$resultImagens = $conn->query($sqlImagens);
	$numImagens = $resultImagens->num_rows;
?>

<div id="bloco-imagem">
											<div class="owl-estampas">
												<div class="row">
													<div class="large-12 columns">
														<div class="loop owl-carousel imoveis-detalhes owl-loaded owl-drag">	

<?php
	while($dadosImagens = $resultImagens->fetch_assoc()){
		
		if($dadosImagens['extImovelImagem'] == "mp4"){
			
?>
															<li style="width:226px; height:400px; position:relative; background-color:#b17d4a;"><span><video id="video" class="vid" disablePictureInPicture controlsList="nodownload" constrols style="max-height:100%; position:absolute; left:50%; transform:translateX(-50%);" src="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagens['codImovel'].'-'.$dadosImagens['codImovelImagem'].'-O.'.$dadosImagens['extImovelImagem'];?>" type="video/mp4" controls="true"></video></span></li>
<?php
		}else{
?>
															<li><a rel="lightbox[roadtrip]" href="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagens['codImovel'].'-'.$dadosImagens['codImovelImagem'].'-W.webp';?>" style="width: 390px; height:350px; display:block; background:transparent url('<?php echo $configUrlGer.'f/imoveis/'.$dadosImagens['codImovel'].'-'.$dadosImagens['codImovelImagem'].'-W.webp';?>') center center no-repeat; background-size:cover, 100%; border-radius: 15px;"></a></li>
														
<?php		
		}
	}
?>	
														</div>
													</div>
												</div>
											</div>
											<?php 
											if($numImagens < 3 ){ ?>
											<style> .owl-carousel .owl-stage-outer {display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center;}</style>
											<script>
												var $gt = jQuery.noConflict();
												var owl = $gt('.imoveis-detalhes');
													owl.owlCarousel({
														center: false,
														items:3,
														loop: false,
														autoWidth:false,
														margin:15,
														nav: true,
														dots: false
													});
											</script>	
<?php
	}else{
?>
											<script>
												var $gt = jQuery.noConflict();
												var owl = $gt('.imoveis-detalhes');
													owl.owlCarousel({
														center: true,
														items:3,
														loop: true,
														autoWidth:false,
														margin:15,
														nav: true,
														dots: false
													});
											</script>	
<?php 
	}
?>												
										</div>
										<div id="centraliza">
										<div id="mostra-informacoes">
											<div id="bloco-nome">	
												<div id="limita-nome">	
													<p class="nome-imovel"><?php echo $dadosImovel['nomeImovel'];?></p>
												</div>	
											</div>
											<div id="icones">
												<p class="quartos" style="<?php echo $dadosImovel['quartosImovel'] == 0 ? 'display:none;' : '';?>">Quartos:<br/><span><?php echo $dadosImovel['quartosImovel'];?></span></p>
												<p class="suite" style="<?php echo $dadosImovel['suiteImovel'] == 0 ? 'display:none;' : '';?>">Suítes:<br/><span><?php echo $dadosImovel['suiteImovel'];?></span></p>
												<p class="banheiros" style="<?php echo $dadosImovel['banheirosImovel'] == 0 ? 'display:none;' : '';?>">Banheiros:<br/><span><?php echo $dadosImovel['banheirosImovel'];?></span></p>
												<p class="garagem" style="<?php echo $dadosImovel['garagemImovel'] == 0 ? 'display:none;' : '';?>">Garagem:<br/><span><?php echo $dadosImovel['garagemImovel'];?></span></p>
												<p class="area" style="<?php echo $dadosImovel['metragemImovel'] == 0 ? 'display:none;' : '';?>">Área do Terreno:<br/><span><?php echo $dadosImovel['metragemImovel'];?><?php echo $dadosImovel['siglaMetragem']; ?></span></p>
												<p class="frente" style="<?php echo $dadosImovel['frenteImovel'] == "" ? 'display:none;' : '';?>">Frente:<br/><span><?php echo $dadosImovel['frenteImovel'];?>m</span></p>
												<p class="fundos" style="<?php echo $dadosImovel['fundosImovel'] == 0 ? 'display:none;' : '';?>">Fundos:<br/><span><?php echo $dadosImovel['fundosImovel'];?>m</span></p>
												<p class="area-c" style="<?php echo $dadosImovel['metragemCImovel'] == 0 ? 'display:none;' : '';?>">Área Construída:<br/><span><?php echo $dadosImovel['metragemCImovel'];?>m²</span></p>
												<p class="posicao" style="<?php echo $dadosImovel['posicaoImovel'] == "" ? 'display:none;' : '';?>">Posição Solar:<br/><span><?php echo $dadosImovel['posicaoImovel'];?></span></p>
												<br class="clear"/>
											</div>	
											<div id="col-esq-imoveis">
												<div id="bloco-dados">
													<div id="alinha">
														<div id="alinha-denovo">	
															<p class="outros-imovel" style="float:right;"><span class="bold">Cidade: </span><?php echo $dadosCidade['nomeCidade'];?></p>
															<p class="outros-imovel"><span class="bold">Bairro: </span><?php echo $dadosBairro['nomeBairro'];?></p>
															<p class="outros-imovel" style="float:right;"><span class="bold">Código: </span><?php echo $dadosImovel['codigoImovel'];?></p>
															<p class="outros-imovel"><span class="bold">Tipo Imóvel: </span><?php echo $imovel;?></p>
															<br class="clear"/>
														</div>
											
													</div>
													<p class="preco-imovel"><?php echo $valor;?></p>
												</div>	
<?php
	$sqlCaracteristicas = "SELECT DISTINCT C.codCaracteristica, C.* FROM caracteristicasImoveis CI inner join caracteristicas C on CI.codCaracteristica = C.codCaracteristica WHERE C.statusCaracteristica = 'T' and CI.codImovel = '".$dadosImovel['codImovel']."' ORDER BY C.codOrdenacaoCaracteristica ASC LIMIT 0,1";
	$resultCaracteristicas = $conn->query($sqlCaracteristicas);
	$dadosCaracteristicas = $resultCaracteristicas->fetch_assoc();
	
	if($dadosCaracteristicas['codCaracteristica'] != ""){
?>
												<div id="caracteristicas">
													<p class="titulo"><strong>Características do Imóvel</strong></p>
<?php
		$sqlCaracteristicas = "SELECT DISTINCT C.codCaracteristica, C.* FROM caracteristicasImoveis CI inner join caracteristicas C on CI.codCaracteristica = C.codCaracteristica WHERE C.statusCaracteristica = 'T' and CI.codImovel = '".$dadosImovel['codImovel']."' ORDER BY C.codOrdenacaoCaracteristica ASC";
		$resultCaracteristicas = $conn->query($sqlCaracteristicas);
		while($dadosCaracteristicas = $resultCaracteristicas->fetch_assoc()){
?>												
													<p class="item-caracteristica"><?php echo $dadosCaracteristicas['nomeCaracteristica'];?></p>
<?php
		}
?>
													<br class="clear"/>
												</div>
<?php
	}

	$sqlCorretor = "SELECT * FROM usuarios WHERE codUsuario = ".$dadosImovel['codUsuario']." LIMIT 0,1";
	$resultCorretor = $conn->query($sqlCorretor);
	$dadosCorretor = $resultCorretor->fetch_assoc();
?>
												<div id="compartilhar">
													<p class="titulo" style="margin-bottom:10px;">Compartilhe este imóvel</p>
													<p class="facebook" style="float:left; cursor:pointer; margin-right:15px;"><a target="resource window" title="Clique aqui para compartilhar este imóvel no Facebook" onClick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $configUrl.$arquivoRetornar;?>&t=<?php echo $dadosImovel['nomeImovel'];?>','pagename','resizable,height=400,width=400');"><img style="border-radius:3px; display:block;" src="<?php echo $configUrl;?>f/i/quebrado/icone-facebook-1.png" width="40"/></a></p>
													<div id="twitter" style="float:left; cursor:pointer;"><a target="resource window" title="Clique aqui para compartilhar este imóvel no Twitter" onClick="window.open('https://twitter.com/share?url=<?php echo $configUrl.$arquivoRetornar;?>%3Futm_source%3Dtwitter%26utm_medium%3Dshare-bar-desktop%26utm_campaign%3Dshare-bar&text=<?php echo $dadosImovel['nomeImovel'];?>','pagename','resizable,height=400,width=400');"><img style="border-radius:3px; display:block;" src="<?php echo $configUrl;?>f/i/quebrado/icone-twitter-1.png" width="40"></a></div>
													<br class="clear"/>
												</div>
											</div>	
											<div id="bloco-desc">
												<p class="titulo">Informações sobre o imóvel</p>	
												<div class="descricao"><?php echo $dadosImovel['descricaoImovel'];?></div>
<?php	
	if($dadosCorretor['codUsuario'] != ""){
?>
												<p class="titulo-corretor">Fale com o nosso Corretor</p>
												<div id="corretor">
<?php
		$sqlImagem = "SELECT * FROM usuariosImagens WHERE codUsuario = ".$dadosCorretor['codUsuario']." ORDER BY codUsuarioImagem DESC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem3 = $resultImagem->fetch_assoc();
		
		$limpaCelular = str_replace("(", "", $dadosCorretor['celularUsuario']);
		$limpaCelular = str_replace(")", "", $limpaCelular);
		$limpaCelular = str_replace("-", "", $limpaCelular);
		$limpaCelular = str_replace(" ", "", $limpaCelular);
?>
													<div id="esq-corretor">
<?php
		if($dadosImagem3['codUsuarioImagem'] != ""){
?>
														<div class="imagem"><p style="width:71px; height:71px; display:table-cell; vertical-align:middle;"><img style="display:block;" src="<?php echo $configUrlGer.'imoveis/minha-foto/'.$dadosImagem3['codUsuario'].'-'.$dadosImagem3['codUsuarioImagem'].'-G.'.$dadosImagem3['extUsuarioImagem'];?>" width="71"/></p></div>
<?php
		}else{
?>
														<p class="imagem"><img style="display:block;" src="<?php echo $configUrl;?>f/i/quebrado/defalt.png" width="47"/></p>
<?php
		}
?>
														<div class="dados">
															<p class="nome"><?php echo $dadosCorretor['nomeUsuario'];?></p>
															<p class="telefone"><?php echo $dadosCorretor['celularUsuario'];?></p>
															<p class="email"><a href="mailto:<?php echo $dadosCorretor['emailUsuario'];?>"><?php echo $dadosCorretor['emailUsuario'];?></a></p>
														</div>
													</div>
													<div id="dir-corretor">
														<p class="botao-whatsapp-2"><a target="_blank" title="Chame-nos no WhatsApp"  onClick="abrirAcesso();" >Iniciar conversa<br/>no Whatsapp</a></p>
											
														<br class="clear"/>
													</div>
													<br class="clear"/>
												</div>
<?php
	}
?>											
											</div>
											<br class="clear"/>
<?php
	if($dadosImovel['videoImovel'] != ""){

		$pegaCodigoVideo = explode("=", $dadosImovel['videoImovel']);
		$pegaCodigoVideo = explode("&", $pegaCodigoVideo[1]);
		$montaLink = "//www.youtube.com/embed/".$pegaCodigoVideo[0];
		
		if($pegaCodigoVideo[0] == "" || $pegaCodigoVideo[0] == "shared"){
			$pegaCodigoVideo = str_replace("?feature=shared", "", $dadosImovel['videoImovel']);
			$pegaCodigoVideo = str_replace("https://youtu.be/", "", $pegaCodigoVideo);
			$montaLink = "//www.youtube.com/embed/".$pegaCodigoVideo;
		}		
?>	
											<div class="link-video" style="width:1200px; height:600px;"><iframe width="100%" height="600" src="<?php echo $montaLink;?>" frameborder="0" allowfullscreen></iframe></div>									
<?php
	}
?>
											<br/>
											<br/>
											<p class="botao-bottom" style="text-align: center;"><a href="<?php echo $configUrl;?>imoveis/">Voltar</a></p>
										</div>	
<?php
	$sqlImoveisConta = "SELECT count(DISTINCT I.codImovel) total FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel WHERE I.statusImovel = 'T' and I.codTipoImovel = ".$dadosImovel['codTipoImovel']." and I.codBairro = ".$dadosImovel['codBairro']." and I.codImovel != ".$dadosImovel['codImovel']."";
	$resultImoveisConta = $conn->query($sqlImoveisConta);
	$dadosImoveisConta = $resultImoveisConta->fetch_assoc();

	if($dadosImoveisConta['total'] >= 1){
?>												
										<div id="recomendado">
											<p class="veja">Veja mais <strong><?php echo $imovel;?>s</strong> no bairro <strong><?php echo $dadosBairro['nomeBairro'];?></strong></p>
<?php
		$cont = 0;
		$cont2 = 0;
		
		$sqlImoveis = "SELECT DISTINCT I.* FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel WHERE I.statusImovel = 'T' and I.codTipoImovel = '".$dadosImovel['codTipoImovel']."' and I.codBairro = ".$dadosImovel['codBairro']." and I.codImovel != ".$dadosImovel['codImovel']." ORDER BY I.lancamentoImovel ASC, I.destaqueImovel ASC, I.codImovel DESC LIMIT 0,8";
		$resultImoveis = $conn->query($sqlImoveis);
		while($dadosImoveis = $resultImoveis->fetch_assoc()){

			$cont++;

			$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$dadosImoveis['codCidade']." LIMIT 0,1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();
			
			$sqlBairro = "SELECT * FROM bairros WHERE codBairro = ".$dadosImoveis['codBairro']." LIMIT 0,1";
			$resultBairro = $conn->query($sqlBairro);
			$dadosBairro = $resultBairro->fetch_assoc();
			
			$sqlImagem = "SELECT * FROM imoveisImagens WHERE codImovel = ".$dadosImoveis['codImovel']." ORDER BY ordenacaoImovelImagem ASC, codImovelImagem ASC LIMIT 0,1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();

			$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = ".$dadosImoveis['codTipoImovel']." LIMIT 0,1";
			$resultTipoImovel = $conn->query($sqlTipoImovel);
			$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
				
			$imagem = $configUrlGer."f/imoveis/".$dadosImagem['codImovel'].'-'.$dadosImagem['codImovelImagem'].'-G.'.$dadosImagem['extImovelImagem'];
				
			if($dadosImoveis['tipoCImovel'] == "V"){
				$tipoC = "Venda";
			}else{
				$tipoC = "Aluguel";
			}
				
			if($dadosImoveis['precoImovel'] != "0.00"){
				$preco = "R$ ".number_format($dadosImoveis['precoImovel'], 2, ",", ".");
			}else{
				$preco = "A consultar";
			}			
			
			if($cont == 4 ||$cont == 8 ||$cont == 12 ||$cont == 16){

				$margin = " margin-right:0px; margin-bottom:20px;";
			}else{
				
				$margin = " margin-right:20px; margin-bottom:20px;";
			}								
?>
									<div id="bloco-imovel" style="<?php echo $margin; ?> " class="wow animate__animated animate__fadeIn">
										<a title="<?php echo $dadosImoveis['nomeImovel']; ?>" href="<?php echo $configUrl . 'imoveis/' . $dadosImoveis['codImovel'] . '-' . $dadosImoveis['urlImovel'] . '/'; ?>">
											<div class="bloco-imagem">
												<p class="imagem" style="background:transparent url('<?php echo $configUrlGer . 'f/imoveis/' . $dadosImagem['codImovel'] . '-' . $dadosImagem['codImovelImagem'] . '-W.webp'; ?>') center center no-repeat; background-size:cover, 100%;"></p>
											</div>
											<div id="conteudo-dados">
												<div id="nome-imovel">
													<p class="nome">  <?php echo $dadosImoveis['nomeImovel']; ?> </p>
												</div>
												<div id="local">
													<p class="bairro"> <?php echo $dadosBairro['nomeBairro']; ?></p>
													<div id="cidade">
														<p class="cidade"> <?php echo $dadosCidade['nomeCidade']; ?> / <?php echo $dadosCidade['estadoCidade']; ?></p>
														<p class="tipoC" ><?php if( $dadosImoveis['tipoCImovel']  == 'V'){ ?> Venda <?php }else{  ?> Aluguel <?php } ?> </p>
													</div>
												</div>
												<div id="alinha-icones"  style=" <?php echo $dadosTipoImovel['nomeTipoImovel'] == 'Terreno' ? 'width:fit-content;' : ''; ?>">
													<div id="espaco">
														<p class="tipo"  style=" <?php if( $dadosTipoImovel['nomeTipoImovel']  == 'Apartamento'){ ?> background: transparent url(<?php echo $configUrl; ?>f/i/quebrado/apartamento.svg) 0px center no-repeat;  <?php }else if($dadosTipoImovel['nomeTipoImovel']  == 'Terreno' || $dadosTipoImovel['nomeTipoImovel']  == 'Lote' ){  ?> background: transparent url(<?php echo $configUrl; ?>f/i/quebrado/terreno.svg) 0px center no-repeat; <?php }else {  ?> background: transparent url(<?php echo $configUrl; ?>f/i/quebrado/casa.svg) 0px center no-repeat; <?php } ?> background-size: 20px; " ><?php echo $dadosTipoImovel['nomeTipoImovel']; ?></p>
														<p class="area" style="<?php echo $dadosImoveis['metragemImovel']; ?>"><?php echo $dadosImoveis['metragemImovel']; ?><?php echo $dadosImoveis['siglaMetragem']; ?></p>
														<p class="quartos" style="<?php echo $dadosImoveis['quartosImovel'] == 0 ? 'display:none;' : ''; ?>"><?php echo $dadosImoveis['quartosImovel']; ?></p>
														<p class="banheiros" style="<?php echo $dadosImoveis['banheirosImovel'] == 0 ? 'display:none;' : ''; ?>"><?php echo $dadosImoveis['banheirosImovel']; ?></p>
														<p class="garagem" style="<?php echo $dadosImoveis['garagemImovel'] == 0 ? 'display:none;' : ''; ?>"><?php echo $dadosImoveis['garagemImovel']; ?></p>
														<p class="suite" style="<?php echo $dadosImoveis['suiteImovel'] == 0 ? 'display:none;' : ''; ?>"><?php echo $dadosImoveis['suiteImovel']; ?></p>
													</div>
												</div>
												<div id="icones">
													<div id="alinha-infos">
														<p class="preco"><?php echo $preco; ?></p>
														<p class="detalhes">Mais detalhes</p>
													</div>
												</div>
											</div>
										</a>
									</div> 
<?php				
		}
?>
											<br class="clear"/>
										</div>
<?php
	}
	?>										</div>
										</div>
									</div>
								</div>				
							</div>
<?php
	$_SESSION['erro'] = "";
?>
									<style>
										ul li {margin-bottom:0px;}
									</style>
