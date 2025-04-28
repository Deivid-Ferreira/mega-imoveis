
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
                        <p class="logo"><a title="<?php echo $nomeEmpresa; ?>" href="<?php echo $configUrl; ?>"><img style="display:block; width: 330px;" src="<?php echo $configUrl; ?>f/i/quebrado/logo-rodape.png" width="100%" /></a></p>
                    </div>
                    <div id="dados-site">
                        <div style="display: flex; justify-content: end; margin-top: 15px;">
                            <p class="celular"><a target="_blank" title="Chame-nos no WhatsApp"  onClick="abrirAcesso();"></a></p>
                            <p class="instagram"><a target="_blank" title="Siga-nos no Instagram" href="https://www.instagram.com/<?php echo $instagram; ?>"></a></p>
                            <p class="email"><a target="_blank" title="Nosso E-mail" href="mailto:<?php echo $email; ?>"></a></p>
                        </div>
						<div id="creci" ><p><?php echo $creci ?></p></div>
                        <p class="endereco"><a target="_blank" title="Clique para fazer uma rota" href="<?php echo $rota; ?>"><?php echo $endereco; ?></a></p>
                    </div>
                </div>
                <br class="clear" />
            </div>
        </div>
        <div id="repete-copy">
            <div id="conteudo-copy">
                <p class="politica" style="float:left; margin-right:20px; border-right:1px solid #ccc; padding-right:20px; margin-top:3px;"><a style="display:block; color:#00343f; font-size:14px;" href="<?php echo $configUrl; ?>politica-de-privacidade/">Política de Privacidade</a></p>
                <p class="copy">Copyright 2024 - Todos os direitos reservados - <?php echo $nomeEmpresaMenor; ?></p>
                <p class="softbest"><a target="_blank" title="Desenvolvido por: www.softbest.com.br" href="http://www.softbest.com.br"><img style="display:block;" src="<?php echo $configUrl; ?>f/i/logo-softbest-colorida.svg" width="60" /></a></p>
                <br class="clear" />
            </div>
        </div>
        <script type="text/javascript">
            function retiraCaptcha() {
                var $gt = jQuery.noConflict();
                $gt(".grecaptcha-badge").fadeOut("slow");
            }

            setTimeout("retiraCaptcha();", 2000);
        </script>
<?php
	if($_COOKIE['politica'.$cookie] == ""){
?>
            <script>
                function salvaPolitica() {
                    var $pol = jQuery.noConflict();
                    $pol("#politica-privacidade").fadeOut(200);
                    $pol.post("<?php echo $configUrl; ?>salva-politica.php", {
                        cod: 1
                    }, function(data) {
                        $pol("#politica-privacidade").fadeOut(200);
                    });
                }

                function fadeInPolitica() {
                    var $polF = jQuery.noConflict();
                    $polF("#politica-privacidade").fadeIn(200);
                }
            </script>
            <div id="politica-privacidade" style="display:none;" class="animate__animated animate__pulse animate__slow animate__infinite">
                <p class="texto">Ao navegar este site você concorda com as <a target="_blank" class="texto" href="<?php echo $configUrl; ?>politica-de-privacidade/">políticas de privacidade</a>. <a class="botao-ok" onClick="salvaPolitica();">Ok</a> </p>
            </div>
<?php
	}
?>
