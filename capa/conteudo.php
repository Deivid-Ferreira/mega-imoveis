     

	   <div id="repete-conteudo">
			<div id="repete-banners">
<?php
include('capa/banner-capa.php');
?>
            </div>
            <div id="repete-destaques">
                <div id="conteudo-destaques">
                    <div id="bloco-titulo">
                        <p class="titulo">Destaques <span>Imperdíveis</span></p>
						<div id="linha"></div>
						<p class="sub-titulo"> Descubra opções de imóveis que são ideais para realizar seu sonho de morar perto do mar.</p>
                    </div>
                    <div id="mostra-destaques">
<?php
	$cont = 0;

	$sqlImoveis = "SELECT DISTINCT I.* FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TP on I.codTipoImovel = TP.codTipoImovel WHERE I.statusImovel = 'T' AND I.destaqueImovel = 'T' AND I.tipoCImovel = 'V'  ORDER BY I.codImovel DESC LIMIT 0,6";
	$resultImoveis = $conn->query($sqlImoveis);
	while ($dadosImoveis = $resultImoveis->fetch_assoc()) {

		$cont++;

		$sqlCidade = "SELECT * FROM cidades WHERE codCidade = " . $dadosImoveis['codCidade'] . " LIMIT 0,1";
		$resultCidade = $conn->query($sqlCidade);
		$dadosCidade = $resultCidade->fetch_assoc();

		$sqlBairro = "SELECT * FROM bairros WHERE codBairro = " . $dadosImoveis['codBairro'] . " LIMIT 0,1";
		$resultBairro = $conn->query($sqlBairro);
		$dadosBairro = $resultBairro->fetch_assoc();

		$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = " . $dadosImoveis['codTipoImovel'] . " LIMIT 0,1";
		$resultTipoImovel = $conn->query($sqlTipoImovel);
		$dadosTipoImovel = $resultTipoImovel->fetch_assoc();

		$sqlImagem = "SELECT * FROM imoveisImagens WHERE codImovel = " . $dadosImoveis['codImovel'] . " ORDER BY ordenacaoImovelImagem ASC, codImovelImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();

		if ($dadosImoveis['precoImovel'] != "0.00") {
			$preco = "R$ " . number_format($dadosImoveis['precoImovel'], 2, ",", ".");
		} else {
			$preco = "A consultar";
		}

		if ($dadosImoveis['tipoCImovel'] == "V") {
			$tipoC = "Venda";
		} else {
			$tipoC = "Aluguel";
		}

		if ($cont == 3) {
			$cont = 0;
			$margin = "margin-right:0px;";
		} else {
			$margin = "margin-right:20px;";
		}
?>
									<div id="bloco-imovel" style="<?php echo $margin; ?> " class="wow animate__animated animate__fadeInUp">
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
															<p class="tipo"  style=" <?php if( $dadosTipoImovel['nomeTipoImovel']  == 'Apartamento'){ ?> background: transparent url(<?php echo $configUrl; ?>f/i/quebrado/apartamento.svg) 0px center no-repeat;  <?php }else if($dadosTipoImovel['nomeTipoImovel']  == 'Terreno' || $dadosTipoImovel['nomeTipoImovel']  == 'Lote' ){  ?> background: transparent url(<?php echo $configUrl; ?>f/i/quebrado/terreno.svg) 0px center no-repeat; <?php }else {  ?> background: transparent url(<?php echo $configUrl; ?>f/i/quebrado/casa.svg) 0px center no-repeat; <?php } ?> background-size: 25px; " ><?php echo $dadosTipoImovel['nomeTipoImovel']; ?></p>
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
                        <p class="ver-mais" title="Ver mais Imóveis"><a href="<?php echo $configUrl; ?>imoveis/">MAIS IMÓVEIS</a></p>
                    </div>
                </div>
            </div>
<?php
	$sqlImoveis = "SELECT DISTINCT I.* FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TP on I.codTipoImovel = TP.codTipoImovel WHERE I.statusImovel = 'T' AND I.capaImovel = 'T' AND TP.codTipoImovel != 5";
	$resultImoveis = $conn->query($sqlImoveis);
	$dadosImoveis = $resultImoveis->fetch_assoc();
	
	if($dadosImoveis['codImovel'] != ""){
?>
            <div id="repete-imoveis-destaque">
                <div id="conteudo-imoveis-destaque">
                    <div id="bloco-titulo">
                        <p class="titulo">Imóveis</p>
						<p id="linha"></p>
						<p class="sub-titulo">Uma seleção especial de imóveis para você investir ou viver com qualidade em Balneário Gaivota.</p>
                    </div>
                    <div id="mostra-imoveis">
<?php
		$cont = 0;

		$sqlImoveis = "SELECT DISTINCT I.* FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TP on I.codTipoImovel = TP.codTipoImovel WHERE I.statusImovel = 'T' AND I.capaImovel = 'T' ORDER BY I.capaImovel DESC, I.codOrdenacaoImovel DESC, I.codImovel DESC LIMIT 0,12";
		$resultImoveis = $conn->query($sqlImoveis);
		while ($dadosImoveis = $resultImoveis->fetch_assoc()) {

			$cont++;

			$sqlCidade = "SELECT * FROM cidades WHERE codCidade = " . $dadosImoveis['codCidade'] . " LIMIT 0,1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();

			$sqlBairro = "SELECT * FROM bairros WHERE codBairro = " . $dadosImoveis['codBairro'] . " LIMIT 0,1";
			$resultBairro = $conn->query($sqlBairro);
			$dadosBairro = $resultBairro->fetch_assoc();

			$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = " . $dadosImoveis['codTipoImovel'] . " LIMIT 0,1";
			$resultTipoImovel = $conn->query($sqlTipoImovel);
			$dadosTipoImovel = $resultTipoImovel->fetch_assoc();

			$sqlImagem = "SELECT * FROM imoveisImagens WHERE codImovel = " . $dadosImoveis['codImovel'] . " ORDER BY ordenacaoImovelImagem ASC, codImovelImagem ASC LIMIT 0,1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();

			if ($dadosImoveis['precoImovel'] != "0.00") {
				$preco = "R$ " . number_format($dadosImoveis['precoImovel'], 2, ",", ".");
			} else {
				$preco = "A consultar";
			}

			if ($dadosImoveis['tipoCImovel'] == "V") {
				$tipoC = "Venda";
			} else {
				$tipoC = "Aluguel";
			}

			if ($cont == 4) {
				$cont = 0;
				$margin = "margin-right:0px;";
			} else {
				$margin = "";
			}
?>
									<div id="bloco-imovel" style="<?php echo $margin; ?> " class="wow animate__animated animate__fadeInUp">
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
					<p class="ver-mais" title="Ver mais Imóveis"><a href="<?php echo $configUrl; ?>imoveis/">MAIS IMÓVEIS</a></p>
                </div>
            </div>
<?php
	}
?>   
            <div id="repete-quemSomos">
<?php

	$sqlQuemSomos = "SELECT * FROM quemSomos WHERE codQuemSomos = 1 LIMIT 0,1";
	$resultQuemSomos = $conn->query($sqlQuemSomos);
	$dadosQuemSomos = $resultQuemSomos->fetch_assoc();

	$sqlImagem = "SELECT * FROM quemSomosImagens WHERE codQuemSomos = " . $dadosQuemSomos['codQuemSomos'] . " ORDER BY capaQuemSomosImagem ASC LIMIT 0,1";
	$resultImagem = $conn->query($sqlImagem);
	$dadosImagem = $resultImagem->fetch_assoc();

?>
                <div id="conteudo-quemSomos" class="wow animate__animated animate__fadeIn">
                    <div id="bloco-quemSomos">
                        <a href="<?php echo $configUrl; ?>a-imobiliaria/">
                            <div id="bloco-dados">
                                <div id="bloco-titulo">
                                    <p class="titulo">Quem Somos</p>
                                    <p id="linha"></p>
                                </div>
                                <div class="descricao"><?php echo nl2br($dadosQuemSomos['descricaoCQuemSomos']); ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

<?php
	$sqlBlog = "SELECT count(DISTINCT N.codBlog) total FROM blog N inner join blogImagens NI on N.codBlog = NI.codBlog WHERE N.statusBlog = 'T' and N.dataProBlog <= '" . date('Y-m-d') . " " . date('H:i:s') . "'";
	$resultBlog = $conn->query($sqlBlog);
	$dadosBlog = $resultBlog->fetch_assoc();

	if ($dadosBlog['total'] >= 1) {
?>
								<div id="repete-blog">
									<div id="conteudo-blog">
										<div id="bloco-titulo">
											<p class="titulo">Acompanhe as <span>Novidades</span></p>
											<div id="linha"></div>
										</div>
										<div id="mostra-blog" class="wow animate__animated animate__fadeInRight">
											<div class="owl-carrossel">
												<div class="row">
													<div class="large-12 columns">
														<div class="loop owl-carousel blogCarrossel owl-loaded owl-drag">
<?php
		$cont = 0;

		$sqlBlog = "SELECT DISTINCT N.* FROM blog N inner join blogImagens NI on N.codBlog = NI.codBlog WHERE N.statusBlog = 'T' and N.dataProBlog <= '" . date('Y-m-d') . " " . date('H:i:s') . "' ORDER BY N.dataBlog DESC, N.codBlog DESC";
		$resultBlog = $conn->query($sqlBlog);
		while ($dadosBlog = $resultBlog->fetch_assoc()) {

			$sqlImagem = "SELECT * FROM blogImagens WHERE codBlog = " . $dadosBlog['codBlog'] . " ORDER BY capaBlogImagem ASC, codBlogImagem ASC LIMIT 0,1";
			$resultImagem  = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();

			$cont++;
?>
																<div id="bloco-blog">
																	<a title="<?php echo $dadosBlog['nomeBlog']; ?>" href="<?php echo $configUrl . 'novidades/' . $dadosBlog['codBlog'] . '-' . $dadosBlog['urlBlog'] . '/'; ?>">
																		<p class="imagem" style="background:transparent url('<?php echo $configUrlGer . 'f/blog/' . $dadosImagem['codBlog'] . '-' . $dadosImagem['codBlogImagem'] . '-O.'.$dadosImagem['extBlogImagem']; ?>') center top no-repeat; background-size:cover, 100%;">
																			<div id="fundo">
																				<div class="bloco-nome">
																					<p class="nome"><?php echo $dadosBlog['nomeBlog']; ?></p>
																				</div>
																				<div class="bloco-descricao">
																					<p class="descricao"><?php echo strip_tags($dadosBlog['descricaoBlog']); ?></p>
																				</div>
																				<div id="fundo-confira">
																					<p class="confira">Ler mais<img src="<?php echo $configUrl . 'f/i/quebrado/seta-confira.svg'; ?>" width="15" alt=""></p>
																				</div>
																			</div>
																		</p>
																	</a>
																</div>
<?php
		}
?>
														</div>
													</div>
												</div>
											</div>
											<script>
												var $rfgs = jQuery.noConflict();
												var owl = $rfgs('.blogCarrossel');
												owl.owlCarousel({
													autoplay: false,
													autoplayTimeout: 20000,
													smartSpeed: 1000,
													fluidSpeed: 10000,
													items: 3,
													loop: true,
													autoWidth: true,
													margin: 0,
													nav: true,
													dots: true
												});
											</script>
										</div>
									</div>
								</div>
<?php
	}else{
?>
								<br/>
<?php		
	}
?>			
<?php
$sqlInstagram = "SELECT count(codInstagram) total FROM instagram WHERE statusInstagram = 'T'";
$resultInstagram = $conn->query($sqlInstagram);
$dadosInstagram = $resultInstagram->fetch_assoc();

if($dadosInstagram['total'] >= 1){
?>	
		<div id="repete-instagram">
			<div id="alinha-instagram">
				<div id="conteudo-instagram">
					<div id="titulo">
							<div id="bloco-titulo">
								<p class="titulo1">Siga-nos</p>
								<p class="titulo2">no <span>Instagram</span></p>
								<p id="linha"></p>
								<p class="sub-titulo">Acompanhe nossas atualizações e imóveis em destaque no instagram.</p>
							</div>
							<img src="f/i/quebrado/insta-insta.svg" alt="icon-insta" width="110px">
					</div>
					<div id="mostra-instagram">
<?php
	$cont = 0;

	$sqlInstagram = "SELECT * FROM instagram WHERE statusInstagram = 'T' ORDER BY timestamp DESC, codInstagram DESC LIMIT 0,3";
	$resultInstagram = $conn->query($sqlInstagram);
	while($dadosInstagram = $resultInstagram->fetch_assoc()){

		$cont++;

		if ($cont == 3) {
			$cont = 0;
			$margin = "margin-right:0px;";
		} else {
			$margin = "";
		}

		if ($dadosInstagram['media_type'] == "IMAGE" || $dadosInstagram['media_type'] == "CAROUSEL_ALBUM") {
?>
						<div id="bloco-instagram" style="<?php echo $margin; ?>" class="wow animate__animated animate__fadeIn">
							<a title="<?php echo $dadosInstagram['caption']; ?>" target="_blank" href="<?php echo $dadosInstagram['permalink']; ?>">
								<p class="hover-image"></p>
								<p class="imagem-instagram" style="background:transparent url('<?php echo $configUrlGer.'f/instagram/'.$dadosInstagram['id'].".jpg";?>') center center no-repeat; background-size:cover, 100%;"></p>
							</a>
						</div>
<?php
	} else {
?>
						<div id="bloco-instagram" style="<?php echo $margin; ?>" class="wow animate__animated animate__fadeIn">
							<a title="<?php echo $dadosInstagram['caption']; ?>" target="_blank" href="<?php echo $dadosInstagram['permalink']; ?>">
								<p class="hover-play"></p>
								<p class="imagem-instagram" style="background:transparent url('<?php echo $configUrlGer.'f/instagram/'.$dadosInstagram['id'].".jpg";?>') center center no-repeat; background-size:cover, 100%;"></p>
							</a>
						</div>
<?php
		}
	}
?>
					<br class="clear" />
				</div>
				<p class="acessar" title="Siga-nos no Instagrem!"><a target="_blank" href="https://www.instagram.com/<?php echo $instagram ?>">ACESSAR</a></p>
			</div>
		</div>
	</div>
<?php
}		
									
?>
        </div>
