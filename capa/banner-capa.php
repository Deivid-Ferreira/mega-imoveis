

		<div id="conteudo-banner">
			<div id="contato">
				<form action="">
					<div id="fundo">
						<p class="titulo">Solicite um contato de nossos corretores!</p>
						<div id="mostra-formulario">
							<p class="nome">Nome</p>
							<input type="text" name="nomeContatoR" id="nomeContatoR"  placeholder="Digite seu Nome:">
							<p class="whatsapp">WhatsApp</p>
							<input type="text" name="celularContatoR" id="celularContatoR" placeholder="Digite seu WhatsApp:" onKeyDown="Mascara(this,novoTelefone);" onKeyPress="Mascara(this,novoTelefone);" onKeyUp="Mascara(this,novoTelefone);">
							<p class="menssagem">Menssagem</p>
							<textarea name="menssagem" id="menssagem" placeholder="Digite sua mensagem" style="padding-left: 6px; width: 273px;"></textarea>
							<div id="botao">
								<button type="text" value="Enviar">ENVIAR</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div id="bloco-banner">
				<div class="owl-carrossel">
					<div class="row">
						<div class="large-12 columns">
							<div class="loop owl-carousel bannerCapa owl-loaded owl-drag">
<?php
								$cont = 0;
							 	$sqlBanner = "SELECT * FROM banners WHERE statusBanner = 'T' ORDER BY codOrdenacaoBanner ASC";
								$resultBanner = $conn->query($sqlBanner);
								while ($dadosBanner =  $resultBanner->fetch_assoc()) {
								 	$sqlImagem = "SELECT * FROM bannersImagens WHERE codBanner = '" . $dadosBanner['codBanner'] . "' ORDER BY codBannerImagem ASC LIMIT 0,1";
									$resultImagem =  $conn->query($sqlImagem);
									$dadosImagem = $resultImagem->fetch_assoc();

									if ($dadosImagem['extBannerImagem'] != "") {

										$cont++;

										if ($dadosImagem['extBannerImagem'] != "mp4" && $dadosImagem['extBannerImagem'] != "MP4") {

											if ($dadosBanner['linkBanner'] != "") {

												if ($dadosBanner['novaAbaBanner'] == "S") {
													$target = "target='_blank'";
												} else {
													$target = "";
												}
?>
											<li class="imagem"><a class="imagem-banner" <?php echo $target; ?> title="<?php echo $dadosBanner['nomeBanner']; ?>" href="<?php echo $dadosBanner['linkBanner']; ?>" <?php if (strpos($dadosBanner['linkBanner'], 'api.whatsapp.com') !== false) { ?> onClick="event.preventDefault(); abrirAcesso('<?php echo $dadosBanner['linkBanner']; ?>');" <?php } ?> style="width:100%; height:100vh; background:transparent url('<?php echo $configUrlGer . 'f/banners/' . $dadosImagem['codBanner'] . '-' . $dadosImagem['codBannerImagem'] . '-O.' . $dadosImagem['extBannerImagem']; ?>') center center no-repeat;background-size: cover;"> </a></li>
<?php
											} else {
?>
												<li class="imagem-banner" style="width:100%; height:100vh; background:transparent url('<?php echo $configUrlGer . 'f/banners/' . $dadosImagem['codBanner'] . '-' . $dadosImagem['codBannerImagem'] . '-O.' . $dadosImagem['extBannerImagem'];; ?>') center center no-repeat;background-size: cover;"></li>
<?php
											}
										} else {
?>
											<li class="imagem-banner">
												<video id="video" class="vid" poster="<?php echo $configUrl . 'f/i/quebrado/igreja.png'; ?>" disablePictureInPicture autoplay  poster="<?php echo $configUrl. 'f/i/quebrado/igreja.png'; ?>"  controlsList="nodownload" style="width: 100vw; height: 100vh; object-fit: cover; display: block;" src="<?php echo $configUrlGer . 'f/banners/' . $dadosImagem['codBanner'] . '-' . $dadosImagem['codBannerImagem'] . '-O.' . $dadosImagem['extBannerImagem']; ?>" type="video/mp4" loop muted></video>
											</li>
<?php
										}
									}
								}
?>
							</div>
						</div>
					</div>
				</div>
				<script>
					var $rfg = jQuery.noConflict();
					var owl = $rfg('.bannerCapa');
					owl.owlCarousel({
						autoplay: true,
						speed: 1500,
						autoplayTimeout: 10000,
						smartSpeed: 1000,
						fluidSpeed: 1000,
						items: 1,
						loop: true,
						videoHeight: 930,
						video: true,
						lazyLoad: true,
						lazyLoad: true,
						autoWidth: false,
						autoplayHoverPause: false

					});
				</script>
			</div>
		</div>
