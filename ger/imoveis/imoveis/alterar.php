<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "imoveisS";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				$sqlNomeImovel = "SELECT * FROM imoveis WHERE codImovel = '".$url[6]."' LIMIT 0,1";
				$resultNomeImovel = $conn->query($sqlNomeImovel);
				$dadosNomeImovel = $resultNomeImovel->fetch_assoc();
?>

				<div id="localizacao-topo">
					<div id="conteudo-localizacao-topo">
						<p class="nome-lista">Imóveis</p>
						<p class="flexa"></p>
						<p class="nome-lista">Imóveis</p>
						<p class="flexa"></p>
						<p class="nome-lista">Alterar</p>
						<p class="flexa"></p>
						<p class="nome-lista"><?php echo $dadosNomeImovel['nomeImovel'] ;?></p>
						<br class="clear" />
					</div>
					<table class="tabela-interno" >
<?php	
				if($dadosNomeImovel['statusImovel'] == "T"){
					$statusImovel = "status-ativo";
					$statusIcone = "ativado";
					$statusPergunta = "desativar";
				}else{
					$statusImovel = "status-desativado";
					$statusIcone = "desativado";
					$statusPergunta = "ativar";
				}	

				if($_COOKIE['codAprovado'.$cookie] == $dadosNomeImovel['codUsuario'] || $filtraUsuario == ""){
					
?>	
						<tr class="tr-interno">
							<td class="botoes-interno"><a href='<?php echo $configUrl; ?>imoveis/imoveis/ativacao/<?php echo $dadosNomeImovel['codImovel'] ?>/' title='Deseja <?php echo $statusPergunta ?> o imóvel <?php echo $dadosNomeImovel['nomeImovel'];?> ?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $statusImovel ?>-branco.gif" alt="icone" /></a></td>
							<td class="botoes-interno"><a href='javascript: confirmaExclusao(<?php echo $dadosNomeImovel['codImovel'] ?>, "<?php echo htmlspecialchars($dadosNomeImovel['nomeImovel']) ?>");' title='Deseja excluir o imóvel <?php echo $dadosNomeImovel['nomeImovel'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir-branco.gif' alt="icone"></a></td>
						</tr>
<?php
				}
?>
							<script>
									function confirmaExclusao(cod, nome){

									if(confirm("Deseja excluir o imóvel "+nome+"?")){
										window.location='<?php echo $configUrlGer; ?>imoveis/imoveis/excluir/'+cod+'/';
								}
							}
						 </script>
					</table>	
					<div class="botao-consultar"><a title="Consultar Imóveis" href="<?php echo $configUrl;?>imoveis/imoveis/"><div class="esquerda-consultar"></div><div class="conteudo-consultar">Consultar</div><div class="direita-consultar"></div></a></div>					
				</div>
				<div id="dados-conteudo">
					<div id="cadastrar">
<?php
				if($_POST['nome'] != ""){
							
					include ('f/conf/criaUrl.php');
					$urlImovel = criaUrl($_POST['nome']);																						

					$sqlProprietario = "SELECT codProprietario FROM proprietarios WHERE nomeProprietario = '".$_POST['proprietarios']."' LIMIT 0,1";
					$resultProprietario = $conn->query($sqlProprietario);
					$dadosProprietario = $resultProprietario->fetch_assoc();
					
					if($dadosProprietario['codProprietario'] != ""){

						$sqlCodigo = "SELECT codigoImovel FROM imoveis WHERE codigoImovel = '".$_POST['codigo']."' and codImovel != ".$url[6]." LIMIT 0,1";
						$resultCodigo = $conn->query($sqlCodigo);
						$dadosCodigo = $resultCodigo->fetch_assoc();
						
						if($dadosCodigo['codigoImovel'] == ""){
							
							$preco = $_POST['preco'];	
							$preco = str_replace(".", "", $preco);	
							$preco = str_replace(".", "", $preco);	
							$preco = str_replace(",", ".", $preco);	

							$precoC = $_POST['precoC'];	
							$precoC = str_replace(".", "", $precoC);	
							$precoC = str_replace(".", "", $precoC);	
							$precoC = str_replace(",", ".", $precoC);
							
							$entrada = $_POST['entrada'];
							$entrada = str_replace(".", "", $entrada);
							$entrada = str_replace(",", ".", $entrada);
	
							$vParcela = $_POST['vParcela'];
							$vParcela = str_replace(".", "", $vParcela);
							$vParcela = str_replace(",", ".", $vParcela);

							$descricao = str_replace("../../../../", $configUrlGer, $_POST['descricao']);
							$descricao = str_replace("../../../../", $configUrlGer, $descricao);

							if($parcelas == ""){
								$parcelas = "";
							}else{
								$parcelas = $parcelas;
							}	
							
							if($vParcela == ""){
								$vParcela = "0.00";
							}else{
								$vParcela = $vParcela;
							}
							
							if($entrada == ""){
								$entrada = "0.00";
							}else{
								$entrada = $entrada;
							}				
							

							if($precoC == ""){
								$precoC = "0.00";
							}else{
								$precoC = $precoC;
							}						
							if($preco == ""){
								$preco = "0.00";
							}else{
								$preco = $preco;
							}						
							if($_POST['quartos'] == ""){
								$quartos = 0;
							}else{
								$quartos = $_POST['quartos'];
							}						
							if($_POST['suite'] == ""){
								$suite = 0;
							}else{
								$suite = $_POST['suite'];
							}						
							if($_POST['banheiros'] == ""){
								$banheiros = 0;
							}else{
								$banheiros = $_POST['banheiros'];
							}						
							if($_POST['garagem'] == ""){
								$garagem = 0;
							}else{
								$garagem = $_POST['garagem'];
							}						
							if($_POST['metragem'] == ""){
								$metragem = 0;
							}else{
								$metragem = $_POST['metragem'];
							}						
							if($_POST['metragemC'] == ""){
								$metragemC = 0;
							}else{
								$metragemC = $_POST['metragemC'];
							}						
							if($_POST['fundos'] == ""){
								$fundos = 0;
							}else{
								$fundos = $_POST['fundos'];
							}						
							if($_POST['largura'] == ""){
								$largura = 0;
							}else{
								$largura = $_POST['largura'];
							}											

							if(isset($_POST["lote"])) {
								$optionArray = $_POST["lote"];
								for($i = 0; $i < count($optionArray); $i++){
									if($lote == ""){
										$lote = $optionArray[$i];
									}else{
										$lote .= ", ".$optionArray[$i];
									}
								}
							}	
																				
						 	$sql = "UPDATE imoveis SET codUsuario = ".$_POST['usuario'].", codigoImovel = '".$_POST['codigo']."', codProprietario = ".$dadosProprietario['codProprietario'].", nomeImovel = '".preparaNome($_POST['nome'])."', precoImovel = '".$preco."', entradaImovel = '".$entrada."', nParcelaImovel = '".$_POST['parcelas']."', valorParcelaImovel = '".$vParcela."', valorImovel = '" .$_POST['tipoValor']. "',  precoCImovel = '".$precoC."', paisImovel = '".$_POST['pais']."', codCidade = '".$_POST['cidades']."', codBairro = '".$_POST['bairro']."', enderecoImovel = '".$_POST['endereco']."', nApartamentoImovel = '".$_POST['nApartamento']."', quadraImovel = '".$_POST['quadra']."', loteImovel = '".$lote."', matriculaImovel = '".$_POST['matricula']."', quartosImovel = '".$quartos."', banheirosImovel = '".$banheiros."', suiteImovel = '".$suite."', garagemImovel = '".$garagem."', metragemImovel = '".$metragem."', metragemCImovel = '".$metragemC."', fundosImovel = '".$fundos."', larguraImovel = '".$largura."', frenteImovel = '".$_POST['frente']."',siglaMetragem = '".$_POST['siglaMetragem']."', posicaoImovel = '".$_POST['posicao']."', codTipoImovel = '".$_POST['tipo']."', videoImovel = '".str_replace("'", "&#39;", $_POST['video'])."', mapaImovel = '".str_replace("'", "&#39;", $_POST['mapa'])."', descricaoImovel = '".str_replace("'", "&#39;", $descricao)."', observacoesImovel = '".str_replace("'", "&#39;", $_POST['observacoes'])."', urlImovel = '".$urlImovel."' WHERE codImovel = '".$url[6]."'";
							$result = $conn->query($sql);					
							
							if($result == 1){
								$_SESSION['nome'] = $_POST['nome'];
								$_SESSION['alteracaos'] = "ok";

								$sqlDelete = "DELETE FROM imoveisLotes WHERE codImovel = ".$url[6]."";
								$resultDelete = $conn->query($sqlDelete);

								if(isset($_POST["lote"])) {
									$optionArray = $_POST["lote"];
									for($i = 0; $i < count($optionArray); $i++){
										$sql = "INSERT INTO imoveisLotes VALUES(0, '".$url[6]."', '".$optionArray[$i]."')";
										$result = $conn->query($sql);						
									}
								}
								
								$sqlCaracteristicaImovel = "SELECT * FROM caracteristicasImoveis WHERE codImovel = ".$url[6]."";
								$resultCaracteristicaImovel = $conn->query($sqlCaracteristicaImovel);
								$dadosCaracteristicaImovel = $resultCaracteristicaImovel->fetch_assoc();

								$sqlCaracteristica = "SELECT *  FROM caracteristicasImoveis ORDER BY codCaracteristica ASC";
								$resultCaracteristica = $conn->query($sqlCaracteristica);
								while($dadosCaracteristicaLimpa = $resultCaracteristica->fetch_assoc()){
									$_SESSION['caracteristica'.$url[6].$dadosCaracteristicaLimpa['codCaracteristica']] = "";
								}
								
								for($i=1; $i<=$_POST['quantas']; $i++){
									if($i == 1){
										$sqlDelete = "DELETE FROM caracteristicasImoveis WHERE codImovel = ".$url[6]."";
										$resultDelete = $conn->query($sqlDelete);
									}
									if($_POST['caracteristica'.$i] != ""){
										$sqlInsere = "INSERT INTO caracteristicasImoveis VALUES(0, ".$_POST['caracteristica'.$i].", ".$url[6].")";
										$resultInsere = $conn->query($sqlInsere);
									}
								}

								echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."imoveis/imoveis/'>";
							}else{
								$erroData = "<p class='erro'>Problemas ao alterar imóvel!</p>";
							}
					
						}else{
							$erroData = "<p class='erro'>Código ja utilizado em outro imóvel!</p>";
							$_SESSION['proprietarios'] = $_POST['proprietarios'];
							$_SESSION['codigo'] = "";
							$_SESSION['nome'] = $_POST['nome'];
							$_SESSION['usuario'] = $_POST['usuario'];
							$_SESSION['preco'] = $_POST['preco'];
							$_SESSION['precoC'] = $_POST['precoC'];
							$_SESSION['cidades'] = $_POST['cidades'];
							$_SESSION['pais'] = $_POST['pais'];
							$_SESSION['bairro'] = $_POST['bairro'];
							$_SESSION['endereco'] = $_POST['endereco'];
							$_SESSION['nApartamento'] = $_POST['nApartamento'];
							$_SESSION['quadra'] = $_POST['quadra'];
							$_SESSION['lote'] = $_POST['lote'];
							$_SESSION['matricula'] = $_POST['matricula'];
							$_SESSION['quartos'] = $_POST['quartos'];
							$_SESSION['suite'] = $_POST['suite'];
							$_SESSION['banheiros'] = $_POST['banheiros'];
							$_SESSION['garagem'] = $_POST['garagem'];
							$_SESSION['metragem'] = $_POST['metragem'];
							$_SESSION['metragemC'] = $_POST['metragemC'];
							$_SESSION['fundos'] = $_POST['fundos'];
							$_SESSION['largura'] = $_POST['largura'];
							$_SESSION['frente'] = $_POST['frente'];
							$_SESSION['posicao'] = $_POST['posicao'];							
							$_SESSION['tipo'] = $_POST['tipo'];
							$_SESSION['tipoc'] = $_POST['tipoc'];
							$_SESSION['video'] = $_POST['video'];
							$_SESSION['mapa'] = $_POST['mapa'];
							$_SESSION['descricao'] = $_POST['descricao'];
							$_SESSION['observacoes'] = $_POST['observacoes'];
							$_SESSION['siglaMetragem'] = $_POST['siglaMetragem'];

						}	

					}else{
						$erroData = "<p class='erro'>Proprietario não encontrado!</p>";
						$_SESSION['proprietarios'] = "";
						$_SESSION['codigo'] = $_POST['codigo'];
						$_SESSION['nome'] = $_POST['nome'];
						$_SESSION['usuario'] = $_POST['usuario'];
						$_SESSION['preco'] = $_POST['preco'];
						$_SESSION['precoC'] = $_POST['precoC'];
						$_SESSION['cidades'] = $_POST['cidades'];
						$_SESSION['pais'] = $_POST['pais'];
						$_SESSION['bairro'] = $_POST['bairro'];
						$_SESSION['endereco'] = $_POST['endereco'];
						$_SESSION['nApartamento'] = $_POST['nApartamento'];
						$_SESSION['quadra'] = $_POST['quadra'];
						$_SESSION['lote'] = $_POST['lote'];
						$_SESSION['matricula'] = $_POST['matricula'];
						$_SESSION['quartos'] = $_POST['quartos'];
						$_SESSION['suite'] = $_POST['suite'];
						$_SESSION['banheiros'] = $_POST['banheiros'];
						$_SESSION['garagem'] = $_POST['garagem'];
						$_SESSION['metragem'] = $_POST['metragem'];
						$_SESSION['metragemC'] = $_POST['metragemC'];
						$_SESSION['fundos'] = $_POST['fundos'];
						$_SESSION['largura'] = $_POST['largura'];
						$_SESSION['frente'] = $_POST['frente'];
						$_SESSION['posicao'] = $_POST['posicao'];
						$_SESSION['tipo'] = $_POST['tipo'];
						$_SESSION['tipoc'] = $_POST['tipoc'];
						$_SESSION['video'] = $_POST['video'];
						$_SESSION['mapa'] = $_POST['mapa'];
						$_SESSION['descricao'] = $_POST['descricao'];
						$_SESSION['observacoes'] = $_POST['observacoes'];
						$_SESSION['siglaMetragem'] = $_POST['siglaMetragem'];

						$erroAtiva = "ok";	
					}
				}else{
					$sql = "SELECT * FROM imoveis WHERE codImovel = ".$url[6];
					$result = $conn->query($sql);
					$dadosImovel = $result->fetch_assoc();
						
					$_SESSION['codigo'] = $dadosImovel['codigoImovel'];
					$_SESSION['nome'] = $dadosImovel['nomeImovel'];
					$_SESSION['usuario'] = $dadosImovel['codUsuario'];
					$_SESSION['cidades'] = $dadosImovel['codCidade'];
					$_SESSION['pais'] = $dadosImovel['paisImovel'];
					$_SESSION['bairro'] = $dadosImovel['codBairro'];
					$_SESSION['quadra'] = $dadosImovel['quadraImovel'];
					$_SESSION['endereco'] = $dadosImovel['enderecoImovel'];
					$_SESSION['nApartamento'] = $dadosImovel['nApartamentoImovel'];
					$_SESSION['lote'] = $dadosImovel['loteImovel'];
					$_SESSION['matricula'] = $dadosImovel['matriculaImovel'];
					$_SESSION['quartos'] = $dadosImovel['quartosImovel'];
					$_SESSION['suite'] = $dadosImovel['suiteImovel'];
					$_SESSION['banheiros'] = $dadosImovel['banheirosImovel'];
					$_SESSION['garagem'] = $dadosImovel['garagemImovel'];
					$_SESSION['metragem'] = $dadosImovel['metragemImovel'];
					$_SESSION['metragemC'] = $dadosImovel['metragemCImovel'];
					$_SESSION['fundos'] = $dadosImovel['fundosImovel'];
					$_SESSION['largura'] = $dadosImovel['larguraImovel'];
					$_SESSION['frente'] = $dadosImovel['frenteImovel'];
					$_SESSION['posicao'] = $dadosImovel['posicaoImovel'];
					$_SESSION['tipo'] = $dadosImovel['codTipoImovel'];
					$_SESSION['tipoc'] = $dadosImovel['tipoCImovel'];
					$_SESSION['video'] = $dadosImovel['videoImovel'];
					$_SESSION['mapa'] = $dadosImovel['mapaImovel'];
					$_SESSION['descricao'] = $dadosImovel['descricaoImovel'];
					$_SESSION['observacoes'] = $dadosImovel['observacoesImovel'];
					$_SESSION['preco'] = $dadosImovel['precoImovel'];
					$_SESSION['precoC'] = $dadosImovel['precoCImovel'];
					$_SESSION['parcelas'] =  $dadosImovel['nParcelaImovel'];
					$_SESSION['vParcela'] =  $dadosImovel['valorParcelaImovel'];
					$_SESSION['entrada'] =  $dadosImovel['entradaImovel'];
					$_SESSION['tipoValor'] = $dadosImovel['valorImovel'];
					$_SESSION['siglaMetragem'] = $dadosImovel['siglaMetragem'];
												
					$sqlProprietario = "SELECT nomeProprietario FROM proprietarios WHERE codProprietario = '".$dadosImovel['codProprietario']."' LIMIT 0,1";
					$resultProprietario = $conn->query($sqlProprietario);
					$dadosProprietario = $resultProprietario->fetch_assoc();
					
					$_SESSION['proprietarios'] = $dadosProprietario['nomeProprietario'];

					$sqlCaracteristica = "SELECT *  FROM caracteristicasImoveis ORDER BY codCaracteristica ASC";
					$resultCaracteristica = $conn->query($sqlCaracteristica);
					while($dadosCaracteristicaLimpa = $resultCaracteristica->fetch_assoc()){
						$_SESSION['caracteristica'.$url[6].$dadosCaracteristicaLimpa['codCaracteristica']] = "";
					}
						
					$sqlCaracteristica = "SELECT *  FROM caracteristicasImoveis WHERE codImovel = ".$dadosImovel['codImovel']." ORDER BY codCaracteristica ASC";
					$resultCaracteristica = $conn->query($sqlCaracteristica);
					while($dadosCaracteristica = $resultCaracteristica->fetch_assoc()){	
						$_SESSION['caracteristica'.$url[6].$dadosCaracteristica['codCaracteristica']] = "OK";
					}	
				}

				$sql = "SELECT * FROM imoveis WHERE codImovel = ".$url[6];
				$result = $conn->query($sql);
				$dadosImovel = $result->fetch_assoc();	
				
				$_SESSION['lote-antigo'] = $dadosImovel['loteImovel'];					

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

				if($_COOKIE['codAprovado'.$cookie] == $dadosImovel['codUsuario'] || $filtraUsuario == ""){
?>				
					<div class="botao-editar"><a title="Editar" href="javascript:habilitaCampo();"><div class="esquerda-editar"></div><div class="conteudo-editar">Editar</div><div class="direita-editar"></div></a></div>					
<?php
				}
?>					
					<p class="obrigatorio">Campos obrigatórios *</p>
					<br/>
					<p style="color:#718B8F; font-weight:bold;">* Campos nesta cor aparecerão no site</p>
					<p style="color:#718B8F;">* Campos nesta cor não aparecerão no site</p>
					<br/>
					<script>
						function habilitaCampo(){
							document.getElementById("usuario").disabled = false;
							document.getElementById("codigo").disabled = false;
							document.getElementById("nome").disabled = false;
							document.getElementById("busca_autocomplete_softbest_proprietarios_c").disabled = false;
							document.getElementById("preco").disabled = false;
							document.getElementById("precoC").disabled = false;
							document.getElementById("cidades").disabled = false;
							document.getElementById("pais").disabled = false;
							document.getElementById("bairro").disabled = false;
							document.getElementById("endereco").disabled = false;
							document.getElementById("nApartamento").disabled = false;
							document.getElementById("idSelectQuadra").disabled = false;
							document.getElementById("idSelectLote").disabled = false;
							document.getElementById("matricula").disabled = false;
							document.getElementById("quartos").disabled = false;
							document.getElementById("banheiros").disabled = false;
							document.getElementById("suite").disabled = false;
							document.getElementById("garagem").disabled = false;
							document.getElementById("metragem").disabled = false;
							document.getElementById("metragemC").disabled = false;
							document.getElementById("fundos").disabled = false;
							document.getElementById("siglaMetragem").disabled = false;
							document.getElementById("siglaMetragem2").disabled = false;
							document.getElementById("radioA").disabled = false;
							document.getElementById("radioP").disabled = false;
							document.getElementById("entrada").disabled = false;
							document.getElementById("parcelas").disabled = false;
							document.getElementById("vParcela").disabled = false;
<?php
				$cont = 0;
				
				$sqlCaracteristica = "SELECT * FROM caracteristicas WHERE statusCaracteristica = 'T' ORDER BY codOrdenacaoCaracteristica ASC";
				$resultCaracteristica = $conn->query($sqlCaracteristica);
				while($dadosCaracteristica = $resultCaracteristica->fetch_assoc()){
					$cont++;
?>
							document.getElementById("caracteristica<?php echo $cont;?>").disabled = false;
<?php
				}
?>
							document.getElementById("frente").disabled = false;
							document.getElementById("posicao").disabled = false;
							document.getElementById("tipo").disabled = false;
							document.getElementById("video").disabled = false;
							document.getElementById("observacoes").disabled = false;
							document.getElementById("alterar").disabled = false;
						}
					</script>
		
					<script>
						function moeda(z){  
							v = z.value;
							v=v.replace(/\D/g,"")  //permite digitar apenas números
							v=v.replace(/[0-9]{12}/,"inválido")   //limita pra máximo 999.999.999,99
							v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
							v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
							v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")	//coloca virgula antes dos últimos 2 digitos
							z.value = v;
						}
					</script>
						<form id="formulario" name="formImovel" action="<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $url[6] ;?>/" method="post">						

							<script type="text/javascript">
								function exibeCamposTipo(tipo){
									var $tg = jQuery.noConflict();
									if(tipo == 5){
										$tg("#formulario .retira").css("display", "none");
										$tg("#formulario .5").css("display", "block");
									}else
									if(tipo == 6){
										$tg("#formulario .retira").css("display", "none");
										$tg("#formulario .6").css("display", "block");
									}else
									if(tipo != ""){
										$tg("#formulario .retira").css("display", "none");
										$tg("#formulario .coloca").css("display", "block");
									}else{
										$tg("#formulario .coloca").css("display", "block");
										$tg("#formulario .6").css("display", "block");
									}
								}
							</script>

							<p class="bloco-campo-float"><label>Tipo Imóvel: <span class="obrigatorio"> * </span></label>
								<select class="campo" id="tipo" name="tipo" style="width:180px; height:32px;" required <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> onChange="exibeCamposTipo(this.value);">
									<option value="">Todos</option>
<?php
				$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE statusTipoImovel = 'T' ORDER BY nomeTipoImovel ASC";
				$resultTipoImovel = $conn->query($sqlTipoImovel);
				while($dadosTipoImovel = $resultTipoImovel->fetch_assoc()){
?>
									<option value="<?php echo $dadosTipoImovel['codTipoImovel'] ;?>" <?php echo $_SESSION['tipo'] == $dadosTipoImovel['codTipoImovel'] ? '/SELECTED/' : '';?>><?php echo $dadosTipoImovel['nomeTipoImovel'] ;?></option>
<?php
				}
?>					
								</select>
								<br class="clear"/>
							</p>

							<p class="bloco-campo-float"><label>Código: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" id="codigo" name="codigo" required style="width:80px;" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?>  value="<?php echo $_SESSION['codigo']; ?>" /></p>
														
							<p class="bloco-campo-float"><label>Corretor: <span class="obrigatorio"> * </span></label>
								<select class="campo" id="usuario" name="usuario" style="width:150px;" required <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?>>
									<option value="">Selecione</option>
<?php
				if($_COOKIE['codAprovado'.$cookie] == $dadosImovel['codUsuario'] || $filtraUsuario == ""){
					$sqlUsuarios = "SELECT nomeUsuario, codUsuario FROM usuarios WHERE statusUsuario = 'T' and codUsuario != 4".$filtraUsuario." ORDER BY nomeUsuario ASC";
				}else{
					$sqlUsuarios = "SELECT nomeUsuario, codUsuario FROM usuarios WHERE statusUsuario = 'T' and codUsuario != 4 ORDER BY nomeUsuario ASC";					
				}
				$resultUsuarios = $conn->query($sqlUsuarios);
				while($dadosUsuarios = $resultUsuarios->fetch_assoc()){
?>
									<option value="<?php echo $dadosUsuarios['codUsuario'] ;?>" <?php echo $_SESSION['usuario'] == $dadosUsuarios['codUsuario'] ? '/SELECTED/' : '';?>><?php echo $dadosUsuarios['nomeUsuario'] ;?></option>
<?php
}
?>					
								</select>
								<br class="clear"/>
							</p>
														
							<div id="auto_complete_softbest" style="width:364px; float:left; margin-right:10px; margin-bottom:15px; position:relative;">
								<p class="bloco-campo" style="margin-bottom:0px;"><label>Proprietário: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" name="proprietarios" style="width:520px;" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> value="<?php echo $_SESSION['proprietarios']; ?>" onClick="auto_complete(this.value, 'proprietarios_c', event);" onKeyUp="auto_complete(this.value, 'proprietarios_c', event);" onkeydown="if (getKey(event) == 13) return false;" onBlur="fechaAutoComplete('proprietarios_c');" autocomplete="off" id="busca_autocomplete_softbest_proprietarios_c" /></p>
								
								<div id="exibe_busca_autocomplete_softbest_proprietarios_c" class="auto_complete_softbest" style="display:none;">

								</div>
							</div>

							<br class="clear"/>						
												
							<p class="bloco-campo-float">
								<label>Preço à vista: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="preco" name="preco" style="width:150px;" onKeyUp="moeda(this);" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> value="<?php echo number_format($_SESSION['preco'], 2, ",", "."); ?>" />
							</p>

						    <p class="bloco-campo-float" style="margin-bottom: 0px; position: relative; top: 16px;">
								<label>
									<input type="radio" name="tipoValor"  <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> value="A" id="radioA" <?php if ($_SESSION['tipoValor'] == 'A') echo 'checked'; ?>> À vista
								</label>
								<label>
									<input type="radio" name="tipoValor" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> value="P"  id="radioP" <?php if ($_SESSION['tipoValor'] == 'P') echo 'checked'; ?>> Parcelado
								</label>
							</p>

							<p class="bloco-campo-float"  >
								<label>Entrada: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="entrada" name="entrada" style="width:115px;" onKeyUp="moeda(this);" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> value="<?php echo number_format($_SESSION['entrada'], 2, ",", "."); ?>"  />
							</p>

							<p class="bloco-campo-float" >
								<label>N° Parcelas: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="parcelas" name="parcelas" style="width:80px;" onKeyUp="calcularParcela();" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> value="<?php echo $_SESSION['parcelas']; ?>" />
							</p>


							<p class="bloco-campo-float" >
								<label>Valor da Parcela: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="vParcela" name="vParcela" style="width:115px;" onKeyUp="moeda(this);" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> value="<?php echo number_format($_SESSION['vParcela'], 2, ",", "."); ?>" />
							</p>

							<p class="bloco-campo-float"><label>Título do Anúncio: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" id="nome" name="nome" required style="width:308px;" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?>  value="<?php echo $_SESSION['nome']; ?>" /></p>

							<br class="clear" />

							<script type="text/javascript">
								function carregaBairro(cod){
									var $tgf = jQuery.noConflict();
									$tgf.post("<?php echo $configUrl;?>imoveis/imoveis/carrega-bairro.php", {codCidade: cod}, function(data){
										$tgf("#carrega-bairro").html(data);
										$tgf("#sel-padrao").css("display", "none");																									
									});
								}
							</script>
							<p class="bloco-campo-float"><label>País: <span class="obrigatorio"> * </span></label>
								<select class="campo" id="pais" name="pais" style="width:230px;" required  <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?>>
									<option value="">Selecione</option>
<?php
				$sqlPais = "SELECT nomePais, codPais FROM pais WHERE statusPais = 'T' ORDER BY nomePais ASC";
				$resultPais = $conn->query($sqlPais);
				while($dadosPais = $resultPais->fetch_assoc()){
?>
									<option value="<?php echo $dadosPais['codPais'] ;?>" <?php echo $_SESSION['pais'] == $dadosPais['codPais'] ? '/SELECTED/' : '';?>><?php echo $dadosPais['nomePais'] ;?></option>
<?php
				}
?>					
								</select>
								<br class="clear"/>
							</p>
							
							<p class="bloco-campo-float"><label>Cidade: <span class="obrigatorio"> * </span></label>
								<select class="campo" id="cidades" name="cidades" style="width:200px;" required onChange="carregaBairro(this.value);" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?>>
									<option value="">Selecione</option>
<?php
				$sqlCidade = "SELECT nomeCidade, codCidade FROM cidades WHERE statusCidade = 'T' ORDER BY nomeCidade ASC";
				$resultCidade = $conn->query($sqlCidade);
				while($dadosCidade = $resultCidade->fetch_assoc()){
?>
									<option value="<?php echo $dadosCidade['codCidade'] ;?>" <?php echo $_SESSION['cidades'] == $dadosCidade['codCidade'] ? '/SELECTED/' : '';?>><?php echo $dadosCidade['nomeCidade'] ;?></option>
<?php
				}
?>					
								</select>
								<br class="clear"/>
							</p>
							
<?php
				if($_SESSION['cidades'] == ""){
?>													
							<div id="sel-padrao">
								<p class="bloco-campo-float"><label class="label">Bairro: <span class="obrigatorio"> * </span></label>
									<select id="default-usage-select" id="bairro" class="campo" name="bairro" style="width:230px;" onChange="carregaQuadra();">
										<option id="option" value="">Selecione uma cidade primeiro</option>
									</select>
									<br class="clear"/>
								</p>
							</div>
<?php
				}
?>													
							<div id="carrega-bairro">
<?php
				if($_SESSION['cidades'] != ""){
?>
								<p class="bloco-campo-float"><label class="label">Bairro: <span class="obrigatorio"> * </span></label>
									<select class="campo" name="bairro" style="width:230px;" id="bairro" required <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> onChange="carregaQuadra();">
										<option value="" style="color:#FFF;">Selecione</option>

<?php
					$sqlBairro = "SELECT * FROM bairros WHERE statusBairro = 'T' and codCidade = ".$_SESSION['cidades']." ORDER BY nomeBairro ASC";
					$resultBairro = $conn->query($sqlBairro);
					while($dadosBairro = $resultBairro->fetch_assoc()){			
?>
										<option value="<?php echo $dadosBairro['codBairro']; ?>" <?php echo $dadosBairro['codBairro'] == $_SESSION['bairro'] ? '/SELECTED/' : ''; ?>><?php echo $dadosBairro['nomeBairro']; ?></option>
<?php
					}
?>
									</select>
								</p>
<?php
				}
?>
							</div>
							
							<script>
								function carregaQuadra(){
									var $pos = jQuery.noConflict();
									$pos.post("<?php echo $configUrlGer;?>imoveis/imoveis/quadras.php", {codQuadra: 1}, function(data){	
										var prepara = data.trim();	
										$pos("#carrega-quadras").html(prepara);
									});											
								}								
							</script>
							
							<div id="carrega-quadras">
<?php
				if($_SESSION['bairro'] != ""){
?>
								<p class="bloco-campo-float"><label>Quadra: <span class="obrigatorio"> * </span></label>
									<select class="selectQuadra form-control campo" id="idSelectQuadra" disabled="disabled" name="quadra" style="width:150px; display: none;">
										<optgroup label="Selecione">
										<option value="">Selecione</option>
<?php
					$sqlQuadrasLista = "SELECT * FROM quadras ORDER BY codQuadra ASC";
					$resultQuadrasLista = $conn->query($sqlQuadrasLista);
					while($dadosQuadrasLista = $resultQuadrasLista->fetch_assoc()){				
?>
										<option value="<?php echo trim($dadosQuadrasLista['nomeQuadra']);?>" <?php echo $_SESSION['quadra'] == trim($dadosQuadrasLista['nomeQuadra']) ? '/SELECTED/' : '';?> ><?php echo trim($dadosQuadrasLista['nomeQuadra']);?></option>	
<?php
					}
?>
									</select>										
								</p>

								<script>
									var $rfs = jQuery.noConflict();
									
									$rfs(".selectQuadra").select2({
										placeholder: "Selecione",
										multiple: false									
									});	
																		
									$rfs(".selectQuadra").on("select2:select", function (e) {
										var cidadeSeleciona = document.getElementById("cidades").value;
										var bairroSeleciona = document.getElementById("bairro").value;
										var quadraSeleciona = document.getElementById("idSelectQuadra").value;

										var $tgfs = jQuery.noConflict();
										$tgfs.post("<?php echo $configUrl;?>imoveis/imoveis/lotes.php", {codCidade: cidadeSeleciona, codBairro: bairroSeleciona, quadraImovel: quadraSeleciona}, function(data){
											$tgfs("#carrega-lotes").html(data);
										});									
									});																	
								</script>

<?php
				}else{
?>
								<p class="bloco-campo-float"><label>Quadra: <span class="obrigatorio"> * </span></label>
									<select class="selectQuadra form-control campo" id="idSelectQuadra" name="lote" multiple="" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:150px; display: none;">
										<optgroup label="Selecione">
									</select>										
								</p>

								<script>
									var $rfs = jQuery.noConflict();
									
									$rfs(".selectQuadra").select2({
										placeholder: "Selecione",
										multiple: false,
										templateResult: function (data, container) {
											if (data.element) {
												$rfs(container).addClass($rf(data.element).attr("class"));
											}
											return data.text;
										}									
									});										
								</script>								
<?php
				}
?>
							</div>
							
							<div id="carrega-lotes">
<?php
				if($_SESSION['lote'] != ""){

					$codCidade = $_SESSION['cidades'];
					$codBairro = $_SESSION['bairro'];
					$quadraImovel = $_SESSION['quadra'];					
?>
								<p class="bloco-campo-float"><label>Lote(s): <span class="obrigatorio"> * </span></label>
									<select class="selectLote form-control campo" id="idSelectLote" name="lote[]" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> multiple="" style="width:140px; display: none;">
										<optgroup label="Selecione">
											
<?php					
					$sqlLotesLista = "SELECT * FROM lotes ORDER BY codLote ASC";
					$resultLotesLista = $conn->query($sqlLotesLista);
					while($dadosLotesLista = $resultLotesLista->fetch_assoc()){
						
						$sqlImovel = "SELECT * FROM imoveis I inner join usuarios U on I.codUsuario = U.codUsuario WHERE I.statusImovel = 'T' and I.codCidade = '".$codCidade."' and I.codBairro = '".$codBairro."' and I.quadraImovel = '".$quadraImovel."' and I.loteImovel = '".trim($dadosLotesLista['nomeLote'])."' GROUP BY I.codImovel ORDER BY I.codImovel DESC LIMIT 0,1";
						$resultImovel = $conn->query($sqlImovel);
						$dadosImovel = $resultImovel->fetch_assoc();

						$nomeCorretor = explode(" ", $dadosImovel['nomeUsuario']);
																								
						$lotes = explode(",", $_SESSION['lote-antigo']);
						$loteOk = "";
						$loteOkConf = "";
						foreach($lotes as $lote) {
							$lote = trim($lote);
							if($lote == trim($dadosLotesLista['nomeLote'])){
								$loteOk = "sim";
								$loteOkConf = "sim";
							}
						}
																
						if($dadosImovel['codImovel'] == "" || $loteOk == "sim"){
							
							$sqlImovel = "SELECT * FROM imoveisLotes IL inner join imoveis I on IL.codImovel = I.codImovel inner join usuarios U on I.codUsuario = U.codUsuario WHERE I.statusImovel = 'T' and I.codCidade = '".$codCidade."' and I.codBairro = '".$codBairro."' and I.quadraImovel = '".$quadraImovel."' and IL.nomeLote = '".trim($dadosLotesLista['nomeLote'])."' GROUP BY IL.codImovelLote ORDER BY I.codImovel DESC LIMIT 0,1";
							$resultImovel = $conn->query($sqlImovel);
							$dadosImovel = $resultImovel->fetch_assoc();

							$nomeCorretor = explode(" ", $dadosImovel['nomeUsuario']);
							
							if($dadosImovel['codImovel'] == "" || $loteOk == "sim"){
								$classColor = "select2-green";
								$corretor = "";
								$disabled = "";					
							}else{
								$classColor = "select2-red";
								$corretor = " - ".$nomeCorretor[0];
								$disabled = "disabled='disabled'";								
							}			
						}else{
							$classColor = "select2-red";
							$corretor = " - ".$nomeCorretor[0];
							$disabled = "disabled='disabled'";							
						}					
?>
										<option class="<?php echo $classColor;?>" value="<?php echo trim($dadosLotesLista['nomeLote']);?>" <?php echo $loteOkConf == "sim" ? '/SELECTED/' : '';?> <?php echo $loteOkSe == "sim" ? '/SELECTED/' : '';?> <?php echo $disabled;?> ><?php echo trim($dadosLotesLista['nomeLote']).$corretor;?></option>	
<?php
					}
?>
									</select>										
								</p>
								<script>
									var $rf = jQuery.noConflict();
									
									$rf(".selectLote").select2({
										placeholder: "Selecione",
										multiple: true,
										allowClear: true,
										templateResult: function (data, container) {
											if (data.element) {
												$rf(container).addClass($rf(data.element).attr("class"));
											}
											return data.text;
										}									
									});										
								</script>
<?php
				}else{
?>
								<p class="bloco-campo-float"><label>Lote(s): <span class="obrigatorio"> * </span></label>
									<select class="selectLote form-control campo" id="idSelectLote" name="lote[]" multiple="" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:140px; display: none;">
										<optgroup label="Selecione">
									</select>										
								</p>

								<script>
									var $rf = jQuery.noConflict();
									
									$rf(".selectLote").select2({
										placeholder: "Selecione",
										multiple: true,
										templateResult: function (data, container) {
											if (data.element) {
												$rf(container).addClass($rf(data.element).attr("class"));
											}
											return data.text;
										}									
									});										
								</script>								
<?php
				}
?>
							</div>	

							<br class="clear"/>						

							<p class="bloco-campo-float coloca retira 6" style="<?php echo $_SESSION['tipo'] != 5 ? 'display:block;' : 'display:none;';?>"><label>Quartos: <span class="obrigatorio"> </span></label>
							<input class="campo" type="number" id="quartos" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="quartos" style="width:70px;" value="<?php echo $_SESSION['quartos']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 6" style="<?php echo $_SESSION['tipo'] != 5 ? 'display:block;' : 'display:none;';?>"><label>Suítes: <span class="obrigatorio"> </span></label>
							<input class="campo" type="number" id="suite" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="suite" style="width:70px;" value="<?php echo $_SESSION['suite']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 6" style="<?php echo $_SESSION['tipo'] != 5 ? 'display:block;' : 'display:none;';?>"><label>Banheiros: <span class="obrigatorio"> </span></label>
							<input class="campo" type="number" id="banheiros" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="banheiros" style="width:80px;" value="<?php echo $_SESSION['banheiros']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 6" style="<?php echo $_SESSION['tipo'] != 5 ? 'display:block;' : 'display:none;';?>"><label>Garagem: <span class="obrigatorio"> </span></label>
							<input class="campo" type="number" id="garagem" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="garagem" style="width:90px;" value="<?php echo $_SESSION['garagem']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 5 6"><label>Posição Solar: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="posicao" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="posicao" style="width:102px;" value="<?php echo $_SESSION['posicao']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 6" style="<?php echo $_SESSION['tipo'] != 5 ? 'display:block;' : 'display:none;';?>"><label>Área Construída: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="metragemC" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="metragemC" style="width:130px;" value="<?php echo $_SESSION['metragemC']; ?>" /></p>
							
							<p class="bloco-campo-float coloca retira 5" style="<?php echo $_SESSION['tipo'] != 6 ? 'display:block;' : 'display:none;';?>"><label>Frente: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="frente" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="frente" style="width:70px;" value="<?php echo $_SESSION['frente']; ?>" onKeyup="calculaArea();" /></p>
							
							<p class="bloco-campo-float coloca retira 5" style="<?php echo $_SESSION['tipo'] != 6 ? 'display:block;' : 'display:none;';?>"><label>Fundos: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="fundos" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="fundos" style="width:70px;" value="<?php echo $_SESSION['fundos']; ?>"  onKeyup="calculaArea();"/></p>

							<p class="bloco-campo-float coloca retira 5" style="<?php echo $_SESSION['tipo'] != 6 ? 'display:block;' : 'display:none;';?>"><label>Área Terreno: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="metragem" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="metragem" style="width:100px;" value="<?php echo $_SESSION['metragem']; ?>" /></p>

							<br class="clear"/>
							
							<p class="bloco-campo-float"><label>Sigla Área: <span class="obrigatorio"> </span></label>
							<label style="font-weight:normal; font-size:14px; float:left; margin-top:10px; margin-right:20px;"><input type="radio" id="siglaMetragem" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="siglaMetragem" <?php echo $_SESSION['siglaMetragem'] == "m²" ? 'checked' : '';?> <?php echo $_SESSION['siglaMetragem'] == "" ? 'checked' : '';?> value="m²"/> m²</label> <label style="font-weight:normal; font-size:14px; float:left; margin-top:10px;"><input type="radio" <?php echo $_SESSION['siglaMetragem'] == "ha" ? 'checked' : '';?> id="siglaMetragem2" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="siglaMetragem" value="ha"/> ha</label><br class="clear"/></p>
							


							<script type="text/javascript">
								function calculaArea(){
									var frente = document.getElementById("frente").value;
									var fundos = document.getElementById("fundos").value;
									
									if(frente != "" && fundos != ""){
										calcula = frente * fundos;
										document.getElementById("metragem").value=calcula;
									}
								}
							</script>
														
							<br class="clear"/>
						
							<p class="bloco-campo-float"><label style="font-weight:normal;">Preço Custo: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="precoC" name="precoC" style="width:120px;" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> onKeyUp="moeda(this);" value="<?php echo number_format($_SESSION['precoC'], 2, ",", "."); ?>" /></p>
							
							<p class="bloco-campo-float coloca retira 5 6"><label style="font-weight:normal;">Endereço: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="endereco" name="endereco" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:300px;" value="<?php echo $_SESSION['endereco']; ?>" /></p>

							<p class="bloco-campo-float retira 6" style="<?php echo $_SESSION['tipo'] == 6 ? 'display:block;' : 'display:none;';?>"><label style="font-weight:normal;">Nº Apartam.: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="nApartamento" id="nApartamento" name="nApartamento" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> style="width:130px;" value="<?php echo $_SESSION['nApartamento']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 5 6"><label style="font-weight:normal;">Matrícula: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="matricula" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="matricula" style="width:100px;" value="<?php echo $_SESSION['matricula']; ?>" /></p>
							
							<br class="clear"/>
							
							<p class="bloco-campo"><label>Link do Vídeo (Youtube): <span class="em" style="font-weight:normal;"> EX: https://www.youtube.com/watch?v=VKtTSoC7o2I</span></label>
							<input class="campo" type="text" id="video" name="video" style="width:980px;" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?>  value="<?php echo $_SESSION['video']; ?>" /></p>

							<br class="clear"/>

							<div class="bloco-campo" style="margin-bottom:25px;"><label>Características:<span class="obrigatorio"> </span></label><br/>
<?php
				$cont = 0;
				$contTodas = 0;
				
				$sqlCaracteristica = "SELECT * FROM caracteristicas WHERE statusCaracteristica = 'T' ORDER BY codOrdenacaoCaracteristica ASC";
				$resultCaracteristica = $conn->query($sqlCaracteristica);
				while($dadosCaracteristica = $resultCaracteristica->fetch_assoc()){
					
					$cont++;
					$contTodas++;
?>				
								<label style="font-weight:normal; float:left; width:200px; height:20px; cursor:pointer; font-size:14px; margin-top:10px;"><input type="checkbox" style="cursor:pointer;" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> value="<?php echo $dadosCaracteristica['codCaracteristica'];?>" <?php echo $_SESSION['caracteristica'.$url[6].$dadosCaracteristica['codCaracteristica']] == 'OK' ? 'checked' : '';?> id="caracteristica<?php echo $contTodas;?>" name="caracteristica<?php echo $contTodas;?>"/> <?php echo $dadosCaracteristica['nomeCaracteristica'];?></label>

<?php
					if($cont == 5){
						$cont = 0;
?>
								<br class="clear"/>
<?php
					}

				}
?>
								<input type="hidden" value="<?php echo $contTodas;?>" name="quantas"/>
								<br class="clear"/>
							</div>
							
							<p class="bloco-campo" style="width:997px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text" style="width:855px; height:200px;" ><?php echo $_SESSION['descricao']; ?></textarea></p>
							
							<p class="bloco-campo"><label style="font-weight:normal;">Observações:<span class="obrigatorio"> </span></label>
							<textarea class="desabilita campo" id="observacoes" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> name="observacoes" type="text" style="width:981px; height:150px;" ><?php echo $_SESSION['observacoes']; ?></textarea></p>

							<br class="clear"/>

							<div class="botao-expansivel"><p class="esquerda-botao"></p><input id="alterar" <?php echo $erroAtiva == "ok" ? "" : "disabled='disabled'";?> class="botao" type="submit" name="alterar" title="Alterar" value="Alterar"/><p class="direita-botao"></p></div>						
							<br class="clear"/>
						</form>
					</div>					
				</div>
<?php
				if($_SESSION['erro'] == "ok"){
					$_SESSION['codigo'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['usuario'] = "";
					$_SESSION['proprietario'] = "";
					$_SESSION['preco'] = "";
					$_SESSION['precoC'] = "";
					$_SESSION['cidades'] = "";
					$_SESSION['bairro'] = "";
					$_SESSION['endereco'] = "";
					$_SESSION['nApartamento'] = "";
					$_SESSION['lote'] = "";
					$_SESSION['quadra'] = "";
					$_SESSION['matricula'] = "";
					$_SESSION['metragem'] = "";
					$_SESSION['tipo'] = "";
					$_SESSION['tipoc'] = "";
					$_SESSION['video'] = "";
					$_SESSION['mapa'] = "";
					$_SESSION['descricao'] = "";
					$_SESSION['observacoes'] = "";
				}

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
