<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "clientes";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				$_SESSION['nome'] = "";
				$sqlNomeCliente = "SELECT * FROM clientes WHERE codCliente = '".$url[6]."'".$filtraUsuario."";
				$resultNomeCliente = $conn->query($sqlNomeCliente);
				$dadosNomeCliente = $resultNomeCliente->fetch_assoc();

				if($dadosNomeCliente['codUsuario'] == ""){
					echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."imoveis/clientes/'>";					
				}
?>	
				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Imóveis</p>
						<p class="flexa"></p>
						<p class="nome-lista">Clientes</p>
						<p class="flexa"></p>
						<p class="nome-lista">Gerenciar Documentos</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosNomeCliente['nomeCliente'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
<?php
				if($dadosNomeCliente['statusCliente'] == "T"){
					$status = "status-ativo";
					$statusIcone = "ativado";
					$statusPergunta = "desativar";
				}else{
					$status = "status-desativado";
					$statusIcone = "desativado";
					$statusPergunta = "ativar";
				}		
?>	
						<tr class="tr-interno">
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>imoveis/clientes/ativacao/<?php echo $dadosNomeCliente['codCliente'] ?>/' title='Deseja <?php echo $statusPergunta ?> o cliente <?php echo $dadosNomeCliente['nomeCliente'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>-branco.gif" alt="icone"></a></td>
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>imoveis/clientes/alterar/<?php echo $dadosNomeCliente['codCliente'] ?>/' title='Deseja alterar o cliente <?php echo $dadosNomeCliente['nomeCliente'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar-branco.gif" alt="icone" /></a></td>
						</tr>
					</table>	
					<div class="botao-consultar"><a title="Consultar Clientes" href="<?php echo $configUrl;?>imoveis/clientes/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">
<?php
				if(isset($_POST['cadastrar'])){
					
					$exclusao = "";
					
					if($_POST['cont'] >  0){
												
						for($i=0; $i<=$_POST['cont']; $i++){
							$contadorDel = "excluir".$i;
							if(isset($_POST[$contadorDel])){
								$exclusao = "ok";
								$sqlConsultaDelete = "SELECT * FROM clientesAnexos WHERE codClienteAnexo = ".$_POST[$contadorDel];
								$resultConsultaDelete = $conn->query($sqlConsultaDelete);
								$dadosConsultaDelete = $resultConsultaDelete->fetch_assoc();
								
								$sqlDelete = "DELETE FROM clientesAnexos WHERE codClienteAnexo = ".$_POST[$contadorDel];
								$resultDelete = $conn->query($sqlDelete);
								if(file_exists("f/clientesAnexo/".$dadosConsultaDelete['codCliente']."-".$dadosConsultaDelete['codClienteAnexo']."-O.".$dadosConsultaDelete['extClienteAnexo'])){
									unlink("f/clientesAnexo/".$dadosConsultaDelete['codCliente']."-".$dadosConsultaDelete['codClienteAnexo']."-O.".$dadosConsultaDelete['extClienteAnexo']);
								}
							
								if($resultDelete == 1){
									$noErros = "ok";
								}
							}
						}
					}
					
					if($exclusao == ""){
						
						$pastaDestino = "f/clientesAnexo/";
											
						$file = $_FILES['imagem'];

						$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
																				
						$file_name = uniqid() . '.' . $ext;							
														
						$sqlCliente = "SELECT * FROM clientes WHERE codCliente = ".$url[6]." ORDER BY codCliente DESC LIMIT 0,1";
						$resultCliente = $conn->query($sqlCliente);
						$dadosCliente = $resultCliente->fetch_assoc();
														
						$sql =  "INSERT INTO clientesAnexos VALUES(0, ".$url[6].", '".$file['name']."', '".$ext."')";
						$result = $conn->query($sql);
																				
						if($result == 1){
							
							$sqlNome = "SELECT * FROM clientesAnexos ORDER BY codClienteAnexo DESC";
							$resultNome = $conn->query($sqlNome);
							$dadosNome = $resultNome->fetch_assoc();
							
							$codClienteAnexo = $dadosNome['codClienteAnexo'];
							$codCliente = $dadosNome['codCliente'];
							$nomeClienteAnexo = $dadosNome['nomeClienteAnexo'];
							
							move_uploaded_file($file['tmp_name'], $pastaDestino.$codCliente."-".$codClienteAnexo."-O.".$ext);
							
							chmod ($pastaDestino.$codCliente."-".$codClienteAnexo."-O.".$ext, 0755);
																													
							$erroData = "<p class='erro'>Documento cadastrado com sucesso!</p>";														
						
						}else{
							$erroData = "<p class='erro'>Problemas ao cadastrar documento!</p>";
						}

					}else{
						$erroData = "<p class='erro'>Documento excluído com sucesso!</p>";
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

						<form action="<?php echo $configUrlGer; ?>imoveis/clientes/gerenciar-documentos/<?php echo $url[6]; ?>/1/" enctype="multipart/form-data" method="post">
							<p class="bloco-campo"><label>Anexo: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="file" name="imagem" size="15" value="" /></p>
							
							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar" value="Salvar" /><p class="direita-botao"></p></div></p>						
							<br class="clear"/>
						
							<div class="lista-imagens">
<?php
				$sqlRegistro = "SELECT * FROM clientesAnexos WHERE codCliente = ".$url[6];
				$resultRegistro = $conn->query($sqlRegistro);
				$dadosRegistro = $resultRegistro->fetch_assoc();
				$registros = mysqli_num_rows($resultRegistro);
				
				  
				$pagina = $url[7];
				if($pagina == 1 || $pagina == "" ){
					$sqlConsulta = "SELECT * FROM clientesAnexos WHERE codCliente = ".$url[6]." ORDER BY codClienteAnexo ASC LIMIT 0, 14";
					$somaLimite = "14";
					$pgInicio = "0";		
				}else{
					$somaLimite = $pagina * 14;
					$pgInicio = $somaLimite - 14;
					$sqlConsulta = "SELECT * FROM clientesAnexos WHERE codCliente = ".$url[6]." ORDER BY codClienteAnexo ASC LIMIT ".$pgInicio.", 14";
				}

				$resultConsulta = $conn->query($sqlConsulta);
				$cont = 0;
				while($dadosAnexo = $resultConsulta->fetch_assoc()){
					$mostrando = $mostrando + 1;
?>
        
								<p class="imagem" style="width:200px; height:170px; overflow:hidden; margin-left:20px; margin-right:20px; margin-top:30px;"><a download="<?php echo $dadosAnexo['nomeClienteAnexo'];?>.<?php echo $dadosAnexo['extClienteAnexo'];?>" href="<?php echo $configUrlGer;?>f/clientesAnexo/<?php echo $dadosAnexo['codCliente'].'-'.$dadosAnexo['codClienteAnexo'].'-O.'.$dadosAnexo['extClienteAnexo'];?>"><img src="<?php echo $configUrlGer;?>f/i/documento.gif" alt="Anexo Cliente"/></a><br/><br/><strong><?php echo $dadosAnexo['nomeClienteAnexo'];?></strong><br/><br/>
								<input type="checkbox" name="excluir<?php echo $cont;?>" value="<?php echo $dadosAnexo['codClienteAnexo']; ?>" /> Excluir</p>
				
<?php
					$cont = $cont + 1;
				}
?>
								<input type="hidden" name="cont" value="<?php echo $cont; ?>" />
							</div>
						</form>
					</div>
					<br class="clear" />
					<br/>
<?php
				if($erro == "ok"){
					$_SESSION['erroDados'] = ""; 
					
					
				}
				
				$regPorPag = 14;
				$area = "imoveis/clientes/gerenciar-documentos/".$url[6];
				include('f/conf/paginacao-imagens.php');
?>	
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
