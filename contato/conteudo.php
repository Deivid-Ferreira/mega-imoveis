					<div id="conteudo-interno">	
						<div id="repete-detalhes-contato">			
							<div id="bloco-titulo">
									<p class="titulo">CONTATO</p>
							</div>	
						<div id="conteudo-contato">
							<div id="bloco-total" style="margin-bottom:15px; <?php echo $_SESSION['erro'] == "" ? "display:none;" : "display:block;";?>">	
								<div id="area-erro" style="<?php echo $_SESSION['backgroundColor'];?> <?php echo $_SESSION['erro'] == "" ? "display:none;" : "display:block;";?>"><?php echo $_SESSION['erro'];?></div>
							</div>																								
							<form id="targetForm" onsubmit="sendToWhatsApp(event)">
								<div id="col-esq-fale">
									<p class="descricao-area">Para entrar em contato com a <strong><?php echo $nomeEmpresaMenor;?></strong>, basta preencher todos os campos, enviar e em breve responderemos você.</p>									
									
									<input type="hidden" value="<?php echo $_SESSION['assunto'];?>" name="assunto"/>
									
									<p class="campos-padrao"><label class="label">Nome<span class="obrigatorio"> * </span></label><br/>
									<input id="nome" class="input" type="text" style="width:520px;" required name="nome" value="<?php echo $_SESSION['nome']; ?>" /></p>
											
									<br class="clear"/>		
											
									<p class="campos-padrao-float"><label class="label">Cidade<span class="obrigatorio"> * </span></label><br/>
									<input id="cidade" class="input" type="text" style="width:255px;" required name="cidade" value="<?php echo $_SESSION['cidade']; ?>" /></p>
																																
									<p class="campos-padrao-float campos-select" style="margin-right:0px;"><label class="label">Estado<span class="obrigatorio"> * </span></label><br/>
										<select  id="estado" class="select" name="estado" required>
											<option value="">Selecione</option>
											<option value="AC" <?php echo $_SESSION['estado'] == 'AC' ? '/SELECTED/' : ''; ?>>AC</option>
											<option value="AL" <?php echo $_SESSION['estado'] == 'AL' ? '/SELECTED/' : ''; ?>>AL</option>
											<option value="AP" <?php echo $_SESSION['estado'] == 'AP' ? '/SELECTED/' : ''; ?>>AP</option>
											<option value="AM" <?php echo $_SESSION['estado'] == 'AM' ? '/SELECTED/' : ''; ?>>AM</option>
											<option value="BA" <?php echo $_SESSION['estado'] == 'BA' ? '/SELECTED/' : ''; ?>>BA</option>
											<option value="CE" <?php echo $_SESSION['estado'] == 'CE' ? '/SELECTED/' : ''; ?>>CE</option>
											<option value="DF" <?php echo $_SESSION['estado'] == 'DF' ? '/SELECTED/' : ''; ?>>DF</option>
											<option value="ES" <?php echo $_SESSION['estado'] == 'ES' ? '/SELECTED/' : ''; ?>>ES</option>
											<option value="GO" <?php echo $_SESSION['estado'] == 'GO' ? '/SELECTED/' : ''; ?>>GO</option>
											<option value="MA" <?php echo $_SESSION['estado'] == 'MA' ? '/SELECTED/' : ''; ?>>MA</option>
											<option value="MT" <?php echo $_SESSION['estado'] == 'MT' ? '/SELECTED/' : ''; ?>>MT</option>
											<option value="MS" <?php echo $_SESSION['estado'] == 'MS' ? '/SELECTED/' : ''; ?>>MS</option>
											<option value="MG" <?php echo $_SESSION['estado'] == 'MG' ? '/SELECTED/' : ''; ?>>MG</option>
											<option value="PR" <?php echo $_SESSION['estado'] == 'PR' ? '/SELECTED/' : ''; ?>>PR</option>
											<option value="PB" <?php echo $_SESSION['estado'] == 'PB' ? '/SELECTED/' : ''; ?>>PB</option>
											<option value="PA" <?php echo $_SESSION['estado'] == 'PA' ? '/SELECTED/' : ''; ?>>PA</option>
											<option value="PE" <?php echo $_SESSION['estado'] == 'PE' ? '/SELECTED/' : ''; ?>>PE</option>
											<option value="PI" <?php echo $_SESSION['estado'] == 'PI' ? '/SELECTED/' : ''; ?>>PI</option>
											<option value="RN" <?php echo $_SESSION['estado'] == 'RN' ? '/SELECTED/' : ''; ?>>RN</option>
											<option value="RS" <?php echo $_SESSION['estado'] == 'RS' ? '/SELECTED/' : ''; ?>>RS</option>
											<option value="RJ" <?php echo $_SESSION['estado'] == 'RJ' ? '/SELECTED/' : ''; ?>>RJ</option>
											<option value="RO" <?php echo $_SESSION['estado'] == 'RO' ? '/SELECTED/' : ''; ?>>RO</option>
											<option value="RR" <?php echo $_SESSION['estado'] == 'RR' ? '/SELECTED/' : ''; ?>>RR</option>
											<option value="SC" <?php echo $_SESSION['estado'] == 'SC' ? '/SELECTED/' : ''; ?>>SC</option>
											<option value="SE" <?php echo $_SESSION['estado'] == 'SE' ? '/SELECTED/' : ''; ?>>SE</option>
											<option value="SP" <?php echo $_SESSION['estado'] == 'SP' ? '/SELECTED/' : ''; ?>>SP</option>
											<option value="TO" <?php echo $_SESSION['estado'] == 'TO' ? '/SELECTED/' : ''; ?>>TO</option>
									   </select>
									</p>

									<br class="clear"/>		
								
									<p class="campos-padrao-float"><label class="label">Celular<span class="obrigatorio"> * </span></label><br/>
									<input id="celular" class="input" type="text" style="width:205px;" required name="celular" value="<?php echo $_SESSION['celular']; ?>" onKeyDown="Mascara(this,novoTelefone);" onKeyPress="Mascara(this,novoTelefone);" onKeyUp="Mascara(this,novoTelefone);"/></p>			
																								
									<p class="campos-padrao"><label class="label">E-mail<span class="obrigatorio"> </span></label><br/>
									<input  id="email" class="input" type="email"  name="email" style="width:273px;" value="<?php echo $_SESSION['email']; ?>" /></p>									

									<br class="clear"/>

									<p class="campos-descricao"><label class="label">Mensagem<span class="obrigatorio"> * </span></label><br/>
									<textarea id="mensagem" class="desabilita input-textarea" required name="descricao" ></textarea></p>
									
									<p class="preenchimento-obrigatorio">Preenchimento Obrigatório *</p>

									<div id="botao-enviar">
										
										<button  class="enviar" type="submit">Enviar para WhatsApp</button>
									</div>									

									<br class="clear"/>
								</div>							
								<div id="col-dir-fale">
									<p class="celular"><a title="Clique para Chamar no WhatsApp!" onClick="abrirAcesso();"><?php echo $celular;?></a></p>
									<br class="clear"/>
									<p class="endereco"><a target="_blank" title="Clique aqui fazer uma rota" href="<?php echo $rota;?>"><?php echo $endereco;?></a></p>
									<p class="atendimento" style=" <?php if($atendimento == '') { echo 'display:none;'; } ?>"><?php echo $atendimento;?></p>
									<div id="mapa">
										<?php echo $mapa;?>
									</div>
									<script>
										var $dg = jQuery.noConflict();
										$dg("#mapa iframe").css("height", "375px");
									</script>
								</div>
								<br class="clear"/>								
								
							</form>																		
						</div>
						</div>
					</div>	
<?php
	$_SESSION['erro'] = "";

			$celularWhats = str_replace(["(", ")", " ", "-"], "", $celular);
			$whatsAppCelular = !empty($celularWhats) ? $celularWhats : $currentWhatsApp;
?>
			<script>
				function sendToWhatsApp(event) {
					event.preventDefault();

					const nome = document.getElementById('nome').value;
					const cidade = document.getElementById('cidade').value;
					const estado = document.getElementById('estado').value;
					const celular = document.getElementById('celular').value;
					const email = document.getElementById('email').value;
					const mensagem = document.getElementById('mensagem').value;

					const whatsappNumber = "<?php echo $whatsAppCelular; ?>";
					const textMessage = `Olá, meu nome é *${nome}* e entrei em contato através do site. E-mail : *${email}*. Cidade: *${cidade}*, Estado: *${estado}*. Mensagem: *${mensagem}*.				`;
					const url = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(textMessage)}`;

					window.open(url, '_blank');
				}
			</script>
