<?php
	include('../../f/conf/config.php');
	include('../../f/conf/controleAcesso.php');

	$busca = $_GET['busca'];
			
	$busca = str_replace("-", " ", $busca);
	$busca = str_replace("-", " ", $busca);
	$busca = str_replace("-", " ", $busca);
	$busca = str_replace("-", " ", $busca);
	$busca = str_replace("-", " ", $busca);
	$busca = str_replace("-", " ", $busca);
	$busca = str_replace("-", " ", $busca);
	$busca = str_replace("-", " ", $busca);
	$busca = str_replace("-", " ", $busca);


	$busca = str_replace("'", "&#39;", $busca);	
	$pedacos = explode(" ", $busca);	
	$numero = count($pedacos);
	
	$order = explode(" ", $busca);
?>
							<table class="tabela-menus" >
								<tr class="titulo-tabela" border="none">
									<th class="canto-esq" >Nome</th>
									<th>Corretor</th>
									<th>Cidade / Estado</th>
									<th>Telefone</th>
									<th>Foto</th>
									<th>Documentos</th>
									<th>Status</th>
									<th>Alterar</th>
									<th class="canto-dir">Excluir</th>
								</tr>					
<?php
	if($numero >= 1){
		$sqlClientes = "SELECT * FROM clientes WHERE codCliente != ''".$filtraUsuario." and nomeCliente LIKE '%".$order[0]."%' and nomeCliente LIKE '%".$order[1]."%' and nomeCliente LIKE '%".$order[2]."%' and nomeCliente LIKE '%".$order[3]."%' and nomeCliente LIKE '%".$order[4]."%' ORDER BY locate('".$order[0]."',nomeCliente), locate('".$order[1]."',nomeCliente), locate('".$order[2]."',nomeCliente), locate('".$order[3]."',nomeCliente), locate('".$order[4]."',nomeCliente) LIMIT 0,30";		
	}
	
	if($busca == ""){
		$sqlClientes = "SELECT * FROM clientes WHERE codCliente != ''".$filtraUsuario." ORDER BY statusCliente ASC, nomeCliente ASC";
	}
	$resultClientes = $conn->query($sqlClientes);
	while($dadosClientes = $resultClientes->fetch_assoc()){
				
	if($dadosClientes['statusCliente'] == "T"){
		$status = "status-ativo";
		$statusIcone = "ativado";
		$statusPergunta = "desativar";
	}else{
		$status = "status-desativado";
		$statusIcone = "desativado";
		$statusPergunta = "ativar";
	}		

	$sqlUsuario = "SELECT * FROM usuarios WHERE codUsuario = ".$dadosClientes['codUsuario']." LIMIT 0,1";
	$resultUsuario = $conn->query($sqlUsuario);
	$dadosUsuario = $resultUsuario->fetch_assoc();	
	
	$sqlEstado = "SELECT * FROM estado WHERE codEstado = ".$dadosClientes['codEstado']." LIMIT 0,1";
	$resultEstado = $conn->query($sqlEstado);
	$dadosEstado = $resultEstado->fetch_assoc();	
	
	$sqlCidade = "SELECT * FROM cidade WHERE codCidade = ".$dadosClientes['codCidade']." LIMIT 0,1";
	$resultCidade = $conn->query($sqlCidade);
	$dadosCidade = $resultCidade->fetch_assoc();	

	$sqlImagem = "SELECT * FROM clientesImagens WHERE codCliente = ".$dadosClientes['codCliente']." LIMIT 0,1";
	$resultImagem = $conn->query($sqlImagem);
	$dadosImagem = $resultImagem->fetch_assoc();	
	
	$aniversario = explode("-", $dadosClientes['nascimentoCliente']);
	$novaData = $aniversario[2]."/".$aniversario[1];		
?>
								<tr class="tr">
									<td class="trinta"><img style="<?php echo $novaData == date('d/m') ? '' : 'display:none;';?> padding-right:10px; cursor:pointer;" title="Clique para ver o numero" src="<?php echo $configUrl;?>f/i/default/corpo-default/icon-bolo.png" alt="Aniversário" /><a href='<?php echo $configUrlGer; ?>imoveis/clientes/alterar/<?php echo $dadosClientes['codCliente'] ?>/' title='Veja os detalhes do cliente <?php echo $dadosClientes['nomeCliente'] ?>'><?php echo $dadosClientes['nomeCliente'];?></a></td>
									<td class="vinte" style="text-align:center;"><img style="<?php echo $novaData == date('d/m') ? '' : 'display:none;';?> padding-right:10px; cursor:pointer;" title="Clique para ver o numero" src="<?php echo $configUrl;?>f/i/default/corpo-default/icon-bolo.png" alt="Aniversário" /><a href='<?php echo $configUrlGer; ?>imoveis/clientes/alterar/<?php echo $dadosClientes['codCliente'] ?>/' title='Veja os detalhes do cliente <?php echo $dadosClientes['nomeCliente'] ?>'><?php echo $dadosUsuario['nomeUsuario'];?></a></td>
									<td class="vinte" style="text-align:center;"><a href='<?php echo $configUrlGer; ?>imoveis/clientes/alterar/<?php echo $dadosClientes['codCliente'] ?>/' title='Veja os detalhes do cliente <?php echo $dadosClientes['nomeCliente'] ?>'><?php echo $dadosCidade['nomeCidade'];?> / <?php echo $dadosEstado['siglaEstado'];?></a></td>
									<td class="vinte" style="text-align:center;"><a href='<?php echo $configUrlGer; ?>imoveis/clientes/alterar/<?php echo $dadosClientes['codCliente'] ?>/' title='Veja os detalhes do cliente <?php echo $dadosClientes['nomeCliente'] ?>'><?php echo $dadosClientes['telefoneCliente'] != "" ? $dadosClientes['telefoneCliente'] : $dadosClientes['celularCliente'];?> <?php echo $dadosClientes['telefoneCliente'] == "" && $dadosClientes['celularCliente'] == "" ? '--' : '';?></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>imoveis/clientes/foto/<?php echo $dadosClientes['codCliente'] ?>/' title='Deseja cadastrar fotos para o cliente <?php echo $dadosClientes['nomeCliente'] ?>?'><img style="margin-left:-8px; <?php echo $dadosImagem['codCliente'] == "" ? 'display:none;' : '';?>" src="<?php echo $configUrlGer.'f/clientes/'.$dadosImagem['codCliente'].'-'.$dadosImagem['codClienteImagem'].'-P.'.$dadosImagem['extClienteImagem'];?>" alt="icone" height="60"/><img style="<?php echo $dadosImagem['codCliente'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl;?>f/i/gerenciar-imagens.gif" alt="icone" /></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>imoveis/clientes/gerenciar-documentos/<?php echo $dadosClientes['codCliente'] ?>/' title='Deseja cadastrar documentos para o cliente <?php echo $dadosClientes['nomeCliente'] ?>?' ><img src="<?php echo $configUrl;?>f/i/geren-documentos.png" alt="icone"/></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>imoveis/clientes/ativacao/<?php echo $dadosClientes['codCliente'] ?>/' title='Deseja <?php echo $statusPergunta ?> o cliente <?php echo $dadosClientes['nomeCliente'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>imoveis/clientes/alterar/<?php echo $dadosClientes['codCliente'] ?>/' title='Deseja alterar o cliente <?php echo $dadosClientes['nomeCliente'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes"><a href='javascript: confirmaExclusao(<?php echo $dadosClientes['codCliente'] ?>, "<?php echo htmlspecialchars($dadosClientes['nomeCliente']) ?>");' title='Deseja excluir o cliente <?php echo $dadosClientes['nomeCliente'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>

<?php
	}
?>
								<script>
									 function confirmaExclusao(cod, nome){

										if(confirm("Deseja excluir o cliente "+nome+"?")){
											window.location='<?php echo $configUrlGer; ?>imoveis/clientes/excluir/'+cod+'/';
										}
									  }
								</script>
								 
							</table>	
