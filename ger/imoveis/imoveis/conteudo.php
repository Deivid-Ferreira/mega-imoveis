<?php
	if($_COOKIE['loginAprovado'.$cookie] != ""){

		if($controleUsuario == "tem usuario"){
			
			$area = "imoveisS";
			include('f/conf/validaAcesso.php');
			if($validaAcesso == "ok"){

				if($_SESSION['cadastro'] == "ok"){
					$erroConteudo = "<p class='erro'>Imóvel <strong>".$_SESSION['nome']."</strong> cadastrado com sucesso!</p>";
					$_SESSION['cadastro'] = "";
					$_SESSION['nome'] = "";
				}else	
				if($_SESSION['alteracaos'] == "ok"){
					$erroConteudo = "<p class='erro'>Imóvel <strong>".$_SESSION['nome']."</strong> alterado com sucesso!</p>";
					$_SESSION['alteracaos'] = "";
					$_SESSION['nome'] = "";
				}else	
				if($_SESSION['ativacaos'] == "ok"){
					$erroConteudo = "<p class='erro'>Imóvel <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']." com sucesso!</p>";
					$_SESSION['ativacaos'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['capa'] == "ok"){
					$erroConteudo = "<p class='erro'>Imóvel <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']."!</p>";
					$_SESSION['capa'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['destaque'] == "ok"){
					$erroConteudo = "<p class='erro'>Imóvel <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']."!</p>";
					$_SESSION['destaque'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['lancamento'] == "ok"){
					$erroConteudo = "<p class='erro'>Imóvel <strong>".$_SESSION['nome']."</strong> ".$_SESSION['acao']."!</p>";
					$_SESSION['lancamento'] = "";
					$_SESSION['nome'] = "";
				}else
				if($_SESSION['exclusaos'] == "ok"){
					$erroConteudo = "<p class='erro'>Imóvel <strong>".$_SESSION['nome']."</strong> excluído com sucesso!</p>";
					$_SESSION['exclusaos'] = "";
					$_SESSION['nome'] = "";
				}
				
				if(isset($_POST['tipoFiltro'])){
					if($_POST['tipoFiltro'] != ""){
						$_SESSION['tipoFiltro'] = $_POST['tipoFiltro'];
					}else{
						$_SESSION['tipoFiltro'] = "";
					}
				}
				
				if($_SESSION['tipoFiltro'] != ""){
					$filtraTipo = " and codTipoImovel = '".$_SESSION['tipoFiltro']."'";
				}	
				
				if(isset($_POST['cidadeFiltro'])){
					if($_POST['cidadeFiltro'] != ""){
						$_SESSION['cidadeFiltro'] = $_POST['cidadeFiltro'];
					}else{
						$_SESSION['cidadeFiltro'] = "";
					}
				}
				
				if($_SESSION['cidadeFiltro'] != ""){
					$filtraCidade = " and codCidade = '".$_SESSION['cidadeFiltro']."'";
				}															
				
				if(isset($_POST['bairroFiltro'])){
					if($_POST['bairroFiltro'] != ""){
						$_SESSION['bairroFiltro'] = $_POST['bairroFiltro'];
					}else{
						$_SESSION['bairroFiltro'] = "";
					}
				}
				
				if($_SESSION['bairroFiltro'] != ""){
					$filtraBairro = " and codBairro = '".$_SESSION['bairroFiltro']."'";
				}															
				
				if(isset($_POST['corretorFiltro'])){
					if($_POST['corretorFiltro'] != ""){
						$_SESSION['corretorFiltro'] = $_POST['corretorFiltro'];
					}else{
						$_SESSION['corretorFiltro'] = "";
					}
				}
				
				if($_SESSION['corretorFiltro'] != ""){
					$filtraCorretor = " and codUsuario = '".$_SESSION['corretorFiltro']."'";
				}		
				if(isset($_POST['valor1'])){
					if($_POST['valor1'] != ""){
						$_SESSION['valor1'] = $_POST['valor1'];
					}else{
						$_SESSION['valor1'] = "";
					}
				}
				
				if($_SESSION['valor1'] != ""){
					$filtraValor1 = " and precoImovel >= '".$_SESSION['valor1']."'";
				}																							
				
				if(isset($_POST['valor2'])){
					if($_POST['valor2'] != ""){
						$_SESSION['valor2'] = $_POST['valor2'];
					}else{
						$_SESSION['valor2'] = "";
					}
				}
				
				if($_SESSION['valor2'] != ""){
					$filtraValor2 = " and precoImovel <= '".$_SESSION['valor2']."'";
				}		
				
				if($filtraValor1 != "" || $filtraValor2 != ""){
					$ordena = ", precoImovel ASC";
				}
				
				
				if($_POST['ordemFiltro'] == "DESC"){ 
					$_SESSION['ordemFiltro'] = $_POST['ordemFiltro'];
					$filtraOrdem = ", codImovel DESC";
				}else
					if($_POST['ordemFiltro'] == "ASC"){ 
						$_SESSION['ordemFiltro'] = $_POST['ordemFiltro'];
						$filtraOrdem = ", codImovel ASC";
					}
					else{
						$filtraOrdem = "";
						$_SESSION['ordemFiltro'] = "";
					}

				if($_POST['atualizacao'] == "DESC"){
					 $_SESSION['atualizacao'] = $_POST['atualizacao'];
					$atualizacao = ", dataAtualizada DESC";
				}else
					if($_POST['atualizacao'] == "ASC"){ 
						 $_SESSION['atualizacao'] = $_POST['atualizacao'];
						$atualizacao = ", dataAtualizada ASC";
					}
					else{
						 $_SESSION['atualizacao'] = "";
						$atualizacao = "";
					}
					
				
																							
?>
				<div id="filtro">
					<div id="localizacao-filtro">
						<p class="nome-lista">Imóveis</p>
						<p class="flexa"></p>
						<p class="nome-lista">Imóveis</p>
						<br class="clear" />
					</div>

					<div class="demoTarget">
						<div id="formulario-filtro">
							<script type="text/javascript">
								function alteraFiltro(){
									document.getElementById("alteraFiltro").submit();
								}
							</script>
							<form id="alteraFiltro" action="<?php echo $configUrl;?>imoveis/imoveis/" method="post" >
								<p class="nome-clientes-filtro" style="width:190px;"><label class="label">Filtrar Código ou Nome:</label>
								<input type="text" style="width:175px; padding-top:6px; padding-bottom:6px;" name="imoveis" onKeyUp="buscaAvancada();" id="busca" autocomplete="off" value="<?php echo $_SESSION['nome-imoveis-filtro'];?>" /></p>
								<input style="display:none;" type="text" size="16" name="teste" value="" />

								<p class="bloco-campo-float"><label>Filtrar Cidade: <span class="obrigatorio"> </span></label>
									<select class="campo" id="cidadeFiltro" name="cidadeFiltro" style="width:190px; padding:5.5px; margin-right:0px;" onChange="alteraFiltro();">
										<option value="">Todos</option>
<?php
				$sqlCidades = "SELECT nomeCidade, codCidade FROM cidades WHERE statusCidade = 'T' ORDER BY nomeCidade ASC";
				$resultCidades = $conn->query($sqlCidades);
				while($dadosCidades = $resultCidades->fetch_assoc()){
?>
										<option value="<?php echo $dadosCidades['codCidade'] ;?>" <?php echo $_SESSION['cidadeFiltro'] == $dadosCidades['codCidade'] ? '/SELECTED/' : '';?>><?php echo $dadosCidades['nomeCidade'] ;?></option>
<?php
}
?>					
									</select>
									<br class="clear"/>
								</p>

<?php
				if($_SESSION['cidadeFiltro'] == ""){
?>													
								<div id="sel-padrao-f">
									<p class="bloco-campo-float" style="width:189px;"><label>Filtrar Bairro: <span class="obrigatorio"> </span></label>
										<select id="default-usage-select" id="bairroFiltro" class="campo" name="bairroFiltro" style="width:190px; padding:5.5px;">
											<option id="option" value="">Todos</option>
											<option id="option" value="">Selecione uma cidade</option>
										</select>
										<br class="clear"/>
									</p>
								</div>
<?php
				}
?>													
								<div id="carrega-bairro-f">
<?php
				if($_SESSION['cidadeFiltro'] != ""){
?>
									<p class="bloco-campo-float" style="width:189px;"><label>Filtrar Bairro: <span class="obrigatorio"> </span></label>
										<select class="campo" name="bairroFiltro" style="width:190px; padding:5.5px;" id="bairroFiltro" onChange="alteraFiltro();">
											<option value="">Todos</option>

<?php
					$sqlBairro = "SELECT * FROM bairros WHERE statusBairro = 'T' and codCidade = ".$_SESSION['cidadeFiltro']." ORDER BY nomeBairro ASC";
					$resultBairro = $conn->query($sqlBairro);
					while($dadosBairro = $resultBairro->fetch_assoc()){			
?>
											<option value="<?php echo $dadosBairro['codBairro']; ?>" <?php echo $dadosBairro['codBairro'] == $_SESSION['bairroFiltro'] ? '/SELECTED/' : ''; ?>><?php echo $dadosBairro['nomeBairro']; ?></option>
<?php
					}
?>	
										</select>
									</p>
<?php
				}
?>
								</div>

								<p class="bloco-campo-float" style="margin-right:0px;"><label>Filtrar Tipo imóvel: <span class="obrigatorio"> </span></label>
									<select class="campo" id="tipoFiltro" name="tipoFiltro" style="width:155px; padding:5.5px;" onChange="alteraFiltro();">
										<option value="">Todos</option>
<?php
				$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE statusTipoImovel = 'T' ORDER BY nomeTipoImovel ASC";
				$resultTipoImovel = $conn->query($sqlTipoImovel);
				while($dadosTipoImovel = $resultTipoImovel->fetch_assoc()){
?>
										<option value="<?php echo $dadosTipoImovel['codTipoImovel'] ;?>" <?php echo $_SESSION['tipoFiltro'] == $dadosTipoImovel['codTipoImovel'] ? '/SELECTED/' : '';?>><?php echo $dadosTipoImovel['nomeTipoImovel'] ;?></option>
<?php
				}
?>					
									</select>
									<br class="clear"/>
								</p>
<?php 
					include('imoveis/imoveis/filtro.php');	
?>


								<p class="bloco-campo-float" style="margin-right:0px;"><label>Filtrar Corretor: <span class="obrigatorio"> </span></label>
									<select class="campo" id="corretorFiltro" name="corretorFiltro" style="width:155px; padding:5.5px;" onChange="alteraFiltro();">
										<option value="">Todos</option>
<?php
				$sqlUsuario = "SELECT * FROM usuarios WHERE codUsuario != '' and codUsuario != 4 ORDER BY nomeUsuario ASC";
				$resultUsuario = $conn->query($sqlUsuario);
				while($dadosUsuario = $resultUsuario->fetch_assoc()){
?>
										<option value="<?php echo $dadosUsuario['codUsuario'] ;?>" <?php echo $_SESSION['corretorFiltro'] == $dadosUsuario['codUsuario'] ? '/SELECTED/' : '';?>><?php echo $dadosUsuario['nomeUsuario'] ;?></option>
<?php
				}
?>					
									</select>
								</p>
								<p class="botao-filtrar" style="margin-top:18px;"><input type="submit" name="filtrar" value="Filtrar" /></p>
								<div class="botao-novo" style="margin-top:17px; margin-left:0px;"><a title="Novo imóvel" onClick="abreCadastrar();"><div class="esquerda-novo"></div><div class="conteudo-novo" id="conteudo-novo-cliente">Novo Imóvel</div><div class="direita-novo"></div></a></div>
								<div class="botao-novo" style="display:none; margin-left:0px; margin-top:16px;" id="botaoFechar"><a title="Fechar" onClick="abreCadastrar();"><div class="esquerda-novo"></div><div class="conteudo-novo" id="conteudo-novo-cliente">X</div><div class="direita-novo"></div></a></div>
								<br class="clear" />
							</form>						
						</div>
					</div>
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
<?php
				if($_POST['nome'] != ""){
							
					include ('f/conf/criaUrl.php');
					$urlImovel = criaUrl($_POST['nome']);					

					$sqlProprietario = "SELECT codProprietario FROM proprietarios WHERE nomeProprietario = '".$_POST['proprietarios']."' LIMIT 0,1";
					$resultProprietario = $conn->query($sqlProprietario);
					$dadosProprietario = $resultProprietario->fetch_assoc();
					
					if($dadosProprietario['codProprietario'] != ""){

						$sqlCodigo = "SELECT * FROM imoveis WHERE statusImovel = 'T' and codigoImovel = '".$_POST['codigo']."' ORDER BY codImovel DESC LIMIT 0,1";
						$resultCodigo = $conn->query($sqlCodigo);
						$dadosCodigo = $resultCodigo->fetch_assoc();
					
						if($dadosCodigo['codigoImovel'] == ""){
						
							$descricao = str_replace("../../", $configUrlGer, $_POST['descricao']);
							$descricao = str_replace("../../", $configUrlGer, $descricao);
							
							$preco = $_POST['preco'];
							$preco = str_replace(".", "", $preco);
							$preco = str_replace(",", ".", $preco);
		
							$entrada = $_POST['entrada'];
							$entrada = str_replace(".", "", $entrada);
							$entrada = str_replace(",", ".", $entrada);
		
							$vParcela = $_POST['vParcela'];
							$vParcela = str_replace(".", "", $vParcela);
							$vParcela = str_replace(",", ".", $vParcela);
							
							$precoC = $_POST['precoC'];
							$precoC = str_replace(".", "", $precoC);
							$precoC = str_replace(".", "", $precoC);
							$precoC = str_replace(",", ".", $precoC);

							$sqlUltimoImovel = "SELECT codOrdenacaoImovel FROM imoveis ORDER BY codOrdenacaoImovel DESC LIMIT 0,1";
							$resultUltimoImovel = $conn->query($sqlUltimoImovel);
							$dadosUltimoImovel = $resultUltimoImovel->fetch_assoc();
							
							$novoOrdem = $dadosUltimoImovel['codOrdenacaoImovel'] + 1;	

							
					if($vParcela == ""){
						$vParcela = "0.00";
					}else{
						$vParcela = $vParcela;
					}	
					
					if($entrada == ""){
						$aVientradasta = "0.00";
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
																									
						 	$sql = "INSERT INTO imoveis (codOrdenacaoImovel, codigoImovel, codUsuario, codProprietario, nomeImovel, precoImovel, precoCImovel, paisImovel, codCidade, codBairro,entradaImovel, nParcelaImovel, valorParcelaImovel,valorImovel, enderecoImovel, nApartamentoImovel, quadraImovel, loteImovel,matriculaImovel, quartosImovel, banheirosImovel, suiteImovel, garagemImovel, metragemImovel, metragemCImovel,	fundosImovel, larguraImovel, frenteImovel, siglaMetragem, posicaoImovel, codTipoImovel, tipoCImovel, videoImovel, mapaImovel, descricaoImovel, observacoesImovel, destaqueImovel, lancamentoImovel, capaImovel, mostrarImovel, statusImovel, acessosImovel, urlImovel) VALUES (".$novoOrdem.", '".$_POST['codigo']."', ".$_POST['usuario'].", ".$dadosProprietario['codProprietario'].", '".preparaNome($_POST['nome'])."', '".$preco."', '".$precoC."', '".$_POST['pais']."',  '".$_POST['cidades']."', '".$_POST['bairro']."', '".$entrada."', '".$_POST['parcelas']."', '".$vParcela."', '".$_POST['tipoValor']."' , '".$_POST['endereco']."', '".$_POST['nApartamento']."', '".$_POST['quadra']."', '".$lote."', '".$_POST['matricula']."', '".$quartos."', '".$banheiros."', '".$suite."', '".$garagem."', '".$metragem."', '".$metragemC."', '".$fundos."', '".$largura."', '".$_POST['frente']."','".$_POST['siglaMetragem']."', '".$_POST['posicao']."', '".$_POST['tipo']."', 'V', '".str_replace("'", "&#39;", $_POST['video'])."', '".str_replace("'", "&#39;", $_POST['mapa'])."', '".str_replace("'", "&#39;", $descricao)."', '".str_replace("'", "&#39;", $_POST['observacoes'])."', 'F', 'F', 'F', 'T', 'T', 0, '".$urlImovel."')";
							$result = $conn->query($sql);

							if($result == 1){
								$_SESSION['nome'] = $_POST['nome'];
								$_SESSION['cadastro'] = "ok";
								
								$sqlImovel = "SELECT * FROM imoveis ORDER BY codImovel DESC LIMIT 0,1";
								$resultImovel = $conn->query($sqlImovel);
								$dadosImovel = $resultImovel->fetch_assoc();

								if(isset($_POST["lote"])) {
									$optionArray = $_POST["lote"];
									for($i = 0; $i < count($optionArray); $i++){
										$sql = "INSERT INTO imoveisLotes VALUES(0, '".$dadosImovel['codImovel']."', '".$optionArray[$i]."')";
										$result = $conn->query($sql);						
									}
								}
							
								for($i=1; $i<=$_POST['quantas']; $i++){
									if($_POST['caracteristica'.$i] != ""){
										$sqlInsere = "INSERT INTO caracteristicasImoveis VALUES(0, ".$_POST['caracteristica'.$i].", ".$dadosImovel['codImovel'].")";
										$resultInsere = $conn->query($sqlInsere);
									}
								}
															
								echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrlGer."imoveis/imoveis/imagens/".$dadosImovel['codImovel']."/'>";
							}else{
								$erroData = "<p class='erro'>Problemas ao cadastrar Imóvel!</p>";
								
								$display = "block";
							}
						}else{
							$erroData = "<p class='erro'>Código já esta sendo utilizado em outro imóvel!</p>";
							$_SESSION['proprietarios'] = "";
							$_SESSION['codigo'] = $_POST['codigo'];
							$_SESSION['nome'] = $_POST['nome'];
							$_SESSION['usuario'] = $_POST['usuario'];
							$_SESSION['preco'] = $_POST['preco'];
							$_SESSION['precoC'] = $_POST['precoC'];
							$_SESSION['pais'] = $_POST['cidades'];
							$_SESSION['cidades'] = $_POST['pais'];
							$_SESSION['bairros'] = $_POST['bairro'];
							$_SESSION['endereco'] = $_POST['endereco'];
							$_SESSION['nApartamento'] = $_POST['nApartamento'];
							$_SESSION['quadra'] = $_POST['quadra'];
							$_SESSION['lote'] = $_POST['lote'];
							$_SESSION['matricula'] = $_POST['matricula'];
							$_SESSION['quartos'] = $_POST['quartos'];
							$_SESSION['banheiros'] = $_POST['banheiros'];
							$_SESSION['suite'] = $_POST['suite'];
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
							
							$display = "block";
						}			
					}else{
						$erroData = "<p class='erro'>Proprietário não encontrado!</p>";
						$_SESSION['proprietarios'] = "";
						$_SESSION['codigo'] = $_POST['codigo'];
						$_SESSION['nome'] = $_POST['nome'];
						$_SESSION['usuario'] = $_POST['usuario'];
						$_SESSION['preco'] = $_POST['preco'];
						$_SESSION['precoC'] = $_POST['precoC'];
						$_SESSION['pais'] = $_POST['pais'];
						$_SESSION['cidades'] = $_POST['cidades'];
						$_SESSION['bairros'] = $_POST['bairro'];
						$_SESSION['endereco'] = $_POST['endereco'];
						$_SESSION['nApartamento'] = $_POST['nApartamento'];
						$_SESSION['quadra'] = $_POST['quadra'];
						$_SESSION['lote'] = $_POST['lote'];
						$_SESSION['matricula'] = $_POST['matricula'];
						$_SESSION['quartos'] = $_POST['quartos'];
						$_SESSION['banheiros'] = $_POST['banheiros'];
						$_SESSION['suite'] = $_POST['suite'];
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
						
						
						$display = "block";
					}			
				}else{
					$_SESSION['proprietarios'] = "";
					$_SESSION['codigo'] = "";
					$_SESSION['nome'] = "";
					$_SESSION['usuario'] = "";
					$_SESSION['preco'] = "";
					$_SESSION['precoC'] = "";
					$_SESSION['pais'] = "";
					$_SESSION['cidades'] = "";
					$_SESSION['bairros'] = "";
					$_SESSION['endereco'] = "";
					$_SESSION['nApartamento'] = "";
					$_SESSION['quadra'] = "";
					$_SESSION['lote'] = "";
					$_SESSION['matricula'] = "";
					$_SESSION['quartos'] = "";
					$_SESSION['banheiros'] = "";
					$_SESSION['suite'] = "";
					$_SESSION['garagem'] = "";
					$_SESSION['metragem'] = "";
					$_SESSION['metragemC'] = "";
					$_SESSION['fundos'] = "";
					$_SESSION['largura'] = "";
					$_SESSION['frente'] = "";
					$_SESSION['posicao'] = "";
					$_SESSION['tipo'] = "";
					$_SESSION['tipoc'] = "";
					$_SESSION['video'] = "";
					$_SESSION['mapa'] = "";
					$_SESSION['descricao'] = "";
					$_SESSION['observacoes'] = "";
					$_SESSION['siglaMetragem'] = "";
					
					$display = "none";

					function somarComZerosAEsquerda(string $numero1, string $numero2): string{
						$numero1Int = (int)$numero1;
						$numero2Int = (int)$numero2;

						$soma = $numero1Int + $numero2Int;
						$somaFormatada = sprintf('%04d', $soma);

						return $somaFormatada;
					}	
										
					$sqlCodigo = "SELECT * FROM imoveis WHERE statusImovel = 'T' ORDER BY codImovel DESC LIMIT 0,1";
					$resultCodigo = $conn->query($sqlCodigo);
					$dadosCodigo = $resultCodigo->fetch_assoc();
					
					if($dadosCodigo['codImovel'] != ""){
						
						$montaCodigo = somarComZerosAEsquerda(0001, $dadosCodigo['codigoImovel']);						
						
					}else{
						
						$montaCodigo = "0001";														
					}				
				}		
?>
					<div id="cadastrar" style="display:<?php echo $display;?>; margin-left:30px; margin-top:30px; margin-bottom:30px;">			
						<div class="botao-novo" style="margin-left:0px; margin-top:-20px; margin-bottom:20px;"><a href="<?php echo $configUrlGer;?>imoveis/tipoImovel/1/"><div class="esquerda-novo"></div><div class="conteudo-novo">Novo Tipo Imóvel</div><div class="direita-novo"></div></a></div>
						<br class="clear"/>
<?php
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
						<p style="color:#718B8F; font-weight:bold;">* Campos neste formato aparecerão no site</p>
						<p style="color:#718B8F;">* Campos neste formato não aparecerão no site</p>
						<br/>
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
						<form id="formulario" name="formImovel" action="<?php echo $configUrlGer; ?>imoveis/imoveis/" method="post">
							<input type="hidden" id="tipoEnvio" name="tipoEnvio" value="" />

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
								<select class="campo" id="tipo" name="tipo" style="width:180px; height:32px;" required onChange="exibeCamposTipo(this.value);">
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
							<input class="campo" type="text" id="codigo" name="codigo" style="width:80px;" required value="<?php echo $montaCodigo;?>" onKeyDown="Mascara(this,Integer);" onKeyPress="Mascara(this,Integer);" onKeyUp="Mascara(this,Integer);"/></p>
						
							<p class="bloco-campo-float"><label>Corretor: <span class="obrigatorio"> * </span></label>
								<select class="campo" id="usuario" name="usuario" style="width:150px; height:32px;" required>
									<option value="">Selecione</option>
<?php
				$sqlUsuarios = "SELECT nomeUsuario, codUsuario FROM usuarios WHERE statusUsuario = 'T' and codUsuario != 4".$filtraUsuario." ORDER BY nomeUsuario ASC";
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
								<input class="campo" type="text" name="proprietarios" style="width:527px;" value="<?php echo $_SESSION['proprietarios']; ?>" onClick="auto_complete(this.value, 'proprietarios_c', event);" onKeyUp="auto_complete(this.value, 'proprietarios_c', event);" onkeydown="if (getKey(event) == 13) return false;" onBlur="fechaAutoComplete('proprietarios_c');" autocomplete="off" id="busca_autocomplete_softbest_proprietarios_c" /></p>
								
								<div id="exibe_busca_autocomplete_softbest_proprietarios_c" class="auto_complete_softbest" style="display:none;">

								</div>
							</div>	

							<br class="clear" />

							<p class="bloco-campo-float"><label>Título do Anúncio: <span class="obrigatorio"> * </span></label>
							<input class="campo" type="text" id="nome" name="nome" style="width:330px;" required value="<?php echo $_SESSION['nome']; ?>" /></p>
							
							<p class="bloco-campo-float">
								<label>Preço à vista: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="preco" name="preco" style="width:150px;" onKeyUp="moeda(this);" value="<?php echo $_SESSION['preco']; ?>" />
							</p>

							<p class="bloco-campo-float" style="margin-bottom: 0px; position: relative; top: 16px;">
								<label><input type="radio" name="tipoValor" id="tipoValor" value="A" <?php  echo 'checked'; ?>> À vista</label>
								<label><input type="radio" name="tipoValor" id="tipoValor" value="P" > Parcelado</label>
							</p>

							<p class="bloco-campo-float" id="entrada" >
								<label>Entrada: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="entrada" name="entrada" style="width:100px;" onKeyUp="moeda(this);" value="" />
							</p>

							<p class="bloco-campo-float" id="campoParcelas">
								<label>N° Parcelas: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="parcelas" name="parcelas" style="width:80px;" onKeyUp="calcularParcela();" value="" />
							</p>


							<p class="bloco-campo-float" id="entrada" >
								<label>Valor da Parcela: <span class="obrigatorio"> </span></label>
								<input class="campo" type="text" id="vParcela" name="vParcela" style="width:115px;" onKeyUp="moeda(this);" value="" />
							</p>

							<br class="clear" />

							<p class="bloco-campo-float"><label>País: <span class="obrigatorio"> * </span></label>
								<select class="campo" id="pais" name="pais" style="width:246px;">
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

							<script type="text/javascript">
								function carregaBairro(cod){
									var $tgf = jQuery.noConflict();
									$tgf.post("<?php echo $configUrl;?>imoveis/imoveis/carrega-bairro.php", {codCidade: cod}, function(data){
										$tgf("#carrega-bairro").html(data);
										$tgf("#sel-padrao").css("display", "none");																									
									});
								}
							</script>
							
							<p class="bloco-campo-float"><label>Cidade: <span class="obrigatorio"> * </span></label>
								<select class="campo" id="cidades" name="cidades" style="width:200px;" required onChange="carregaBairro(this.value);">
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
									<select id="default-usage-select" id="bairro" class="campo" name="bairro" style="width:230px;">
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
									<select class="campo" name="bairro" style="width:230px;" id="bairro" required onChange="carregaQuadra();">
										<option value="" style="color:#FFF;">Selecione</option>

<?php
					$sqlBairro = "SELECT * FROM bairros WHERE statusBairro = 'T' and codCidade = ".$_SESSION['cidades']." ORDER BY nomeBairro ASC";
					$resultBairro = $conn->query($sqlBairro);
					while($dadosBairro = $resultBairro->fetch_assoc()){			
?>
										<option value="<?php echo $dadosBairro['codBairro']; ?>" <?php echo $dadosBairro['codBairro'] == $_SESSION['bairros'] ? '/SELECTED/' : ''; ?>><?php echo $dadosBairro['nomeBairro']; ?></option>
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
<?php
				if($_SESSION['quadra'] != ""){
?>							
							<p class="bloco-campo-float"><label>Quadra: <span class="obrigatorio"> * </span></label>
								<select class="selectQuadra form-control campo" id="idSelectQuadra" name="quadra" style="width:150px; display: none;">
									<optgroup label="Selecione">
<?php
				$sqlQuadrasLista = "SELECT * FROM quadras ORDER BY codQuadra ASC";
				$resultQuadrasLista = $conn->query($sqlQuadrasLista);
				while($dadosQuadrasLista = $resultQuadrasLista->fetch_assoc()){				
?>
									<option value="<?php echo trim($dadosQuadrasLista['nomeQuadra']);?>" <?php echo trim($dadosQuadrasLista['nomeQuadra']) == $_SESSION['quadra'] ? '/SELECTED/' : ''; ?> ><?php echo trim($dadosQuadrasLista['nomeQuadra']);?></option>	
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
							<div id="carrega-quadras">
								<p class="bloco-campo-float"><label>Quadra: <span class="obrigatorio"> * </span></label>
									<select class="selectQuadra form-control campo" id="idSelectQuadra" name="lote" multiple="" style="width:140px; display: none;">
										<optgroup label="Selecione">
									</select>										
								</p>
							</div>

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
							<div id="carrega-lotes">
<?php
				if($_SESSION['lote'] != ""){
					
					$codCidade = $_SESSION['cidades'];
					$codBairro = $_SESSION['bairro'];
					$quadraImovel = $_SESSION['quadra'];					
?>
								<p class="bloco-campo-float"><label>Lote(s): <span class="obrigatorio"> * </span></label>
									<select class="selectLote form-control campo" id="idSelectLote" name="lote[]" multiple="" style="width:140px; display: none;">
										<optgroup label="Selecione">
<?php
				$sqlLotesLista = "SELECT * FROM lotes ORDER BY codLote ASC";
				$resultLotesLista = $conn->query($sqlLotesLista);
				while($dadosLotesLista = $resultLotesLista->fetch_assoc()){
					
					$sqlImovel = "SELECT * FROM imoveis I inner join usuarios U on I.codUsuario = U.codUsuario WHERE I.statusImovel = 'T' and I.codCidade = '".$codCidade."' and I.codBairro = '".$codBairro."' and I.quadraImovel = '".$quadraImovel."' and I.loteImovel = ".trim($dadosLotesLista['nomeLote'])." GROUP BY I.codImovel ORDER BY I.codImovel DESC LIMIT 0,1";
					$resultImovel = $conn->query($sqlImovel);
					$dadosImovel = $resultImovel->fetch_assoc();

					$nomeCorretor = explode(" ", $dadosImovel['nomeUsuario']);

					$optionArray = $_SESSION['lote'];
					for($i = 0; $i < count($optionArray); $i++){
						if($optionArray[$i] == $dadosLotesLista['nomeLote']){
							$loteOk = "sim";
						}else{
							$loteOk = "";
						}
					}
																	
					if($dadosImovel['codImovel'] == ""){
						
						$sqlImovel = "SELECT * FROM imoveisLotes IL inner join imoveis I on IL.codImovel = I.codImovel inner join usuarios U on I.codUsuario = U.codUsuario WHERE I.statusImovel = 'T' and I.codCidade = '".$codCidade."' and I.codBairro = '".$codBairro."' and I.quadraImovel = '".$quadraImovel."' and IL.nomeLote = ".trim($dadosLotesLista['nomeLote'])." GROUP BY IL.codImovelLote ORDER BY I.codImovel DESC LIMIT 0,1";
						$resultImovel = $conn->query($sqlImovel);
						$dadosImovel = $resultImovel->fetch_assoc();
						
						$nomeCorretor = explode(" ", $dadosImovel['nomeUsuario']);
						
						if($dadosImovel['codImovel'] == ""){
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
										<option class="<?php echo $classColor;?>" value="<?php echo trim($dadosLotesLista['nomeLote']);?>" <?php echo $loteOk == "sim" ? '/SELECTED/' : '';?> <?php echo $disabled;?> ><?php echo trim($dadosLotesLista['nomeLote']).$corretor;?></option>	
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
									<select class="selectLote form-control campo" id="idSelectLote" name="lote[]" multiple="" style="width:140px; display: none;">
										<optgroup label="Selecione">
									</select>										
								</p>
<?php
				}
?>
							</div>	
							
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

							<br class="clear"/>

							<p class="bloco-campo-float coloca retira 6"><label>Quartos: <span class="obrigatorio"> </span></label>
							<input class="campo" type="number" id="quartos" name="quartos" style="width:70px;" value="<?php echo $_SESSION['quartos']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 6"><label>Suítes: <span class="obrigatorio"> </span></label>
							<input class="campo" type="number" id="suite" name="suite" style="width:70px;" value="<?php echo $_SESSION['suite']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 6"><label>Banheiros: <span class="obrigatorio"> </span></label>
							<input class="campo" type="number" id="banheiros" name="banheiros" style="width:80px;" value="<?php echo $_SESSION['banheiros']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 6"><label>Garagem: <span class="obrigatorio"> </span></label>
							<input class="campo" type="number" id="garagem" name="garagem" style="width:90px;" value="<?php echo $_SESSION['garagem']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 5 6"><label>Posição Solar: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="posicao" name="posicao" style="width:102px;" value="<?php echo $_SESSION['posicao']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 6"><label>Área Construída: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="metragemC" name="metragemC" style="width:130px;" value="<?php echo $_SESSION['metragemC']; ?>" /></p>
							
							<p class="bloco-campo-float coloca retira 5 6"><label>Frente: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="frente" name="frente" style="width:60px;" value="<?php echo $_SESSION['frente']; ?>" onKeyup="calculaArea();" /></p>
							
							<p class="bloco-campo-float coloca retira 5"><label>Fundos: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="fundos" name="fundos" style="width:70px;" value="<?php echo $_SESSION['fundos']; ?>" onKeyup="calculaArea();" /></p>

							<p class="bloco-campo-float coloca retira 5"><label>Área Terreno: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="metragem" name="metragem" style="width:100px;" value="<?php echo $_SESSION['metragem']; ?>" /></p>

							<br class="clear"/>

							<p class="bloco-campo-float"><label>Sigla Área: <span class="obrigatorio"> </span></label>
							<label style="font-weight:normal; font-size:14px; float:left; margin-top:10px; margin-right:20px;"><input type="radio" id="siglaMetragem" name="siglaMetragem" <?php echo $_SESSION['siglaMetragem'] == "m²" ? 'checked' : '';?> <?php echo $_SESSION['siglaMetragem'] == "" ? 'checked' : '';?> value="m²"/> m²</label> <label style="font-weight:normal; font-size:14px; float:left; margin-top:10px;"><input type="radio" <?php echo $_SESSION['siglaMetragem'] == "ha" ? 'checked' : '';?> id="siglaMetragem2" name="siglaMetragem" value="ha"/> ha</label><br class="clear"/></p>
								
							
							
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
							<input class="campo" type="text" id="precoC" name="precoC" style="width:120px;" onKeyUp="moeda(this);" value="<?php echo $_SESSION['precoC']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 5 6"><label style="font-weight:normal;">Endereço: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="endereco" name="endereco" style="width:300px;" value="<?php echo $_SESSION['endereco']; ?>" /></p>

							<p class="bloco-campo-float retira 6"><label style="font-weight:normal;">Nº do Apartamento: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="nApartamento" id="nApartamento" name="nApartamento" style="width:130px;" value="<?php echo $_SESSION['nApartamento']; ?>" /></p>

							<p class="bloco-campo-float coloca retira 5 6"><label style="font-weight:normal;">Matrícula: <span class="obrigatorio"> </span></label>
							<input class="campo" type="text" id="matricula" name="matricula" style="width:100px;" value="<?php echo $_SESSION['matricula']; ?>" /></p>
							
							<br class="clear"/>
							
							<p class="bloco-campo-float"><label>Link do Vídeo (Youtube): <span class="em" style="font-weight:normal;"> EX: https://www.youtube.com/watch?v=VKtTSoC7o2I</span></label>
							<input class="campo" type="text" id="video" name="video" style="width:980px;" value="<?php echo $_SESSION['video']; ?>" /></p>

							<br class="clear"/>

							<div class="bloco-campo" style="margin-bottom:25px;"><label>Características:<span class="obrigatorio"> </span></label><br/>
<?php
				$cont = 0;
				$contTodas = 0;
				
				$sqlCaracteristicas = "SELECT * FROM caracteristicas WHERE statusCaracteristica = 'T' ORDER BY codOrdenacaoCaracteristica ASC";
				$resultOpcionais = $conn->query($sqlCaracteristicas);
				while($dadosOpcionais = $resultOpcionais->fetch_assoc()){
				
					$cont++;
					$contTodas++;
?>				
								<label style="font-weight:normal; float:left; width:200px; height:30px; cursor:pointer; font-size:14px;"><input type="checkbox" style="cursor:pointer;" value="<?php echo $dadosOpcionais['codCaracteristica'];?>" name="caracteristica<?php echo $contTodas;?>"/> <?php echo $dadosOpcionais['nomeCaracteristica'];?></label>

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
							
							<p class="bloco-campo" style="width:995px; margin-top:-20px;"><label>Descrição:<span class="obrigatorio"> </span></label>
							<textarea class="campo textarea" id="descricao" name="descricao" type="text"><?php echo $_SESSION['descricao']; ?></textarea></p>
							
							<p class="bloco-campo"><label style="font-weight:normal;">Observações:<span class="obrigatorio"> </span></label>
							<textarea class="desabilita campo" id="observacoes" name="observacoes" type="text" style="width:980px; height:150px;" ><?php echo $_SESSION['observacoes']; ?></textarea></p>
							
							<p class="bloco-campo"><div class="botao-expansivel"><p class="esquerda-botao"></p><input class="botao" type="submit" name="cadastrar" title="Salvar Imóvel" value="Salvar" /><p class="direita-botao"></p></div></p>						
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
								$AGD("#busca-carregada").load("<?php echo $configUrl;?>imoveis/imoveis/busca-imovel.php?busca="+busca);
								if(busca == ""){
									document.getElementById("paginacao").style.display="block";
								}else{
									document.getElementById("paginacao").style.display="none";
								}
							}	
						</script>
						<div id="busca-carregada">
<?php
	$sqlConta = "SELECT nomeImovel FROM imoveis WHERE codImovel !=''".$filtraCidade.$filtraBairro.$filtraTipo.$filtraCorretor.$filtraValor1.$filtraValor2."";
	$resultConta = $conn->query($sqlConta);
	$dadosConta = $resultConta->fetch_assoc();
	$registros = mysqli_num_rows($resultConta);
	
	if($dadosConta['nomeImovel'] != ""){

?>

							<table class="tabela-menus" >
								<tr class="titulo-tabela" border="none">
									<th class="canto-esq">Código</th>
									<th>Título do Anúncio</th>
									<th>Tipo imóvel</th>
									<th>Bairro / Cidade</th>
									<th>Lote / Quadra</th>
									<th>Preço</th>
									<th>Ordenar</th>
									<th>Capa</th>
									<th>Destaques</th>
									<th>Status</th>
									<th>Imagens</th>
									<th>Anexos</th>
									<th>Alterar</th>
									<th class="canto-dir">Excluir</th>
								</tr>	
								<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
								<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
											
<?php

		if($url[5] == 1 || $url[5] == ""){
			 $pagina = 1;
			 $sqlImovel = "SELECT * FROM imoveis WHERE codImovel !=''".$filtraCidade.$filtraBairro.$filtraTipo.$filtraCorretor.$filtraValor1.$filtraValor2." ORDER BY statusImovel ASC ".$atualizacao.$filtraOrdem.$ordena.", codOrdenacaoImovel DESC, capaImovel ASC, codCidade ASC, codBairro ASC,  quadraImovel ASC, loteImovel ASC, codImovel DESC, destaqueImovel ASC LIMIT 0,30";
		}else{
			$pagina = $url[5];
			$paginaFinal = $pagina * 30;
			$paginaInicial = $paginaFinal - 30;
		 	$sqlImovel = "SELECT * FROM imoveis WHERE codImovel !=''".$filtraCidade.$filtraBairro.$filtraTipo.$filtraCorretor.$filtraValor1.$filtraValor2." ORDER BY statusImovel ASC".$atualizacao.$filtraOrdem.$ordena.", codOrdenacaoImovel DESC, capaImovel ASC, codCidade ASC, codBairro ASC, quadraImovel ASC, loteImovel ASC, codImovel DESC, destaqueImovel ASC  LIMIT ".$paginaInicial.",30";
		}		
		
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){
		$mostrando = $mostrando + 1;
				
		if($dadosImovel['statusImovel'] == "T"){
			$status = "status-ativo";
			$statusIcone = "ativado";
			$statusPergunta = "desativar";
		}else{
			$status = "status-desativado";
			$statusIcone = "desativado";
			$statusPergunta = "ativar";
		}					

		if($dadosImovel['capaImovel'] == "T"){
			$capa = "capa-ativo";
			$capaIcone = "ativado";
			$capaPergunta = "não destaque o imóvel ";
		}else{
			$capa = "capa-desativado";
			$statusIcone = "desativado";
			$statusPergunta = "destaque o imóvel";
		}	
		
		if($dadosImovel['destaqueImovel'] == "T"){
			$destaque = "destaque-ativado";
			$destaqueIcone = "ativado";
			$destaquePergunta = "retirar o imóvel ";
		}else{
			$destaque = "destaque-desativado";
			$destaqueIcone = "desativado";
			$destaquePergunta = "colocar o ";
		}	
		
		if($dadosImovel['lancamentoImovel'] == "T"){
			$lancamento = "lancamento-ativado";
			$lancamentoIcone = "ativado";
			$lancamentoPergunta = "retirar o imóvel ";
		}else{
			$lancamento = "lancamento-desativado";
			$lancamentoIcone = "desativado";
			$lancamentoPergunta = "colocar o ";
		}	
		
		if($dadosImovel['tipoCImovel'] == 'V'){
			$comercial = "Venda";
		}else{
			$comercial = "Aluguel";
		}
				
		$sqlCidade = "SELECT * FROM cidades WHERE statusCidade = 'T' and codCidade = ".$dadosImovel['codCidade']." and codCidade = ".$dadosImovel['codCidade']." ORDER BY codCidade DESC LIMIT 0,1";
		$resultCidade = $conn->query($sqlCidade);
		$dadosCidade = $resultCidade->fetch_assoc();
		
		$sqlBairro = "SELECT * FROM bairros WHERE statusBairro = 'T' and codBairro = ".$dadosImovel['codBairro']." ORDER BY codBairro DESC LIMIT 0,1";
		$resultBairro = $conn->query($sqlBairro);
		$dadosBairro = $resultBairro->fetch_assoc();
		
		$sqlTipo = "SELECT * FROM tipoImovel WHERE statusTipoImovel = 'T' and codTipoImovel = ".$dadosImovel['codTipoImovel']." ORDER BY codTipoImovel DESC LIMIT 0,1";
		$resultTipo = $conn->query($sqlTipo);
		$dadosTipo = $resultTipo->fetch_assoc();
		
		$sqlUsuario = "SELECT * FROM usuarios WHERE codUsuario = ".$dadosImovel['codUsuario']." LIMIT 0,1";
		$resultUsuario = $conn->query($sqlUsuario);
		$dadosUsuario = $resultUsuario->fetch_assoc();

		$sqlImagem = "SELECT * FROM imoveisImagens WHERE codImovel = ".$dadosImovel['codImovel']." ORDER BY ordenacaoImovelImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();

		if (!empty($dadosImagem['codImovelImagem'])){
			$imagem = 'rel="lightbox[roadtrip]" href="' . $configUrlGer . 'f/imoveis/' . $dadosImagem['codImovel'] . '-' . $dadosImagem['codImovelImagem'] . '-W.webp"';
			$displayBotao = "";
		}
		else{    
			$imagem = 'href="' . $configUrl . 'imoveis/imoveis/imagens/' . $dadosImovel['codImovel'] . '/"'; 
			$displayBotao = "display:none;";
		}

		
		if($filtraUsuario == ""){						
?>
								<tr class="tr">
									<td class="dez" style="width:8%; text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosImovel['codigoImovel'];?></a></td>
									<td class="trinta" style="text-align:left;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosImovel['nomeImovel'];?></a></td>
									<td class="dez" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosTipo['nomeTipoImovel'];?><br/><?php echo $comercial;?></a></td>
									<td class="trinta" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosBairro['nomeBairro'];?><br/><?php echo $dadosCidade['nomeCidade'];?></a></td>
									<td class="vinte" style="width:10%; text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'>Quadra: <?php echo $dadosImovel['quadraImovel'];?><br/>Lote: <?php echo $dadosImovel['loteImovel'];?></a></td>
									<td class="vinte" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'> <?php if( $dadosImovel['valorImovel'] == "P"){ ?>   Entrada de <?php echo number_format( $dadosImovel['entradaImovel'], 2, ",", "."); ?> + <?php echo $dadosImovel['nParcelaImovel']; ?> x de  <?php echo number_format( $dadosImovel['valorParcelaImovel'], 2, ",", "."); ?>   <?php }else{  ?>R$ <?php echo number_format($dadosImovel['precoImovel'], 2, ",", "."); }?></a></td>									
<?php
			if($dadosImovel['capaImovel'] == "T"){
?>
									<td class="dez" style="text-align:center;"><input type="number" class="campo" style="width:30px; text-align:center; border:1px solid #0000FF; outline:none;" value="<?php echo $dadosImovel['codOrdenacaoImovel'];?>" onClick="alteraCor(<?php echo $dadosImovel['codImovel'];?>);" onBlur="alteraOrdem(<?php echo $dadosImovel['codImovel'];?>, this.value);" id="codOrdena<?php echo $dadosImovel['codImovel'];?>"/></td>
<?php
			}else{
?>									  
									<td class="vinte" style="width:10%; padding:0px; text-align:center;">--</td>
<?php
			}
?>

									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/capa/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja <?php echo $capaPergunta ?> <?php echo $dadosImovel['nomeImovel'] ?> na capa do site?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $capa ?>.gif" alt="icone"></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/destaque/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja <?php echo $destaquePergunta ?> <?php echo $dadosImovel['nomeImovel'] ?> do site ?' ><img src="<?php echo $configUrl; ?>f/i/<?php echo $destaque ?>.png" alt="icone"></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/ativacao/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja <?php echo $statusPergunta ?> o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" <?php echo $imagem  ?> title='Deseja gerenciar imagens do imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img style="<?php echo $dadosImagem['codImovelImagem'] == "" ? 'display:none;' : 'padding-top:5px;';?>" src="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagem['codImovel'].'-'.$dadosImagem['codImovelImagem'].'-W.webp';?>" height="38"/><img style="<?php echo $dadosImagem['codImovelImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></a><a  href='<?php echo $configUrl; ?>imoveis/imoveis/imagens/<?php echo $dadosImovel['codImovel'] ?>/' style="background-color: #6ea2a2; color: white; padding: 2px 17px; border-radius: 6px; display: block; <?php echo  $displayBotao; ?>">Cadastrar</a></td>
									



									<td class="botoes"><a href='<?php echo $configUrl; ?>imoveis/imoveis/anexos/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja cadastrar anexos para o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src="<?php echo $configUrl;?>f/i/geren-documentos.png" alt="icone"/></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja alterar o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='javascript: confirmaExclusao(<?php echo $dadosImovel['codImovel'] ?>, "<?php echo htmlspecialchars($dadosImovel['nomeImovel']) ?>");' title='Deseja excluir o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
		}else{
			if($_COOKIE['codAprovado'.$cookie] == $dadosImovel['codUsuario']){
				
?>
								<tr class="tr">
									<td class="dez" style="width:8%; text-align:center; font-weight:bold;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosImovel['codigoImovel'];?></a></td>
									<td class="trinta" style="text-align:left;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosImovel['nomeImovel'];?></a></td>
									<td class="dez" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosTipo['nomeTipoImovel'];?><br/><?php echo $comercial;?></a></td>
									<td class="trinta" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosBairro['nomeBairro'];?><br/><?php echo $dadosCidade['nomeCidade'];?></a></td>
									<td class="vinte" style="width:10%; text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'>Quadra: <?php echo $dadosImovel['quadraImovel'];?><br/>Lote: <?php echo $dadosImovel['loteImovel'];?></a></td>
									<td class="vinte" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'> <?php if( $dadosImovel['valorImovel'] == "P"){ ?>   Entrada de <?php echo number_format( $dadosImovel['entradaImovel'], 2, ",", "."); ?> + <?php echo $dadosImovel['nParcelaImovel']; ?> x de  <?php echo number_format( $dadosImovel['valorParcelaImovel'], 2, ",", "."); ?>   <?php }else{  ?>R$ <?php echo number_format($dadosImovel['precoImovel'], 2, ",", "."); }?></a></td>									
									<td class="vinte" style="width:10%; padding:0px; text-align:center;">--</td>									
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/capa/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja <?php echo $capaPergunta ?> <?php echo $dadosImovel['nomeImovel'] ?> na capa do site?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $capa ?>.gif" alt="icone"></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/destaque/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja <?php echo $destaquePergunta ?> <?php echo $dadosImovel['nomeImovel'] ?> do site ?' ><img src="<?php echo $configUrl; ?>f/i/<?php echo $destaque ?>.png" alt="icone"></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/ativacao/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja <?php echo $statusPergunta ?> o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></a></td>


									<td class="botoes" style="width:5%;"><a style="padding:0px;" <?php echo $imagem  ?> title='Deseja gerenciar imagens do imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img style="<?php echo $dadosImagem['codImovelImagem'] == "" ? 'display:none;' : 'padding-top:5px;';?>" src="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagem['codImovel'].'-'.$dadosImagem['codImovelImagem'].'-W.webp';?>" height="38"/><img style="<?php echo $dadosImagem['codImovelImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></a><a  href='<?php echo $configUrl; ?>imoveis/imoveis/imagens/<?php echo $dadosImovel['codImovel'] ?>/ ' style="background-color: #6ea2a2; color: white; padding: 2px 17px; border-radius: 6px; display: block; <?php echo  $displayBotao; ?>">Cadastrar</a></td>
									

									<td class="botoes"><a href='<?php echo $configUrl; ?>imoveis/imoveis/anexos/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja cadastrar anexos para o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src="<?php echo $configUrl;?>f/i/geren-documentos.png" alt="icone"/></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja alterar o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='javascript: confirmaExclusao(<?php echo $dadosImovel['codImovel'] ?>, "<?php echo htmlspecialchars($dadosImovel['nomeImovel']) ?>");' title='Deseja excluir o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src='<?php echo $configUrl; ?>f/i/default/corpo-default/excluir.gif' alt="icone"></a></td>
								</tr>
<?php
			}else{
?>
								<tr class="tr">
									<td class="dez" style="width:8%; text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosImovel['codigoImovel'];?></a></td>
									<td class="trinta" style="text-align:left;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosImovel['nomeImovel'];?></a></td>
									<td class="dez" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosTipo['nomeTipoImovel'];?><br/><?php echo $comercial;?></a></td>
									<td class="trinta" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'><?php echo $dadosBairro['nomeBairro'];?><br/><?php echo $dadosCidade['nomeCidade'];?></a></td>
									<td class="vinte" style="width:10%; text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'>Quadra: <?php echo $dadosImovel['quadraImovel'];?><br/>Lote: <?php echo $dadosImovel['loteImovel'];?></a></td>
									<td class="vinte" style="text-align:center;"><a style="padding:0px;" href='<?php echo $configUrlGer; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Veja os detalhes do imóvel <?php echo $dadosImovel['nomeImovel'] ?>'> <?php if( $dadosImovel['valorImovel'] == "P"){ ?>   Entrada de <?php echo number_format( $dadosImovel['entradaImovel'], 2, ",", "."); ?> + <?php echo $dadosImovel['nParcelaImovel']; ?> x de  <?php echo number_format( $dadosImovel['valorParcelaImovel'], 2, ",", "."); ?>   <?php }else{  ?>R$ <?php echo number_format($dadosImovel['precoImovel'], 2, ",", "."); }?></a></td>									
									<td class="vinte" style="width:10%; padding:0px; text-align:center;">--</td>
									<td class="botoes" style="width:5%;"><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $capa ?>.gif" alt="icone"></td>
									<td class="botoes" style="width:5%;"><img src="<?php echo $configUrl; ?>f/i/<?php echo $destaque ?>.png" alt="icone"></td>
									<td class="botoes" style="width:5%;"><img src="<?php echo $configUrl; ?>f/i/default/corpo-default/<?php echo $status ?>.gif" alt="icone"></td>
									<td class="botoes" style="width:5%;"><img style="<?php echo $dadosImagem['codImovelImagem'] == "" ? 'display:none;' : 'padding-top:5px;';?>" src="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagem['codImovel'].'-'.$dadosImagem['codImovelImagem'].'-W.webp';?>" height="38"/><img style="<?php echo $dadosImagem['codImovelImagem'] != "" ? 'display:none;' : '';?>" src="<?php echo $configUrl; ?>f/i/default/corpo-default/gerenciar-imagens.gif" alt="icone"></td>
									<td class="botoes"><a href='<?php echo $configUrl; ?>imoveis/imoveis/anexos/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja cadastrar anexos para o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src="<?php echo $configUrl;?>f/i/geren-documentos.png" alt="icone"/></a></td>
									<td class="botoes" style="width:5%;"><a style="padding:0px;" href='<?php echo $configUrl; ?>imoveis/imoveis/alterar/<?php echo $dadosImovel['codImovel'] ?>/' title='Deseja alterar o imóvel <?php echo $dadosImovel['nomeImovel'] ?>?' ><img src="<?php echo $configUrl;?>f/i/default/corpo-default/icones-alterar.gif" alt="icone" /></a></td>
									<td class="dez" style="width:5%; text-align:center;">--</td>
								</tr>
<?php			
			
			}
		}	
	}
?>
								<script type="text/javascript">
									function confirmaExclusao(cod, nome){
										if(confirm("Deseja excluir o imóvel "+nome+"?")){
											window.location='<?php echo $configUrlGer; ?>imoveis/imoveis/excluir/'+cod+'/';
										}
									}

									function alteraCor(cod){
										var $po2 = jQuery.noConflict();
										$po2("#codOrdena"+cod).css("border", "1px solid #FF0000");
									}

									function alteraOrdem(cod, ordem){
										var $po = jQuery.noConflict();
										$po.post("<?php echo $configUrlGer;?>imoveis/imoveis/ordem.php", {codImovel: cod, codOrdenacaoImovel: ordem}, function(data){		
											$po("#codOrdena"+cod).css("border", "1px solid #0000FF");
										});											
									}
								</script> 
							</table>
						</div>		
<?php
}
		$regPorPagina = 30;
		$area = "imoveis/imoveis";
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
?>
<?php
}else{
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."controle-acesso.php'>";
}

}else{
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."login.php'>";
}

?>
