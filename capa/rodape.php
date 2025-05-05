
<script type="text/javascript">
				var $th = jQuery.noConflict();
				var didScroll;
				var lastScrollTop = 0;
				var delta = 5;
				var navbarHeight = 150;

				$th(window).scroll(function(event) {
					didScroll = true;
				});

				setInterval(function() {
					if (didScroll) {
						hasScrolled();
						didScroll = false;
					}
				}, 250);

				function hasScrolled() {

					var st = $th(this).scrollTop();

					// Make sure they scroll more than delta
					if (Math.abs(lastScrollTop - st) <= delta)
						return;

					// If they scrolled down and are past the navbar, add class .nav-up.
					// This is necessary so you never see what is "behind" the navbar.
					if (st > lastScrollTop && st > navbarHeight) {
						// Scroll Down
						$th('.botao-whatsapp').css("right", "");
					} else {
						// Scroll Up
						if (st + $th(window).height() < $th(document).height()) {
							$th('.botao-whatsapp').css("right", "0px");
						}
					}
					lastScrollTop = st;
				}
			</script>
<?php		
	if(isset($_COOKIE['politica'.$cookie]) == ""){
?>
				<script>
					function salvaPolitica(){
						var $pol = jQuery.noConflict();															
						$pol("#politica-privacidade").fadeOut(200);
						$pol.post("<?php echo $configUrl;?>salva-politica.php", {cod: 1},function(data){
							$pol("#politica-privacidade").fadeOut(200);							
						});  																						
					}	
					
					function fadeInPolitica(){
						var $polF = jQuery.noConflict();															
						$polF("#politica-privacidade").fadeIn(200);						
					}			
				</script>
				<script type="text/javascript">
					function retiraCaptcha() {
						var $gt = jQuery.noConflict();
						$gt(".grecaptcha-badge").fadeOut("slow");
					}

					setTimeout("retiraCaptcha();", 2000);
				</script>
				<div id="politica-privacidade" style="display:none;" class="animate__animated animate__pulse animate__slow animate__infinite">
					<p class="texto">Ao navegar este site você concorda com as <a target="_blank" class="texto" href="<?php echo $configUrl;?>politica-de-privacidade/">políticas de privacidade</a>. <a class="botao-ok" onClick="salvaPolitica();">Ok</a> </p>
				</div>
<?php
	}
?>	
		<div id="repete-rodape">
            <div id="conteudo-rodape">
                <div id="col-esq-rodape">
                    <div id="logo-rodape">
                        <p class="logo"><a title="<?php echo $nomeEmpresa; ?>" href="<?php echo $configUrl; ?>"><img style="display:block; width: 230px;" src="<?php echo $configUrl; ?>f/i/quebrado/logo-rodape.png" width="100%" /></a></p>
                    </div>
                    <div id="dados-site">
						<div id="sup"> 
						   <p id="titulo-mapa" style="font-size: 34px; font-weight: 600; color: #041c40;">Menu</p>                
						   <div id="mapa-site">
								<li class="<?php echo $url[2] == "a-imobiliaria" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>a-imobiliaria/">A Imobiliária</a></li>
								<li class="<?php echo $url[2] == "imoveis" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>imoveis/">Imóveis</a></li>
								<li class="<?php echo $url[2] == "balneario-gaivota" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>balneario-gaivota/">Balneário Gaivota</a></li>
								<li class="<?php echo $url[2] == "depoimentos" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>depoimentos/">Depoimentos</a></li>
								<li class="<?php echo $url[2] == "novidades" ? 'ativo' : 'p'; ?>"><a href="<?php echo $configUrl; ?>novidades/">Novidades</a></li>
								<li class="<?php echo $url[2] == "contato" ? 'ativo' : 'p'; ?>"  style=" margin-right: 0px; padding-right: 0px;"><a  style=" margin-right: 0px; padding-right: 0px; cursor:pointer"  onclick="abrirAcesso()" >Contato</a></li>
                    		</div>
						</div>
						<div style="display: flex; margin-top:20px;">
							<div id="contato">
								<div id="enviar-contato">
									<p class="titulo">Solicite um Contato</p>
									<form action="<?php ECHO $configUrl.'sendEmail/' ?>" method="post">
										<input type="text" name="nomeContatoR" id="nomeContatoR" placeholder="Nome">
										<input type="text" name="celularContatoR" id="celularContatoR" placeholder="WhatsApp" onKeyDown="Mascara(this,novoTelefone);" onKeyPress="Mascara(this,novoTelefone);" onKeyUp="Mascara(this,novoTelefone);">
										<button type="" value="Enviar">ENVIAR</button>
									</form>
								</div>
							</div>
							<div id="inferior">
								<div style="display: flex;">
									<div class="facebook" <?php if( $facebook == ""){ ?> style="<?php if( $facebook == ""){ ?> display:none; <?php } ?>"<?php } ?> ><a target="_blank" title="Visite-nos no Facebook" href="https://www.facebook.com/<?php echo $facebook; ?>"><img style="display:block;  margin: 0px 5px;" src="<?php echo $configUrl; ?>f/i/quebrado/facebook-icon.png" width="29"  /></a></div>
									<div class="instagram"><a target="_blank" title="Siga-nos no Instagram" href="https://www.instagram.com/<?php echo $instagram; ?>"><img style="display:block; position: relative;" src="<?php echo $configUrl; ?>f/i/quebrado/instagram-icon.png" width="29" height="29" /></a></div>
								</div>
								<a target="_blank" title="Faça-nos uma visita!" href="<?php echo $rota; ?>" id="endereco"><?php echo $endereco ?></a>
							</div>
						</div>
                    </div>
                </div>
                <br class="clear" />
            </div>
        </div>
        <div id="repete-copy">
            <div id="conteudo-copy">
                <p class="politica"><a  href="<?php echo $configUrl; ?>politica-de-privacidade/">Política de Privacidade</a></p>
                <p class="copy">Copyright 2024 - Todos os direitos reservados - <?php echo $nomeEmpresaMenor; ?></p>
                <p class="softbest"><a target="_blank" title="Desenvolvido por: www.softbest.com.br" href="http://www.softbest.com.br"><img style="display:block;" src="<?php echo $configUrl; ?>f/i/logo-softbest-colorida.svg" width="60" /></a></p>
                <br class="clear" />
            </div>
        </div>

