<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "servicos";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['cadastro'] == "ok"){
					$erroConteudo = "<p class='erro'>Serviço <strong>".$_SESSION['nome']."</strong> cadastrado com sucesso!</p>";
					$_SESSION['cadastro'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['alteracao'] == "ok"){
					$erroConteudo = "<p class='erro'>Serviço <strong>".$_SESSION['nome']."</strong> alterado com sucesso!</p>";
					$_SESSION['alteracao'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['data'] = "";
					$_SESSION['descricao'] = "";
				}else	
				if($_SESSION['ativacao'] == "ok"){
					$erroConteudo = "<p class='erro'>Serviço <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativacao'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['exclusao'] == "ok"){
					$erroConteudo = "<p class='erro'>Serviço <strong>".$_SESSION['nome']."</strong> excluído com sucesso!</p>";
					$_SESSION['exclusao'] = "";
					$_SESSION['nome'] = "";
				}			

				if(isset($_POST['sobe']) || isset($_POST['desce'])){
					if(isset($_POST['sobe'])){
						$sqlNovaPosicao = "SELECT codOrdenacaoServico FROM servicos WHERE codOrdenacaoServico < ".$_POST['codOrdenacao']." ORDER BY codOrdenacaoServico DESC LIMIT 0,1";
						$resultNovaPosicao = $conn->query($sqlNovaPosicao);
						$dadosNovaPosicao = $resultNovaPosicao->fetch_assoc();
						
						$sqlCodAntigo = "SELECT codServico FROM servicos WHERE codOrdenacaoServico = ".$dadosNovaPosicao['codOrdenacaoServico'];
						$resultCodAntigo = $conn->query($sqlCodAntigo);
						$dadosCodAntigo = $resultCodAntigo->fetch_assoc();
						
						$updateSobe = "UPDATE servicos SET codOrdenacaoServico = ".$dadosNovaPosicao['codOrdenacaoServico']." WHERE codServico = ".$_POST['codServico'];
						$resultSobe = $conn->query($updateSobe);
						
						$updateDesce = "UPDATE servicos SET codOrdenacaoServico = ".$_POST['codOrdenacao']." WHERE codServico = ".$dadosCodAntigo['codServico'];
						$resultDesce = $conn->query($updateDesce);
					}else{
						$sqlNovaPosicao = "SELECT codOrdenacaoServico FROM servicos WHERE codOrdenacaoServico > ".$_POST['codOrdenacao']." ORDER BY codOrdenacaoServico ASC LIMIT 0,1";
						$resultNovaPosicao = $conn->query($sqlNovaPosicao);
						$dadosNovaPosicao = $resultNovaPosicao->fetch_assoc();
						
						$sqlCodAntigo = "SELECT codServico FROM servicos WHERE codOrdenacaoServico = ".$dadosNovaPosicao['codOrdenacaoServico'];
						$resultCodAntigo = $conn->query($sqlCodAntigo);
						$dadosCodAntigo = $resultCodAntigo->fetch_assoc();
						
						$updateSobe = "UPDATE servicos SET codOrdenacaoServico = ".$dadosNovaPosicao['codOrdenacaoServico']." WHERE codServico = ".$_POST['codServico'];
						$resultSobe = $conn->query($updateSobe);
						
						$updateDesce = "UPDATE servicos SET codOrdenacaoServico = ".$_POST['codOrdenacao']." WHERE codServico = ".$dadosCodAntigo['codServico'];
						$resultDesce = $conn->query($updateDesce);			
					}
				}	
?>

				<div id="filtro">
					<div id="localizacao-filtro">
						<p class="nome-lista">Site</p>
						<p class="flexa"></p>
						<p class="nome-lista">Serviços</p>
						<br class="clear" />
					</div>
					<div class="demoTarget">
						<div id="formulario-filtro">
							<script>
								function abreCadastrar(){
									var $rf = jQuery.noConflict();
									if(document.getElementById("cadastrar").style.display=="none"){
										document.getElementById("botaoFechar").style.display="block";
										$rf("#cadastrar").slideDown(250);
									}else{
										document.getElementById("botaoFechar").style.display="none";
										$rf("#cadastrar").slideUp(250);
									}
								}
							</script>
							<form name="filtro" action="<?php echo $configUrl;?>cadastros/servicos/" method="post" />
								<div class="botao-novo" style="margin-left:0px;"><a title="Novo Serviço" onClick="abreCadastrar()"><div class="esquerda-novo"></div><div class="conteudo-novo">Novo Serviço</div><div class="direita-novo"></div></a></div>
								<div class="botao-novo" style="display:none; margin-left:0px;" id="botaoFechar"><a title="Fechar Cadastrar" onClick="abreCadastrar();"><div class="esquerda-novo"></div><div class="conteudo-novo" id="conteudo-novo-cliente">X</div><div class="direita-novo"></div></a></div>
								<br class="clear" />
							</form>
						</div>
					</div>				
					<div id="cadastrar" style="display:none; margin-left:30px; margin-top:30px; margin-bottom:30px;">
<?php
				if(isset($_POST['cadastrar'])){
					
					include ('f/conf/criaUrl.php');
					$urlServico = criaUrl($_POST['nome']);

					$sqlUltimoServico = "SELECT codOrdenacaoServico FROM servicos ORDER BY codOrdenacaoServico DESC LIMIT 0,1";
					$resultUltimoServico = $conn->query($sqlUltimoServico);
					$dadosUltimoServico = $resultUltimoServico->fetch_assoc();
					
					$novoOrdem = $dadosUltimoServico['codOrdenacaoServico'] + 1;	

					$descricao = str_replace("../../", $configUrlGer, $_POST['descricao']);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					$descricao = str_replace("../../", $configUrlGer, $descricao);
					
					$sql = "INSERT INTO servicos VALUES(0, ".$novoOrdem.", '".preparaNome($_POST['nome'])."', '".str_replace("'", "&#39;", $descricao)."', 'T', '".$urlServico."')";
					$result = $conn->query($sql);
					
					if($result == 1){
						if(isset($_POST['cadastrar'])){
							$_SESSION['nome'] = $_POST['nome'];
							$_SESSION['cadastro'] = "ok";
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."cadastros/servicos/'>";
						}else{
							$erroData = "<p class='erro'>Serviço <strong>".$_POST['nome']."</strong> cadastrado com sucesso!</p>";
						}
					}else{
						$erroData = "<p class='erro'>Problemas ao cadastrar serviço!</p>";
					}
				
				}

				if($erroData != "" || $erro == "sim" || $erro == "ok"){
?>
						<div class="area-erro">
<?php
					echo $erroData;
					if($erro == "sim" || $erro == "ok"){
						include('f/conf/mostraErro.php');
					}
?>
						</div>
<?php
				}
?>				
					
						<p class="obrigatorio">Campos obrigatórios *</p>
						<br/>
						<form action="<?php echo $configUrlGer; ?>cadastros/servicos/" method="post">
							<p class="bloco-campo"><label>Nome: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" name="nome" style="width:842px;" required value="<?php echo $_SESSION['nome']; ?>" /></p>

							<p class="bloco-campo" style="width:855px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:400px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>

							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar Serviço" value="Salvar" /><p class="direita-botao"></p></div></p>						
							<br class="clear"/>
						</form>
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
				
				$sqlConta = "SELECT nomeServico FROM servicos WHERE codServico != ''";
				$resultConta = $conn->query($sqlConta);
				$dadosConta = $resultConta->fetch_assoc();
				$registros = mysqli_num_rows($resultConta);
				
				if($dadosConta['nomeServico'] != ""){
?>
						<table class="tabela-menus" >
							<tr class="titulo-tabela" border="none">
								<th class="canto-esq" >Nome</th>
								<th>Ordenar</th>
								<th>Status</th>
								<th>Alterar</th>
								<th class="canto-dir">Excluir</th>
							</tr>					
<?php

					if($url[5] == 1 || $url[5] == ""){
						$pagina = 1;
						$sqlServico = "SELECT * FROM servicos ORDER BY statusServico ASC, codOrdenacaoServico ASC, codServico DESC LIMIT 0,30";
					}else{
						$pagina = $url[5];
						$paginaFinal = $pagina * 30;
						$paginaInicial = $paginaFinal - 30;
						$sqlServico = "SELECT * FROM servicos ORDER BY statusServico ASC, codOrdenacaoServico ASC, codServico DESC LIMIT ".$paginaInicial.",30";
					}		

					$sqlUltimoServico = "SELECT * FROM servicos ORDER BY codOrdenacaoServico DESC";
					$resultUltimoServico = $conn->query($sqlUltimoServico);
					$dadosUltimoServico = $resultUltimoServico->fetch_assoc();
					$registros2 = mysqli_num_rows($resultUltimoServico);
							
					$entra = 1;		
										
					$resultServico = $conn->query($sqlServico);
					while($dadosServico = $resultServico->fetch_assoc()){
						$mostrando++;

						if($entra == 1){
							$desativarSobe = "disabled";
							if($registros2 == 1){
								$desativarDesce = "disabled";
							}	
						}else if($entra == $registros2){
							$desativarSobe = "";	
							$desativarDesce = "disabled";
						}else{
							$desativarSobe = "";	
							$desativarDesce = "";	
						}
						
						if($dadosServico['statusServico'] == "T"){
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
									<td class="oitenta"><a href='<?php echo $configUrlGer; ?>cadastros/servicos/alterar/<?php echo $dadosServico['codServico'] ?>/' title='Veja os detalhes do serviço <?php echo $dadosServico['nomeServico'] ?>'><?php echo $dadosServico['nomeServico'];?></a></td>
									<td class="vinte" style="width:12%;">
										<form action="<?php echo $configUrlGer.'cadastros/servicos/';?>" method="post" >
											<input type="hidden" name="codServico" value="<?php echo $dadosServico['codServico'];?>" />
											<input type="hidden" name="codOrdenacao" value="<?php echo $dadosServico['codOrdenacaoServico'];?>" />
											<input class="botao-desce<?php echo $desativarDesce;?>" <?php echo $desativarDesce;?> type="submit" name="desce" value="" />
											<input class="botao-sobe<?php echo $desativarSobe;?>" <?php echo $desativarSobe;?> type="submit" name="sobe" value="" />
											<br class="clear" />
										</form>
									</td>  
									<td class="botoes"><a href='<?php echo $configUrl; ?>cadastros/servicos/ativacao/<?php echo $dadosServico['codServico'] ?>/' title='Deseja <?php echo $statusPergunta ?> o serviço <?php echo $dadosServico['nomeServico'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>cadastros/servicos/alterar/<?php echo $dadosServico['codServico'] ?>/' title='Deseja alterar o serviço <?php echo $dadosServico['nomeServico'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosServico['codServico'] ?>, "<?php echo htmlspecialchars($dadosServico['nomeServico']) ?>");' title='Deseja excluir o serviço <?php echo $dadosServico['nomeServico'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
						$entra++;
					}
?>
								<script>
									function confirmaExclusao(cod, nome){
										if(confirm("Deseja excluir o serviço "+nome+"?")){
											window.location='<?php echo $configUrlGer; ?>cadastros/servicos/excluir/'+cod+'/';
										}
									}
								</script>
								 
							</table>	
<?php
				}
				
				$regPorPagina = 30;
				$area = "cadastros/servicos";
				include ('f/conf/paginacao.php');		
?>							
					</div>
				</div>
<?php
			}else{
?>	
				<div id="filtro">
					<div id="erro-permicao">	
<?php
				echo "<p><strong>Você não tem permissão para acessar essa área!</strong></p>";
				echo "<p>Para mais informações entre em contato com o administrador!</p>";
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
