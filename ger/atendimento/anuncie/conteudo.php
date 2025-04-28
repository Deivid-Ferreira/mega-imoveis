<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "anuncie";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['ativar'] == "ok"){
					$erroConteudo = "<p class='erro'>Anuncie <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativar'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['excluir'] == "ok"){
					$erroConteudo = "<p class='erro'>Anuncie <strong>".$_SESSION['nome']."</strong> excluído com sucesso!</p>";
					$_SESSION['excluir'] = "";
					$_SESSION['nome'] = "";
				}

				if(isset($_POST['statusFiltro'])){
					if($_POST['statusFiltro'] != ""){
						$_SESSION['statusFiltro'] = $_POST['statusFiltro'];
					}else{
						$_SESSION['statusFiltro'] = "";
					}
				}
				
				if($_SESSION['statusFiltro'] != ""){
					$filtraStatus = " and statusAnuncie = '".$_SESSION['statusFiltro']."'";
				}	
?>

				<div id="filtro">							
					<div id="localizacao-filtro">
						<p class="nome-lista">Atendimento</p>
						<p class="flexa"></p>
						<p class="nome-lista">Anuncie seu Imóvel</p>	
						<br class="clear"/>
					</div>
					<div class="demoTarget">
						<div id="formulario-filtro">
							<script>
								function enviar(){
									document.filtro.submit(); 
								}
							</script>
							<script type="text/javascript">
								function alteraStatus(status){
									document.getElementById("filtroStatus").submit();
								}
							</script>
							<form id="filtroStatus" action="<?php echo $configUrl;?>atendimento/anuncie/" method="post" >

								<p class="nome-clientes-filtro" style="width:218px;"><label class="label">Filtrar Nome:</label>
								<input type="text" style="width:200px;" name="anuncie" onKeyUp="buscaAvancada();" id="busca" autocomplete="off" value="<?php echo $_SESSION['nome-anuncie-filtro'];?>" /></p>
								<input style="display:none;" type="text" size="16" name="teste" value="" />

								<p class="bloco-campo-float"><label>Filtrar Status: <span class="obrigatorio"> </span></label>
									<select class="campo" name="statusFiltro" style="width:155px; padding:6px;" required onChange="alteraStatus(this.value);">
										<option value="">Todos</option>
										<option value="T" <?php echo $_SESSION['statusFiltro'] == "T" ? '/SELECTED/' : '';?>>Ativo</option>
										<option value="F" <?php echo $_SESSION['statusFiltro'] == "F" ? '/SELECTED/' : '';?>>Inativo</option>
									</select>
								</p>	
								
								<br class="clear" />
							</form>
						</div>
					</div>
				</div>
				<div id="dados-conteudo">
					<div id="consultas">
					
					
<?php	
				if($erroConteudo != ""){
?>
						<div class="area-erro">
<?php
					echo $erroConteudo;	
?>
						</div>
<?php
				}
?>
						<script type="text/javascript">
							function buscaAvancada(){
								var $AGD = jQuery.noConflict();
								var busca = $AGD("#busca").val();
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								busca = busca.replace(" ", "-");
								$AGD("#busca-carregada").load("<?php echo $configUrl;?>atendimento/anuncie/busca-anuncie.php?busca="+busca);
								if(busca == ""){
									document.getElementById("paginacao").style.display="block";
								}else{
									document.getElementById("paginacao").style.display="none";
								}
							}	
						</script>
						<div id="busca-carregada">
<?php
				$sqlConta = "SELECT * FROM anuncie WHERE codAnuncie != ''".$filtraUsuario.$filtraUsuarioF.$filtraStatus."";
				$resultConta = $conn->query($sqlConta);
				$dadosConta = $resultConta->fetch_assoc();
				$registros = mysqli_num_rows($resultConta);
				
				if($dadosConta['nomeAnuncie'] != ""){
?>
							<table class="tabela-menus" >
								<tr class="titulo-tabela" border="none">
									<th class="canto-esq" >Nome</th>
									<th>Celular</th>
									<th>Data</th>
									<th>Status</th>
									<th class="canto-dir">Excluir</th>
								</tr>					
<?php
				}
				
				if($url[5] == 1 || $url[5] == ""){
					$pagina = 1;
					$sqlAnuncies = "SELECT * FROM anuncie WHERE codAnuncie != ''".$filtraUsuario.$filtraUsuarioF.$filtraStatus." ORDER BY statusAnuncie ASC, dataAnuncie DESC, codAnuncie DESC LIMIT 0,30";
				}else{
					$pagina = $url[5];
					$paginaFinal = $pagina * 30;
					$paginaInicial = $paginaFinal - 30;
					$sqlAnuncies = "SELECT * FROM anuncie WHERE codAnuncie != ''".$filtraUsuario.$filtraUsuarioF.$filtraStatus." ORDER BY statusAnuncie ASC, dataAnuncie DESC, codAnuncie DESC LIMIT ".$paginaInicial.",30";
				}		

				$resultAnuncies = $conn->query($sqlAnuncies);
				while($dadosAnuncies = $resultAnuncies->fetch_assoc()){
					$mostrando++;
					
					if($dadosAnuncies['statusAnuncie'] == "T"){
						$status = "status-ativo";
						$statusIcone = "ativado";
						$statusPergunta = "desativar";
					}else{
						$status = "status-desativado";
						$statusIcone = "desativado";
						$statusPergunta = "ativar";
					}
?>

								<tr class="tr">
									<td class="sessenta"><a href='<?php echo $configUrlGer; ?>atendimento/anuncie/detalhes/<?php echo $dadosAnuncies['codAnuncie'] ?>/' title='Veja os detalhes do anuncie <?php echo $dadosAnuncies['nomeAnuncie'] ?>'><?php echo $dadosAnuncies['nomeAnuncie'];?></a></td>
									<td class="vinte" style="text-align:center;"><a href='<?php echo $configUrlGer; ?>atendimento/anuncie/detalhes/<?php echo $dadosAnuncies['codAnuncie'] ?>/' title='Veja os detalhes do anuncie <?php echo $dadosAnuncies['nomeAnuncie'] ?>'><?php echo $dadosAnuncies['celularAnuncie'];?></a></td>
									<td class="dez" style="text-align:center;"><a href='<?php echo $configUrlGer; ?>atendimento/anuncie/detalhes/<?php echo $dadosAnuncies['codAnuncie'] ?>/' title='Veja os detalhes do anuncie <?php echo $dadosAnuncies['nomeAnuncie'] ?>'><?php echo data($dadosAnuncies['dataAnuncie']);?></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>atendimento/anuncie/ativacao/<?php echo $dadosAnuncies['codAnuncie'] ?>/' title='Deseja <?php echo $statusPergunta ?> o anuncie <?php echo $dadosAnuncies['nomeAnuncie'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosAnuncies['codAnuncie'] ?>, "<?php echo htmlspecialchars($dadosAnuncies['nomeAnuncie']) ?>");' title='Deseja excluir o anuncie <?php echo $dadosAnuncies['nomeAnuncie'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
				}
?>
								<script>
									 function confirmaExclusao(cod, nome){

										if(confirm("Deseja excluir o anuncie "+nome+"?")){
											window.location='<?php echo $configUrlGer; ?>atendimento/anuncie/excluir/'+cod+'/';
										}
									  }
								 </script>
								 
							</table>							
						</div>
<?php
				if($url[3] != ""){
					$regPorPagina = 30;
					$area = "atendimento/anuncie";
					include ('f/conf/paginacao.php');
				}		
?>							
					</div>
				</div>
<?php
			}else{
?>	
				<div id="filtro">
					<div id="erro-permicao">	
<?php
				echo "<p><strong>Vocês não tem permissão para acessar essa área!</strong></p>";
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
