							<div id="conteudo-interno">
								<div id="conteudo-imoveis">
									<div id="bloco-titulo">
										<p class="titulo">IMÓVEIS</p>
									</div>
									<div id="filtro-interno">

<?php
	include('capa/filtro.php');
	
	if($cidadeFiltra != ""){
		$urlNumber = 5;
		$urlPag = "imoveis/".$url[3]."/".$url[4];		
	}else
	if($tipoImovel != ""){
		$urlNumber = 4;
		$urlPag = "imoveis/".$url[3];
	}else{
		$urlNumber = 3;
		$urlPag = "imoveis";
	}
?>
									</div>
									<div id="mostra-imoveis">
<?php
	$cont = 0;
	
	$sqlConta = "SELECT count(DISTINCT I.codImovel) registros FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TI on I.codTipoImovel = TI.codTipoImovel inner join cidades C on I.codCidade = C.codCidade inner join bairros B on I.codBairro = B.codBairro WHERE I.statusImovel = 'T'".$filtraCodigo.$filtraImoveis.$filtraCodigo.$filtraImovel.$filtraNegociacao.$filtraDormitorio.$filtraSuites.$filtraBanheiros.$filtraVagas.$filtraTipoV.$filtraCidade.$filtraBairro.$filtraCodigo.$filtraPreco."";
	$resultConta = $conn->query($sqlConta);
	$dadosConta = $resultConta->fetch_assoc();
	$registros = $dadosConta['registros'];
		
	if($url[$urlNumber] == 1 || $url[$urlNumber] == ""){
		$pagina = 1;
		$sqlImoveis = "SELECT DISTINCT I.* FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TI on I.codTipoImovel = TI.codTipoImovel inner join cidades C on I.codCidade = C.codCidade inner join bairros B on I.codBairro = B.codBairro WHERE I.statusImovel = 'T'".$filtraCodigo.$filtraImoveis.$filtraCodigo.$filtraImovel.$filtraNegociacao.$filtraDormitorio.$filtraSuites.$filtraBanheiros.$filtraVagas.$filtraTipoV.$filtraCidade.$filtraBairro.$filtraCodigo.$filtraPreco." ORDER BY".$ordenar." I.lancamentoImovel ASC, I.destaqueImovel ASC, I.codImovel DESC LIMIT 0,28";
	}else{
		$pagina = $url[$urlNumber];
		$paginaFinal = $pagina * 28;
		$paginaInicial = $paginaFinal - 28;
		$sqlImoveis = "SELECT DISTINCT I.* FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TI on I.codTipoImovel = TI.codTipoImovel inner join cidades C on I.codCidade = C.codCidade inner join bairros B on I.codBairro = B.codBairro WHERE I.statusImovel = 'T'".$filtraCodigo.$filtraImoveis.$filtraCodigo.$filtraImovel.$filtraNegociacao.$filtraSuites.$filtraDormitorio.$filtraBanheiros.$filtraVagas.$filtraTipoV.$filtraCidade.$filtraBairro.$filtraCodigo.$filtraPreco." ORDER BY".$ordenar." I.lancamentoImovel ASC, I.destaqueImovel ASC, I.codImovel DESC LIMIT ".$paginaInicial.",28";
	}
	
	$resultImoveis = $conn->query($sqlImoveis);
	while($dadosImoveis = $resultImoveis->fetch_assoc()){
		$mostrando = $mostrando + 1;

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

		if($cont == 4){
			$cont = 0;
			$margin = "margin-right:0px;";
		}else{
			$margin = "";
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
										<br class="clear" />

									</div>
									<?php
	$regPorPagina = 28;
	$area = $urlPag;
	include('f/conf/paginacao.php');
?>
								</div>
							</div>
