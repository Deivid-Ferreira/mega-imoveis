				<script type="text/javascript">
					function leadWhatsApp(cod, area){
						var $FL = jQuery.noConflict();
						var nomeLead = document.getElementById("nomeContato"+cod).value;
						var celularLead = document.getElementById("celularContato"+cod).value;
						var siteLocal = area;
						$FL("#loading-fundo").fadeIn(250);
						$FL("#loading-icone").fadeIn(250);								
						grecaptcha.execute('<?php echo $chaveSite;?>', {action: 'action_form'}).then(function(token) {
							$FL.post("<?php echo $configUrl;?>salvaLead.php", {nomeLead: nomeLead, celularLead: celularLead, siteLocal: siteLocal, token: token, action: "action_form"}, function(data){
								if(data.trim() == "ok"){
									$FL("#nomeContato"+cod).val("");									
									$FL("#celularContato"+cod).val("");	
									$FL("#loading-fundo").fadeOut(250);
									$FL("#loading-icone").fadeOut(250);
									$FL(".blackout").fadeOut(250);
									$FL("#popup").fadeOut(250);
									window.open("<?php echo $configUrl;?>contato-whatsapp-enviado/?numero=<?php echo $celularWhats;?>&msg=<?php echo $whatsAppMsg;?>", "_blank");					
								}else
								if(data.trim() == "erro sql lead"){
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: #100");
								}else
								if(data.trim() == "erro captcha"){
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: #200");
								}else{
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: desconhecido");
								}
								
								return false										
							});
						});
						
						return false;
						
						//Erro #100: Erro ao inserir Lead;
						//Erro #200: Erro ao Captcha;
					}	

					function fechaAcesso(){
						var $FLs = jQuery.noConflict();
						$FLs(".blackout").fadeOut(250);
						$FLs("#popup").fadeOut(250);
					}														

					function abrirAcesso(){
						var $FLgs = jQuery.noConflict();
						$FLgs(".blackout").fadeIn(250);
						$FLgs("#popup").fadeIn(250);
					}														
				</script> 
				<p class="blackout" style="display:none;" onClick="fechaAcesso();"></p>
				<div id="popup" style="display:none;">
					<p class="x" onClick="fechaAcesso();">X</p>
					<p class="logo"><img style="display:block;" src="<?php echo $configUrl;?>f/i/quebrado/logo-whats-2.svg" width="230"/></p>
					<p class="titulo">Chame-nos no WhatsApp.</p>
					<p class="titulo2">Solicite um contato de um corretor.</p>
					<form id="targetFormTopo" action="<?php echo $configUrl;?>" method="post" onSubmit="return false, leadWhatsApp('P', 'S');">
						<p class="campo-nome"><input type="text" id="nomeContatoP" value="" placeholder="Nome" required /></p>
						<p class="campo-whats"><input type="text" id="celularContatoP" value="" placeholder="WhatsApp" required onKeyDown="Mascara(this,novoTelefone);" onKeyPress="Mascara(this,novoTelefone);" onKeyUp="Mascara(this,novoTelefone);" /></p>
						<p class="botao-envia"><input type="submit" value="Iniciar Atendimento"/></p>
					</form>
				</div> 
			   <div id="repete-topo">
                    <div id="conteudo-topo">
                        <div id="esq-topo">
                            <div id="logo-topo">
                                <p class="logo"><a title="<?php echo $nomeEmpresa; ?>" href="<?php echo $configUrl; ?>"><img id="logo-img" style="display:block;" src="<?php echo $configUrl; ?>f/i/quebrado/normal.png" width="100%" /></a></p>
                            </div>
                        </div>
                        <div id="dir-topo">
							<div id="redes">
								<p class="whatsapp">WhatsApp</p>
								<a class="facebook" target="_blank" title="Curta nossa página no Facebook" href="www.facebook.com"></a>
								<a class="instagram" target="_blank" title="Siga-nos no Instagram" href="www.instagram.com"></a>
							</div>
							<div id="mostra-menu">
                                <p class="<?php echo $url[2] == "a-imobiliaria" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>a-imobiliaria/">A Imobiliária</a></p>
                                <p class="<?php echo $url[2] == "imoveis" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>imoveis/">Imóveis</a></p>
                                <p class="<?php echo $url[2] == "balneario-gaivota" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>balneario-gaivota/">Balneário Gaivota</a></p>     
                                <p class="<?php echo $url[2] == "depoimentos" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>depoimentos/">Depoimentos</a></p>
                                <p class="<?php echo $url[2] == "novidades" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>novidades/">Novidades</a></p>
                                <p class="<?php echo $url[2] == "contato" ? 'ativo' : ''; ?>" style="margin-right: 0px;" ><a onclick="abrirAcesso();" style="cursor:pointer;" >Contato</a></p>
                            </div>
                        </div>
                    </div>
                </div>
