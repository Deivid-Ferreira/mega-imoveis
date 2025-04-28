<?php
	$sqlBalnearioGaivota = "SELECT * FROM balnearioGaivota LIMIT 0,1";
	$resultBalnearioGaivota = $conn->query($sqlBalnearioGaivota);
	$dadosBalnearioGaivota = $resultBalnearioGaivota->fetch_assoc();
?>	
					<div id="conteudo-interno" style="width:100%;">
						<div id="bloco-titulo">
							<p class="titulo balneario-gaivota">BALNEÁRIO GAIVOTA</p>
						</div>	
						<div id="conteudo-balnearioGaivota"  >
							<div class="descricao"><?php echo $dadosBalnearioGaivota['descricaoBalnearioGaivota'];?></div>
							
<?php
	$sqlImagemConta = "SELECT count(codBalnearioGaivota) total FROM balnearioGaivotaImagens WHERE codBalnearioGaivota = ".$dadosBalnearioGaivota['codBalnearioGaivota']." ";
	$resultImagemConta = $conn->query($sqlImagemConta);
	$dadosImagemConta = $resultImagemConta->fetch_assoc();
	if($dadosImagemConta['total'] >= 2){
?>
							<div id="mais-imagens">
<?php
		$cont = 0;
		
		$sqlImagem = "SELECT * FROM balnearioGaivotaImagens WHERE codBalnearioGaivota = ".$dadosBalnearioGaivota['codBalnearioGaivota']." ORDER BY capaBalnearioGaivotaImagem ASC, codBalnearioGaivotaImagem ASC";
		$resultImagem = $conn->query($sqlImagem);
		while($dadosImagems = $resultImagem->fetch_assoc()){
			
			$cont++;
			
			if($cont == 4){
				$cont = 0;
				$margin = "margin-right:0px;";
			}else{
				$margin = "";
			}
?>								
								<p class="imagem wow animate__animated animate__fadeInUp" style="<?php echo $margin;?>"><a rel="lightbox[roadtrip]" href="<?php echo $configUrlGer.'f/balnearioGaivota/'.$dadosImagems['codBalnearioGaivota'].'-'.$dadosImagems['codBalnearioGaivotaImagem'].'-O.'.$dadosImagems['extBalnearioGaivotaImagem'];?>" style="width:100%; height:300px; display:block; background:transparent url('<?php echo $configUrlGer.'f/balnearioGaivota/'.$dadosImagems['codBalnearioGaivota'].'-'.$dadosImagems['codBalnearioGaivotaImagem'].'-O.'.$dadosImagems['extBalnearioGaivotaImagem'];?>') center center no-repeat; background-size:cover, 100%;"></a></p>
<?php
		}
?>


								<br class="clear"/>
							</div>
<?php
	}
?>
						</div>
					</div>
