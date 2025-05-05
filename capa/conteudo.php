

<div id="repete-conteudo">
			<div id="repete-banners">
<?php
    include 'capa/banner-capa.php';
?>
            </div>
			<div id="repete-quemSomos">
				<div id="mostra-quemSomos">
					<div id="esq">
<?php
		$sqlQuemSomos	= "SELECT * FROM quemSomos WHERE codQuemSomos = 1 LIMIT 0,1";
		$resultQuemSomos = $conn->query($sqlQuemSomos);
		$dadosQuemSomos  = $resultQuemSomos->fetch_assoc();	
		$sqlImagem	= "SELECT * FROM quemSomosImagens WHERE codQuemSomos = ".$dadosQuemSomos['codQuemSomos']." AND capaQuemSomosImagem = 'T' ORDER BY capaQuemSomosImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem  = $resultImagem->fetch_assoc();
?>
						<div id="fundo">
							<div id="bloco-titulo">
								<p class="titulo">A PRAIA TURIMAR</p>
								<div id="linha"></div>
							</div>
							<div id="descricao"><?php echo $dadosQuemSomos['descricaoCQuemSomos'];?></div>
						</div>
					</div>
					<div id="dir">
						<div id="mostra-imagem">
							<div id="imagem" style="background: url('<?php echo $configUrlGer.'f/quemSomos/'.$dadosImagem['codQuemSomos'] .'-'.$dadosImagem['codQuemSomosImagem'].'-O.'.$dadosImagem['extQuemSomosImagem'];?>') center center no-repeat; background-size: cover;"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="repete-porque">
				<div id="bloco-titulo">
					<p class="titulo">O SEU TERRENO NA PRAIA</p>
				</div>
				<div id="conteudo-porque">
					<div id="bloco-porque">
						<div id="esq">
							<p id="p1"><span>Descubra</span> o melhor da vida em Balneário <br> Gaivota, onde a natureza exuberante se encontra com <br> a sofisticação urbana.</p><br><br>
							<p id="p2">Adquira um terreno neste paraíso e construa a casa <br> dos seus sonhos. Com praias deslumbrantes, parques bem <br> cuidados e uma comunidade acolhedora.</p><br><br>
							<p id="p3">Balneário Gaivota é o lugar ideal para investir e viver intensamente.</p>
						</div>
						<div id="dir">
<?php 
		$contador = 0;
	 	$sqlPorque	= "SELECT * FROM porque WHERE statusPorque = 'T' LIMIT 0,6";
		$resultPorque = $conn->query($sqlPorque);
		while($dadosPorque = $resultPorque->fetch_assoc()){
		 	$sqlImagem	= "SELECT * FROM porqueImagens WHERE codPorque = ".$dadosPorque['codPorque']." LIMIT 0,1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem  = $resultImagem->fetch_assoc();
			$contador++;
			if( $contador >=  4){
				$margin = 'margin-bottom: 0px;';
			}else{
				$margin = '';
			}

?>
							<div id="fundo" style="<?php echo $margin;?>">
								<p class="titulo" style="background: url('<?php echo $configUrlGer.'f/porque/'.$dadosImagem['codPorque'] .'-'.$dadosImagem['codPorqueImagem'].'-O.'.$dadosImagem['extPorqueImagem'];?>') center 5px no-repeat; background-size: 60px;" ><?php echo $dadosPorque['nomePorque']; ?></p>
							</div>
<?php 
		}
?>
						</div>
					</div>
					<div id="faixa">
						<div id="mostra-contatos">
							<a  href="mailto:<?php echo $email ?>" ><p id="email" >SOLICITE UM CONTATO</p></a>
							<p id="whats" onclick="abrirAcesso();">CHAME-NOS NO WHATSAPP</p>
						</div>
					</div>
				</div>
			</div>
<?php
	$sqlDepoimento = "SELECT count(codDepoimento) total FROM depoimentos WHERE statusDepoimento = 'T'";
	$resultDepoimento = $conn->query($sqlDepoimento);
	$dadosDepoimento = $resultDepoimento->fetch_assoc();

	if ($dadosDepoimento['total'] >= 1 && $url[2] != "depoimentos") {
?>
			<div id="repete-depoimentos">
				<div id="conteudo-depoimentos">
					<div id="bloco-titulo">
						<p class="titulo">DEPOIMENTOS</p>
					</div>
					<div id="mostra-depoimentos" class="wow animate__animated animate__fadeInLeft">
						<div class="owl-carrossel">
							<div class="row">
								<div class="large-12 columns">
									<div class="loop owl-carousel depoimentosCarrossel owl-loaded owl-drag">
<?php
	$cont2 = 0;
	$sqlDepoimento = "SELECT * FROM depoimentos WHERE statusDepoimento = 'T' ORDER BY codOrdenacaoDepoimento ASC";
	$resultDepoimento = $conn->query($sqlDepoimento);
	while ($dadosDepoimento = $resultDepoimento->fetch_assoc()) {

		$cont2++;

		$sqlImagem = "SELECT * FROM depoimentosImagens WHERE codDepoimento = " . $dadosDepoimento['codDepoimento'] . " ORDER BY codDepoimentoImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();

		if($dadosImagem['codDepoimento'] != "" &&  $dadosImagem['codDepoimento'] == $dadosImagem['codDepoimento'] )	{

			$imagem = $configUrlGer . 'f/depoimentos/' . $dadosImagem['codDepoimento'] . '-' . $dadosImagem['codDepoimentoImagem'] . '-O.' . $dadosImagem['extDepoimentoImagem'];	
		}else{		
			$imagem = $configUrl . 'f/i/quebrado/defalt.png';	
		}	
?> 									
											<li class="carrosel-depoimento">
												<a title="<?php echo $dadosDepoimento['nomeDepoimento']; ?>" href="<?php echo $configUrl; ?>depoimentos/">
													<div id="fundo">
														<div id="pt-superior">
															<div id="imagem" style="background:transparent url('<?php echo $imagem?>') center center no-repeat; background-size:auto 100%;"></div>
															<div id="mostra-nome">
																<p id="nome"><?php echo $dadosDepoimento['nomeDepoimento'];?></p>
																<p id="cidade"><?php echo $dadosDepoimento['cidadeDepoimento'];?></p>
																<img src="<?php echo $configUrl.'f/i/quebrado/estrelas.svg'; ?>"  width="70px" alt="">
															</div>
														</div>
														<div id="pt-inferior">
															<div id="depoimentos"><?php echo $dadosDepoimento['descricaoDepoimento'];?></div>
														</div>
													</div>
												</a>
											</li>
<?php
	}
?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script>
						var $rfgs = jQuery.noConflict();
						$rfgs(document).ready(function() {
							var owlProdutos = $rfgs('.depoimentosCarrossel');
							owlProdutos.owlCarousel({
								autoplay: false,
								autoplayTimeout: 20000,
								smartSpeed: 1000,
								fluidSpeed: 10000,
								items: 2,
								loop: true,
								autoWidth: false,
								margin: 100,
								nav: true,
								dots: true,
								dotsEach: true
							});
						});
					</script>
				</div>
			</div>
<?php
	}
?>
			<div id="repete-balnearioGaivota">
				<div id="conteudo-balnearioGaivota">
					<div id="bloco-titulo">
						<p class="titulo">CONHEÇA BALNEÁRIO GAIVOTA</p>
					</div>
					<div id="mostra-balnearioGaivota" class="wow animate__animated animate__fadeInLeft">
						<div class="owl-carrossel">
							<div class="row">
								<div class="large-12 columns">
									<div class="loop owl-carousel balnearioGaivotaCarrossel owl-loaded owl-drag">
<?php
	$cont2 = 0;
	$sqlBalnearioGaivota = "SELECT * FROM balnearioGaivota";
	$resultBalnearioGaivota = $conn->query($sqlBalnearioGaivota);
	$dadosBalnearioGaivota = $resultBalnearioGaivota->fetch_assoc();

		$cont2++;

		$sqlImagem = "SELECT * FROM balnearioGaivotaImagens WHERE codBalnearioGaivota = " . $dadosBalnearioGaivota['codBalnearioGaivota'] . " ORDER BY codBalnearioGaivotaImagem ASC";
		$resultImagem = $conn->query($sqlImagem);
		while($dadosImagem = $resultImagem->fetch_assoc()){
?>
												<a title="<?php echo $dadosBalnearioGaivota['nomeBalnearioGaivota']; ?>" href="<?php echo $configUrl; ?>balnearioGaivota/">
													<div id="img" style="background: url('<?php echo $configUrlGer . 'f/balnearioGaivota/' . $dadosImagem['codBalnearioGaivota'] . '-' . $dadosImagem['codBalnearioGaivotaImagem'] . '-O.' . $dadosImagem['extBalnearioGaivotaImagem']; ?>') center center no-repeat; background-size:cover; width:100%; height:300px"></div>
												</a>
<?php
	}
?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script>
						var $rfgs = jQuery.noConflict();
						$rfgs(document).ready(function() {
							var owlProdutos = $rfgs('.balnearioGaivotaCarrossel');
							owlProdutos.owlCarousel({
								autoplay: false,
								autoplayTimeout: 20000,
								smartSpeed: 1000,
								fluidSpeed: 10000,
								items: 4,
								loop: true,
								autoWidth: false,
								margin:10,
								nav: true,
								dots: true,
								dotsEach: true
							});
						});
					</script>
				</div>
			</div>

        </div>
