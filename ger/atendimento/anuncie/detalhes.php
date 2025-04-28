<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "anuncie";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){
				
				$sqlInformacoes = "SELECT * FROM anuncie WHERE codAnuncie = '".$url[6]."'";
				$resultInformacoes = $conn->query($sqlInformacoes);
				$dadosInformacoes = $resultInformacoes->fetch_assoc();
?>
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Atendimento</p>
						<p class="flexa"></p>
						<p class="nome-lista">Anuncie seu Imóvel</p>
						<p class="flexa"></p>
						<p class="nome-lista">Detalhes</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosInformacoes['nomeAnuncie'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
						<tr class="tr-interno">
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosInformacoes['codAnuncie'] ?>, "<?php echo htmlspecialchars($dadosInformacoes['nomeAnuncie']) ?>");' title='Deseja excluir o anuncie <?php echo $dadosInformacoes['nomeAnuncie'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
						</tr>
						<script>
							function confirmaExclusao(cod, nome){
								if(confirm("Deseja excluir o anuncie "+nome+"?")){
									window.location='<?php echo $configUrl; ?>atendimento/anuncie/excluir/'+cod+'/';
								}
							}
						</script>
					</table>	
					<div class="botao-consultar"><a title="Consultar Anuncies" href="<?php echo $configUrl;?>atendimento/anuncie/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
					<br class="clear" />
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">
						<div class="detalhes-esq">
		
							<p class="bloco-campo"><label>Data:</label>
							<?php echo data($dadosInformacoes['dataAnuncie']);?></p>	
														
							<p class="bloco-campo"><label>Nome:</label>
							<?php echo $dadosInformacoes['nomeAnuncie'];?></p>									
		
							<p class="bloco-campo"><label>Celular:</label>
							 <?php echo $dadosInformacoes['celularAnuncie'];?></p>								
		
							<p class="bloco-campo"><label>E-mail:</label>
							 <?php echo $dadosInformacoes['emailAnuncie'];?></p>								
		
							<p class="bloco-campo"><label>Tipo Imóvel:</label>
							 <?php echo $dadosInformacoes['tipoImovelAnuncie'];?></p>								
		
							<p class="bloco-campo"><label>Operação:</label>
							 <?php echo $dadosInformacoes['operacaoAnuncie'];?></p>								
		
							<p class="bloco-campo"><label>Endereço Completo:</label>
							 <?php echo $dadosInformacoes['enderecoAnuncie'];?></p>								
		
							<p class="bloco-campo"><label>Área do Terreno:</label>
							 <?php echo $dadosInformacoes['areaAnuncie'];?>m²</p>								
		
							<p class="bloco-campo"><label>Área do Construída:</label>
							 <?php echo $dadosInformacoes['areaCAnuncie'];?>m²</p>								
		
							<p class="bloco-campo"><label>Quartos:</label>
							 <?php echo $dadosInformacoes['quartosAnuncie'];?></p>								
		
							<p class="bloco-campo"><label>Banheiros:</label>
							 <?php echo $dadosInformacoes['banheirosAnuncie'];?></p>								
		
							<p class="bloco-campo"><label>Suítes:</label>
							 <?php echo $dadosInformacoes['suitesAnuncie'];?></p>								
		
							<p class="bloco-campo"><label>Vagas na Garagem:</label>
							 <?php echo $dadosInformacoes['garagemAnuncie'];?></p>								

						</div>

						<br class="clear" />
						
						<div class="bloco-campo" style="margin-top:20px;"><label>Outras Caracteríticas:</label>
						<?php echo $dadosInformacoes['descricaoAnuncie'];?></div>		
					</div>
				</div>
<?php
			}else{
?>
				<div id="filtro">
					<div id="erro-permicao">	
<?php
				echo "<p><strong>Você não tem permissão para acessar essa área!</strong></p>";
				echo "<p>Para mais informações entre em anuncie com o administrador!</p>";
?>	
					</div>
				</div>
<?php
			}

		}else{
			echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."controle-acesso.php'>";
		}

	}else{
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."login.php'>";
	}
?>
