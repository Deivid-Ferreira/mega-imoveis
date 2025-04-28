<?php
	ob_start();
	session_start();
	include ('f/conf/config.php');
	include ('f/conf/functions.php');

	$url = explode("/", $aux.$_SERVER['REQUEST_URI']);

	$quebraUrl2 = explode("=", $url[2]);
	$quebraUrl3 = explode("=", $url[3]);
	$quebraUrl4 = explode("=", $url[4]);

	if($quebraUrl2[0] == "?fbclid" || $quebraUrl2[0] == "?gclid"){
		$url[2] = "";
	}
	if($quebraUrl3[0] == "?fbclid" || $quebraUrl3[0] == "?gclid" || $quebraUrl3[0] == "?numero"){
		$url[3] = "";
	}
	if($quebraUrl4[0] == "?fbclid" || $quebraUrl4[0] == "?gclid"){
		$url[4] = "";
	}
		
	if($url[4] != ""){
		$arquivoRetornar = $url[2].'/'.$url[3].'/'.$url[4].'/';
			if(is_numeric($url[4])){
				$sqlCidade = "SELECT * FROM cidades WHERE urlCidade = '".$url[3]."' ORDER BY codCidade ASC";
				$resultCidade = $conn->query($sqlCidade);
				$dadosCidade = $resultCidade->fetch_assoc();
				
				$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE urlTipoImovel = '".$url[3]."' ORDER BY codTipoImovel ASC";
				$resultTipoImovel = $conn->query($sqlTipoImovel);
				$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
				
				if($dadosTipoImovel['codTipoImovel'] != ""){
					$tipoImovel = $dadosTipoImovel['codTipoImovel'];
					$arquivo = $url[2].'/conteudo.php';
				}else			
				if($dadosCidade['codCidade'] != ""){
					$cidadeFiltra = $dadosCidade['codCidade'];
					$arquivo = $url[2].'/conteudo.php';
				}else
				if(file_exists($url[2].'/'.$url[3].'/conteudo.php')){
					$arquivo = $url[2].'/'.$url[3].'/conteudo.php';
				}else
					if(file_exists($url[2].'/'.$url[3].'/detalhes.php')){
						$arquivo = $url[2].'/'.$url[3].'/detalhes.php';
					}else
						if(file_exists($url[2].'/'.$url[3].'.php')){
							$arquivo = $url[2].'/'.$url[3].'.php';
						}else
							if(file_exists($url[2].'/conteudo.php')){
								$arquivo = $url[2].'/conteudo.php';
							}else{
								$arquivo = '404/conteudo.php';
							}
					
			}else		
				if(!is_numeric($url[4]) && $url[2] == "imoveis"){			
					$sqlCidade = "SELECT * FROM cidades WHERE urlCidade = '".$url[4]."' ORDER BY codCidade ASC";
					$resultCidade = $conn->query($sqlCidade);
					$dadosCidade = $resultCidade->fetch_assoc();
			
					$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE urlTipoImovel = '".$url[3]."' ORDER BY codTipoImovel ASC";
					$resultTipoImovel = $conn->query($sqlTipoImovel);
					$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
				
					if($dadosCidade['codCidade'] != "" && $dadosTipoImovel['codTipoImovel'] != ""){
						$cidadeFiltra = $dadosCidade['codCidade'];					
						$tipoImovel = $dadosTipoImovel['codTipoImovel'];
						$arquivo = $url[2].'/conteudo.php';
					}else{
						$sqlBairro = "SELECT * FROM bairros WHERE urlBairro = '".$url[4]."' ORDER BY codBairro ASC";
						$resultBairro = $conn->query($sqlBairro);
						$dadosBairro = $resultBairro->fetch_assoc();						

						$sqlCidade = "SELECT * FROM cidades WHERE urlCidade = '".$url[3]."' ORDER BY codCidade ASC";
						$resultCidade = $conn->query($sqlCidade);
						$dadosCidade = $resultCidade->fetch_assoc();

						if($dadosCidade['codCidade'] != "" && $dadosBairro['codBairro'] != ""){
							$cidadeFiltra = $dadosCidade['codCidade'];					
							$bairroFiltra = $dadosBairro['codBairro'];
							$arquivo = $url[2].'/conteudo.php';										
						}else{
							$arquivo = $url[2].'/conteudo.php';
						}
					}
				}else				
				if(file_exists($url[2].'/detalhes.php') && $url[2] == "imoveis"){
					$arquivo = $url[2].'/detalhes.php';
				}else
					if(file_exists($url[2].'/conteudo.php')){
						$arquivo = $url[2].'/conteudo.php';
					}else
						if(file_exists($url[2].'/'.$url[3].'/'.$url[4].'.php')){
							$arquivo = $url[2].'/'.$url[3].'/'.$url[4].'.php';
						}else{
							$arquivo = '404/conteudo.php';
						}
	}else
		if($url[3] != ""){
			$arquivoRetornar = $url[2].'/'.$url[3].'/';
			
			if(is_numeric($url[3])){
				if(file_exists($url[2].'/conteudo.php')){
					$arquivo = $url[2].'/conteudo.php';
				}else										
					if(file_exists($url[2].'/conteudo.php')){
						$arquivo = $url[2].'/conteudo.php';
					}
			}else	
				if(!is_numeric($url[3])){
					$sqlCidade = "SELECT * FROM cidades WHERE urlCidade = '".$url[3]."' ORDER BY codCidade ASC";
					$resultCidade = $conn->query($sqlCidade);
					$dadosCidade = $resultCidade->fetch_assoc();
					
					$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE urlTipoImovel = '".$url[3]."' ORDER BY codTipoImovel ASC";
					$resultTipoImovel = $conn->query($sqlTipoImovel);
					$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
					
					if($dadosTipoImovel['codTipoImovel'] != ""){
						$tipoImovel = $dadosTipoImovel['codTipoImovel'];
						$arquivo = $url[2].'/conteudo.php';
					}else			
					if($dadosCidade['codCidade'] != ""){
						$cidadeFiltra = $dadosCidade['codCidade'];
						$arquivo = $url[2].'/conteudo.php';
					}else
					if(file_exists($url[2].'/detalhes.php')){
						$arquivo = $url[2].'/detalhes.php';												
					}else
					if(file_exists($url[2].'/'.$url[3].'.php')){
						$arquivo = $url[2].'/'.$url[3].'.php';
					}										
				}else
				if($url[3] == "contato-whatsapp-enviado"){
					$arquivo = 'contato-whatsapp-enviado.php';
				}else															
				if(file_exists($url[2].'/'.$url[3].'/conteudo.php')){
					$arquivo = $url[2].'/'.$url[3].'/conteudo.php';																						
				}else
					if(file_exists($url[2].'/detalhes.php')){
						$arquivo = $url[2].'/detalhes.php';												
					}else								
						if(file_exists($url[2].'/'.$url[3].'.php')){
							$arquivo = $url[2].'/'.$url[3].'.php';
						}else
							if(file_exists($url[2].'/conteudo.php')){
								$arquivo = $url[2].'/conteudo.php';
							}else
								if($url[2] == "busca"){
									$arquivo = $url[2].'/conteudo.php';
								}else{
									$arquivo = '404/conteudo.php';
								}
				
		}else
			if($url[2] != ""){
				$arquivoRetornar = $url[2].'/';

				if($url[2] == "contato-whatsapp-enviado"){
					$arquivo = 'contato-whatsapp-enviado.php';
				}else								
				if(file_exists($url[2].'/conteudo.php')){
					$arquivo = $url[2].'/conteudo.php';
				}else
					if(file_exists($url[2].'.php')){
						$arquivo = $url[2].'.php';
					}else{
						$arquivo = '404/conteudo.php';
					}	
			}else
				if($url[2] == ""){
					$arquivoRetornar = "";
					
					$arquivo = 'capa/conteudo.php';
				}else{
					$arquivo = '404/conteudo.php';
				}	
				
	include ('f/conf/titles.php');			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
	<head>
		<title><?php echo $title;?></title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="author" content="SoftBest" />
		<meta name="description" content="<?php echo $description;?>" />
		<meta name="keywords" content="<?php echo $keywords;?>" />
		<meta name="language" content="<?php echo $linguagem;?>"/>
		<meta name="city" content="<?php echo $cidade;?>"/>
		<meta name="state" content="<?php echo $estado;?>"/>
		<meta name="country" content="<?php echo $pais;?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">		
		<meta name="theme-color" content="<?php echo $cor1;?>">
		<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $cor1;?>">
		<meta name="msapplication-navbutton-color" content="<?php echo $cor1;?>">	
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<?php
	if($arquivo != "404/conteudo.php"){
?>
		<meta name="robots" content="index,follow"/>	
<?php
	}else{
?>
		<meta name="robots" content="noindex">
<?php
	}
?>
		
		<link rel="canonical" href="<?php echo $dominio;?>/<?php echo $arquivoRetornar;?>" />	
		<link rel="shortcut icon" href="<?php echo $configUrl;?>f/i/icon.png" />
		<link rel="stylesheet" type="text/css" href="<?php echo $configUrl;?>f/c/estilo.css" media="all" title="Layout padrão" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Anek+Latin:wght@100..800&display=swap" rel="stylesheet">  
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
		<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $chaveSite;?>"></script>
		<script type="text/javascript" src="<?php echo $configUrl;?>f/j/js/jquery.js"></script>			
		<script type="text/javascript" src="<?php echo $configUrl;?>f/j/js/mascaras.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 
		
		
<?php
	if($configUrlSeg != ""){
?>		

		 <script>
		  var ua = navigator.userAgent.toLowerCase();

		  var uMobile = '';

		  //Lista de dispositivos que Ã© possÃ­vel acessar
		  uMobile = '';
		  uMobile += 'iphone;ipod;ipad;windows phone;android;iemobile 8';

		  //Separa os itens em arrays
		  v_uMobile = uMobile.split(';');

		  //verifica se vocÃª estÃ¡ acessando pelo celular
		  var boolMovel = false;
		  for (i=0;i<=v_uMobile.length;i++)
		  {
		  if (ua.indexOf(v_uMobile[i]) != -1)
		  {
		  boolMovel = true;
		  }
		  }

		  if (boolMovel == true)
		  {
		   location.href="<?php echo $configUrlSeg.$arquivoRetornar.$ancora;?>";	  			  
		  }else{
		  }
		 </script>		
					
<?php
	}
		
	if($url[2] != ""){
?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" />
		<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js"></script>
		<script>
		lightbox.option({
		  'resizeDuration': 200,
		  'wrapAround': true
		  })
		</script>
<?php	
	}
	
	if($url[2] == "imoveis" && $url[3] != ""){
?>		
		<link rel="stylesheet" href="<?php echo $configUrl;?>f/j/owlcarousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo $configUrl;?>f/j/owlcarousel/assets/owl.theme.default.min.css">
		<script src="<?php echo $configUrl;?>f/j/owlcarousel/jquery.min.js"></script>
		<script src="<?php echo $configUrl;?>f/j/owlcarousel/owl.carousel.js"></script>	
<?php
	}else
	if($url[2] == "" || $url[2] == "balneario-gaivota"){	
?>
		<link rel="stylesheet" href="<?php echo $configUrl;?>f/j/owlcarousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo $configUrl;?>f/j/owlcarousel/assets/owl.theme.default.min.css">
		<script src="<?php echo $configUrl;?>f/j/owlcarousel/jquery.min.js"></script>
		<script src="<?php echo $configUrl;?>f/j/owlcarousel/owl.carousel.js"></script>					
<?php
	}
	if($url[2] != "imoveis"){
?>
		<meta property="og:title" content="<?php echo $title;?>"/>
		<meta property="og:image" content="<?php echo $configUrl;?>f/i/comp.png"/>
		<meta property="og:description" content="<?php echo $description;?>"/>
		<meta property="og:url" content="<?php echo $configUrl.$arquivoRetornar;?>"/>
		<link href="<?php echo $configUrl;?>f/i/comp.png" rel="image_src" />
<?php
	}else			
	if($url[2] == "imoveis"){
		
		if($url[3] != "" && $tipoImovel == "" && $cidadeFiltra == ""){
			
			$quebraUrl = explode('-', $url[3]);			
						
			$sqlPrimeiroImovel = "SELECT P.*, I.* FROM imoveis P inner join imoveisImagens I on P.codImovel = I.codImovel WHERE P.statusImovel = 'T' and P.codImovel = '".$quebraUrl[0]."' LIMIT 0,1";
			$resultPrimeiroImovel = $conn->query($sqlPrimeiroImovel);
			$dadosPrimeiroImovel = $resultPrimeiroImovel->fetch_assoc();

			$sqlImagem = "SELECT * FROM imoveisImagens WHERE codImovel = '".$dadosPrimeiroImovel['codImovel']."' ORDER BY ordenacaoImovelImagem ASC, codImovelImagem";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();

?>
		<meta property="og:title" content="<?php echo $dadosPrimeiroImovel['nomeImovel'];?> | <?php echo $nomeEmpresa;?>"/>
		<meta property="og:description" content="<?php echo $description;?>"/>
		<meta property="og:image" content="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagem['codImovel'].'-'.$dadosImagem['codImovelImagem'].'-W.webp';?>" />				
		<meta property="og:url" content="<?php echo $configUrl.$arquivoRetornar;?>"/>
		<link href="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagem['codImovel'].'-'.$dadosImagem['codImovelImagem'].'-W.webp';?>" rel="image_src" />
<?php
		}
	
	}	
	
	$dominio = "http://".$_SERVER['SERVER_NAME']."/custodio-imoveis/";	
?>
		<style type="text/css">

			* { font-family: "Anek Latin", sans-serif;}

			.swiper {
			  width: 100%;
			  height: 100%;
			}

			.swiper-slide {
			  text-align: center;
			  font-size: 18px;
			  background: #fff;
			  display: flex;
			  justify-content: center;
			  align-items: center;
			}

			.swiper {
			  width: 100%;
			  height: -webkit-fill-available;
			  margin-left: auto;
			  margin-right: auto;
			}

			.swiper-slide {
			  background-size: cover;
			  background-position: center;
			}

			.mySwiper2 {
			  
			  width: 100%;
			}

			.mySwiper {
			  box-sizing: border-box;
			}

			.mySwiper .swiper-slide {
				cursor:pointer;
			  width: 100%;
			  height: 100%;
			  opacity: 0.5;
			}

			.mySwiper .swiper-slide-thumb-active {
			  opacity: 1;
			}

			.mySwiper .swiper-slide img {
			  display: block;
			  width: 100%;
			  height: 100%;
			  object-fit: cover;
			}

		</style>
<?php
	$tagsHead = str_replace("&#39;", "'", $tagsHead);
	echo html_entity_decode($tagsHead);
?>				  
	</head>
<?php
	if(isset($_COOKIE['politica'.$cookie]) == ""){
		$load = "onLoad='fadeInPolitica();'";
	}
?>	
	<body <?php echo $load;?>>
<?php
	$tagsBody = str_replace("&#39;", "'", $tagsBody);
	echo html_entity_decode($tagsBody);
?>






		<div id="tudo">
<?php
	if($url[2] == ""){
?>							
			<script type="text/javascript">
				var $gh2 = jQuery.noConflict();
				$gh2(document).ready(function(){
					$gh2(window).scroll(function(){
						if($gh2(this).scrollTop() >= 80){
							$gh2("#topo").removeClass("normal").addClass("scroll");
							document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/scroll.png";
						}else{
							$gh2("#topo").removeClass("scroll").addClass("normal");
							document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/normal.png";
						}
					});
				});

				$gh2(window).scroll(function(){
					if($gh2(this).scrollTop() >= 150){
						$gh2("#topo").removeClass("normal").addClass("scroll");
						document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/scroll.png";							
					}else{
						$gh2("#topo").removeClass("scroll").addClass("normal");
						document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/normal.png";
					}
				});					
			</script>
			<div id="topo" class="normal"> 
<?php
	}else{
?>				
			<script type="text/javascript">
				var $gh2 = jQuery.noConflict();
				$gh2(document).ready(function(){
					$gh2(window).scroll(function(){
						if($gh2(this).scrollTop() >= 50){
							$gh2("#topo").removeClass("interno").addClass("scroll");
							document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/scroll.png";								
						}else{
							$gh2("#topo").removeClass("scroll").addClass("interno");
							document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/normal.png";
						}
					});
				});

				$gh2(window).scroll(function(){
					if($gh2(this).scrollTop() >= 100){
						$gh2("#topo").removeClass("interno").addClass("scroll");
						document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/scroll.png";														
					}else{
						$gh2("#topo").removeClass("scroll").addClass("interno");
						document.getElementById("logo-img").src="<?php echo $configUrl;?>f/i/quebrado/normal.png";
					}
				});					
			</script>
		<div id="topo" class="interno">
		<?php
	}
?>
			<script type="text/javascript">
				var $th = jQuery.noConflict();
				var didScroll;
				var lastScrollTop = 0;
				var delta = 5;
				var navbarHeight = 150;

				$th(window).scroll(function(event) {
					didScroll = true;
				});

				setInterval(function() {
					if (didScroll) {
						hasScrolled();
						didScroll = false;
					}
				}, 250);

				function hasScrolled() {

					var st = $th(this).scrollTop();

					// Make sure they scroll more than delta
					if (Math.abs(lastScrollTop - st) <= delta)
						return;

					// If they scrolled down and are past the navbar, add class .nav-up.
					// This is necessary so you never see what is "behind" the navbar.
					if (st > lastScrollTop && st > navbarHeight) {
						// Scroll Down
						$th('.botao-whatsapp').css("right", "");
					} else {
						// Scroll Up
						if (st + $th(window).height() < $th(document).height()) {
							$th('.botao-whatsapp').css("right", "0px");
						}
					}
					lastScrollTop = st;
				}
			</script>
<?php 

	if($url[2] == "imoveis" && is_numeric($quebraUrl[0]) && !is_numeric($url[3])){
	
		$sqlImovel = "SELECT * FROM imoveis WHERE codImovel = ".$quebraUrl[0]." LIMIT 0,1";
		$resultImovel = $conn->query($sqlImovel);
		$dadosImovel = $resultImovel->fetch_assoc();

		$sqlCorretor = "SELECT * FROM usuarios WHERE codUsuario = ".$dadosImovel['codUsuario']." LIMIT 0,1";
		$resultCorretor = $conn->query($sqlCorretor);
		$dadosCorretor = $resultCorretor->fetch_assoc();
	
		$celularWhats = str_replace("(", "", $dadosCorretor['celularUsuario']); 
		$celularWhats = str_replace(")", "", $celularWhats); 
		$celularWhats = str_replace(" ", "", $celularWhats); 
		$celularWhats = str_replace("-", "", $celularWhats); 		

		$whatsAppCelular = $dadosCorretor['celularUsuario'];
		$whatsAppNumero = $celularWhats;
		$whatsAppMsg = "Olá, gostaria de mais informações sobre o *imóvel:* ".$dadosImovel['nomeImovel']." [Cod: ".$dadosImovel['codigoImovel']."], Link :".$configUrl.$arquivoRetornar."";
		$whatsAppRetornar = $configUrl.$arquivoRetornar;

	}else{

		$celularWhats = str_replace("(", "", $celular);
		$celularWhats = str_replace(")", "", $celularWhats);
		$celularWhats = str_replace(" ", "", $celularWhats);
		$celularWhats = str_replace("-", "", $celularWhats);
		$whatsAppCelular = $currentWhatsApp;
		$whatsAppNumero = $currentWhatsAppNumero;

		$whatsAppMsg = "Olá, vim através do site e gostaria de conversar com um corretor!";
		$whatsAppRetornar = $configUrl.$arquivoRetornar;
	}	
?>

	<p class="botao-whatsapp"><a class="one" target="_blank" title="Converse com a gente através do WhatsApp!"  onClick="abrirAcesso();">Entre em contato!<br /><?php echo $celular; ?></a></p>
<?php 
	include('capa/topo.php');
?>
			</div>	
			<div id="conteudo">
<?php 
	include($arquivo);
?>
			</div>
			<div id="rodape">
<?php 
	include('capa/rodape.php');
?>
			</div>	
			<script type="text/javascript" src="<?php echo $configUrl;?>f/j/js/wow.min.js"></script>			
			<script>
				new WOW().init();
			</script>			
		</div>
	</body>

	

</html>
<?php
	$conn->close();
?>
