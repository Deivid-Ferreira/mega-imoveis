<div id="conteudo-filtro">								
<?php
	if($_POST['codigo-busca'] != "T" && $_POST['codigo-busca'] != ""){
		$codigo = $_POST['codigo-busca'];
		
		$_SESSION['cidade-busca'] = "";		
		$_SESSION['bairro-busca'] = "";
		$_SESSION['bairro-filtro'] = "";
		$_SESSION['ordenar-busca'] = "";

		$filtraImoveis = " and I.codigoImovel = '".$codigo."'";		
	}else{
		$_SESSION['busca'] = "";
		$_SESSION['numero'] = "";
		$_SESSION['pedacos'] = "";
			

		if($url[3] == "" || is_numeric($url[3])){
			$_SESSION['tipoImovel'] = "";
		}
		if($cidadeFiltra == ""){
			if(isset($_POST['cidade-busca'])){
				if($_POST['cidade-busca'] == ""){
					$_SESSION['cidade-busca'] = "";
				}else{
					$_SESSION['cidade-busca'] = $_POST['cidade-busca'];
				}
			}
					
			if($_SESSION['cidade-busca'] != ""){
				$filtraCidade = " and I.codCidade = '".$_SESSION['cidade-busca']."'";
			}
		}else{
			$_SESSION['cidade-busca'] = $cidadeFiltra;
			$filtraCidade = " and I.codCidade = '".$_SESSION['cidade-busca']."'";			
		}
				
		if(isset($_POST['negociacao'])){
			if($_POST['negociacao'] == "T"){
				$_SESSION['negociacao'] = "";
			}else{
				$_SESSION['negociacao'] = $_POST['negociacao'];
			}
		}
				
		if($_SESSION['negociacao'] != ""){
			$filtraNegociacao = " and I.tipoCImovel = '".$_SESSION['negociacao']."'";
		}
					
		if(isset($_POST["cidade-busca"]) || isset($_POST["bairro"])){
			if($_POST["bairro"] != ""){
				$optionArray = $_POST["bairro"];
				for($i = 0; $i < count($optionArray); $i++){								
					if($i == 0){
						$filtraBairro .= " and (I.codBairro = ".$optionArray[$i]."";
					}else{
						$filtraBairro .= " or I.codBairro = ".$optionArray[$i]."";
					}						
				}	

			}	

			if($filtraBairro != ""){
				$filtraBairro .= ")";
				$_SESSION['bairro-filtro'] = $filtraBairro;			
				$_SESSION['bairro-busca'] = $_POST["bairro"];			
			}else{
				$_SESSION['bairro-filtro'] = "";
				$_SESSION['bairro-busca'] = "";
			}
		}
			
		if(isset($_POST['bairro-gaivota'])){
			$_SESSION['bairro-filtro'] = "and (I.codBairro = ".$_POST['bairro-gaivota'].")";
			$_SESSION['bairro-busca'] = array(0 => $_POST['bairro-gaivota']);
		}
				
		if($_SESSION['bairro-filtro'] != ""){
			$filtraBairro = $_SESSION['bairro-filtro'];
		}
			
		if($url[3] == "" || is_numeric($url[3])){
			$_SESSION['tipoImovel'] = "";
		}
				
		if($tipoImovel == ""){
			if(isset($_POST['imovel-busca'])){
				if($_POST['imovel-busca'] == ""){
					$_SESSION['imovel-busca'] = "";
				}else{
					$_SESSION['imovel-busca'] = $_POST['imovel-busca'];
				}
			}
			
			if($_SESSION['imovel-busca'] != ""){
				$filtraTipoV = " and I.codTipoImovel = '".$_SESSION['imovel-busca']."'";
			}
		}else{
			$filtraTipoV = " and I.codTipoImovel = '".$tipoImovel."'";
			$_SESSION['imovel-busca'] = "";				
		}

		
		if(isset($_POST['rangeLeft'])){
			if($_POST['rangeLeft'] != ""){
				$_SESSION['rangeLeft'] = $_POST['rangeLeft'];
			}else{
				$_SESSION['rangeLeft'] = "";
			}
		}

		if(isset($_POST['rangeRight'])){
			if($_POST['rangeRight'] != ""){
				$_SESSION['rangeRight'] = $_POST['rangeRight'];
			}else{
				$_SESSION['rangeRight'] = "";
			}
		}

		if(isset($_POST['minBar'])){
			if($_POST['minBar'] != ""){
				$_SESSION['minBar'] = $_POST['minBar'];
			}else{
				$_SESSION['minBar'] = 0;
			}
		}
		
		if(isset($_POST['maxBar'])){
			if($_POST['maxBar'] != ""){
				$_SESSION['maxBar'] = $_POST['maxBar'];
			}else{
				$_SESSION['maxBar'] = 1000000;
			}
		}
				
		if(isset($_POST['max'])){
			if($_POST['max'] != ""){
				$_SESSION['max'] = $_POST['max'];
			}else{
				$_SESSION['max'] = "0,00";
			}
		}
		
		if(isset($_POST['min'])){
			if($_POST['min'] != ""){
				$_SESSION['min'] = $_POST['min'];
			}else{
				$_SESSION['min'] = "1.000.000,00";
			}
		}
		
		if($_SESSION['min'] != "" && $_SESSION['max'] != ""){
			
			$limpaMin = str_replace(".", "", $_SESSION['min']);
			$limpaMin = str_replace(",", ".", $limpaMin);
			$limpaMax = str_replace(".", "", $_SESSION['max']);
			$limpaMax = str_replace(",", ".", $limpaMax);
			
			if($limpaMax >= "1000000.00"){
				$filtraPreco = " and I.precoImovel >= '".$limpaMin."'";
			}else{
				$filtraPreco = " and I.precoImovel >= '".$limpaMin."' and I.precoImovel <= '".$limpaMax."'";						
			}
		}
				
		if($_SESSION['min'] == "" && $_SESSION['max'] == ""){
			$_SESSION['min'] = "0,00";
			$_SESSION['max'] = "1.000.000,00";
		}
		
		if($_SESSION['minBar'] == ""){
			$_SESSION['minBar'] = 0;
		}
		
		if($_SESSION['maxBar'] == ""){
			$_SESSION['maxBar'] = 1000000;
		}
							
		if(isset($_POST['ordenar'])){
			if($_POST['ordenar'] == ""){
				$_SESSION['ordenar'] = "";
			}else{
				$_SESSION['ordenar'] = $_POST['ordenar'];
			}
		}	
		
		if(isset($_SESSION['ordenar']) != ""){	
			if($_SESSION['ordenar'] == "PA"){	
				$ordenar = " I.precoImovel ASC,";
			}else{
				$ordenar = " I.precoImovel DESC,";				
			}	
		}
	}
	
	if(isset($_SESSION['busca']) != ""){
		$sqlRef = "SELECT I.codImovel FROM imoveis I inner join imoveisImagens II on I.codImovel = I.codImovel WHERE I.statusImovel = 'T' and I.codigoImovel = '".$_SESSION['busca']."' LIMIT 0,1";
		$resultRef = $conn->query($sqlRef);
		$dadosRef = $resultRef->fetch_assoc();
		
		if($dadosRef['codImovel'] != ""){
			$filtraImovel = " and I.codImovel = '".$dadosRef['codImovel']."'";
		}else
		if($_SESSION['numero'] >= 1){
			$filtraImovel = " and I.nomeImovel LIKE '%".$order[0]."%' and I.nomeImovel LIKE '%".$order[1]."%' and I.nomeImovel LIKE '%".$order[2]."%'";
		}else{
			$filtraImovel = "";		
		}		
	}		
?>
								<script type="text/javascript">
									function carregaBairro(codCidade){
										var $B = jQuery.noConflict();
										$B('#carrega-bairro').load("<?php echo $configUrl;?>carrega-bairros.php?codCidade="+codCidade+"");				
									}										
								</script>
								

								<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
								<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>


								<div id="filtro">
                                  <p class="titulo-filtro">Encontre agora!</p>
									<div id="bloco-filtro">
										<form action="<?php echo $configUrl;?>imoveis/" method="post">
											<div id="outros-filtros">
											<div id="alinha">
												<p id="titulo-filtro">Cidade</p>
													<p class="cidade campo-select">
													<select class="select-cidade" name="cidade-busca" onChange="carregaBairro(this.value);">
														<option value="">Selecione...</option>	
<?php
		$sql = "SELECT DISTINCT C.* FROM cidades C inner join imoveis I on C.codCidade = I.codCidade WHERE C.statusCidade = 'T' and I.statusImovel = 'T' ORDER BY C.nomeCidade ASC";
		$result = $conn->query($sql);
		while($dadosCidade = $result->fetch_assoc()){			
?>	
														<option value="<?php echo $dadosCidade['codCidade']; ?>" <?php echo $dadosCidade['codCidade'] == $_SESSION['cidade-busca'] ? '/SELECTED/' : ''; ?>><?php echo $dadosCidade['nomeCidade']; ?></option>
<?php																											
		}
?>	
													</select>										
												</p>
											</div>
											
											<div id="alinha">
												<p id="titulo-filtro">Tipo do Imóvel</p>
												<p class="imovel-busca campo-select">
													<select class="select" name="imovel-busca">
														<option value="">Selecione...</option>		
<?php
		$sql = "SELECT DISTINCT T.* FROM tipoImovel T inner join imoveis I on T.codTipoImovel = I.codTipoImovel WHERE T.statusTipoImovel = 'T' and I.statusImovel = 'T' ORDER BY T.nomeTipoImovel ASC";
		$result = $conn->query($sql);
		while($dadosTipoImovel = $result->fetch_assoc()){	
?>
													<option value="<?php echo $dadosTipoImovel['codTipoImovel'];?>" <?php echo $_SESSION['imovel-busca'] == $dadosTipoImovel['codTipoImovel'] ? '/SELECTED/' : '';?>><?php echo $dadosTipoImovel['nomeTipoImovel'];?></option>				
<?php
		}
?>										
													</select>										
												</p>
											</div>
											<div id="alinha">
												<p id="titulo-filtro">Bairro</p>
												<div id="carrega-bairro" style="float:left;">	
<?php
	if($_SESSION['cidade-busca'] != ""){
?>												
													<p class="bairro-busca campo-select">
														<select class="bairroSelect form-control campo" id="idSelect2" name="bairro[]" multiple="" style="width:240px; display: none;">
															<optgroup label="Selecione os bairros">
<?php
		$sql = "SELECT DISTINCT B.* FROM bairros B inner join imoveis I on B.codBairro = I.codBairro WHERE B.statusBairro = 'T' and I.statusImovel = 'T' and I.codCidade = ".$_SESSION['cidade-busca']." ORDER BY B.nomeBairro ASC";
		$result = $conn->query($sql);
		while($dadosBairro = $result->fetch_assoc()){	
			
			if($_SESSION['bairro-busca'] != ""){
				$optionArray = $_SESSION['bairro-busca'];

				for($i = 0; $i < count($optionArray); $i++){						
					if($dadosBairro['codBairro'] == $optionArray[$i]){
						$codBairro = $optionArray[$i];
						break;
					}
				}	
			}						
?>
															<option value="<?php echo $dadosBairro['codBairro'];?>" <?php echo $codBairro == $dadosBairro['codBairro'] ? '/SELECTED/' : '';?>><?php echo $dadosBairro['nomeBairro'];?></option>	
<?php
		}
?>
														</select>										
													</p>
<?php
	}else{
?>
													<p class="bairro-busca campo-select">
														<select class="select bairroSelect form-control campo" id="idSelect2" name="bairro[]" multiple="" style="width:240px; display: none;">
															<optgroup label="Selecione os bairros">
<?php
		$sql = "SELECT DISTINCT B.* FROM bairros B inner join imoveis I on B.codBairro = I.codBairro WHERE B.statusBairro = 'T' and I.statusImovel = 'T' ORDER BY B.nomeBairro ASC";
		$result = $conn->query($sql);
		while($dadosBairro = $result->fetch_assoc()){	

			if($_SESSION['bairro-busca'] != ""){
			
				$optionArray = $_SESSION['bairro-busca'];
						
				for($i = 0; $i < count($optionArray); $i++){						
					if($dadosBairro['codBairro'] == $optionArray[$i]){
						$codBairro = $optionArray[$i];
						break;
					}
				}
			
			}				
?>
															<option value="<?php echo $dadosBairro['codBairro'];?>" <?php echo $codBairro == $dadosBairro['codBairro'] ? '/SELECTED/' : '';?>><?php echo $dadosBairro['nomeBairro'];?></option>	
<?php
		}
?>
														</select>										
													</p>
<?php
	}
?>
												</div>	
											</div>	
											<script>
												var $rf = jQuery.noConflict();
													$rf(".bairroSelect").select2({
														placeholder: "Selecione...",
														multiple: true,
														tags: true, 
														allowClear: false,
														openOnEnter: true, 
														multiple: true, 						
													});			
											</script>
											<div>
												<p id="titulo-filtro">Código</p>
												<p class="codigo campo-select">
													<select class="selectCodigo form-control campo"  id="idSelectCodigo" name="codigo-busca" style="width:240px; display: none;">
														<option value="T"  placeholder = "Selecione..." >Todos</option>
<?php
	$sql = "SELECT DISTINCT I.codigoImovel FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel WHERE I.statusImovel = 'T' ORDER BY I.codImovel ASC";
	$result = $conn->query($sql);
	while($dadosCodImovel = $result->fetch_assoc()){			
?>
														<option value="<?php echo $dadosCodImovel['codigoImovel']; ?>" <?php echo $dadosCodImovel['codigoImovel'] == $codigo ? '/SELECTED/' : ''; ?>><?php echo $dadosCodImovel['codigoImovel']; ?></option>
<?php																											
	}
?>	
													</select>										
												</p>
											</div>
											<script>
												var $jj = jQuery.noConflict();
												$jj(document).ready(function () {
													$jj(".selectCodigo").select2({
														placeholder: "Selecione...",
														tags: false,
														allowClear: false, 
														multiple: false, 
													
													});
												});
											</script>
											
																																																																							
										</div>
										<p class="botao-buscar"><input type="submit" class="submit-buscar" value="Buscar Imóvel" name="buscar"/></p>
										</form>
									</div>
								</div>															
							</div>
						
