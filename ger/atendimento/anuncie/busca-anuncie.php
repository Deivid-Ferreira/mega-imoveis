<?php
	ini_set('display_errors', '0');
	error_reporting(E_ALL | E_STRICT);

	include('../../f/conf/config.php');
	include('../../f/conf/functions.php');
	include('../../f/conf/validaAcesso.php');

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
									<th>Celular</th>
									<th>Data</th>
									<th>Status</th>
									<th class="canto-dir">Excluir</th>
								</tr>						
<?php
	if($numero >= 1){
		$sqlAnuncies = "SELECT * FROM anuncie WHERE codAnuncie != ''".$filtraUsuario." and nomeAnuncie LIKE '%".$order[0]."%' and nomeAnuncie LIKE '%".$order[1]."%' and nomeAnuncie LIKE '%".$order[2]."%' and nomeAnuncie LIKE '%".$order[3]."%' and nomeAnuncie LIKE '%".$order[4]."%' ORDER BY locate('".$order[0]."',nomeAnuncie), locate('".$order[1]."',nomeAnuncie), locate('".$order[2]."',nomeAnuncie), locate('".$order[3]."',nomeAnuncie), locate('".$order[4]."',nomeAnuncie), dataAnuncie ASC, codAnuncie DESC LIMIT 0,30";		
	}
	
	if($busca == ""){
		$sqlAnuncies = "SELECT * FROM anuncie WHERE codAnuncie != ''".$filtraUsuario." ORDER BY statusAnuncie ASC, dataAnuncie ASC, codAnuncie DESC";
	}
	$resultAnuncies = $conn->query($sqlAnuncies);
	while($dadosAnuncies = $resultAnuncies->fetch_assoc()){
				
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
