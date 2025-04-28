<?php
    header("Content-Type: application/xml; charset=UTF-8");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
	
	include('f/conf/config.php');
 
	$hoje = date('Y-m-d');
?> 
	<urlset
		xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
		xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
		xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9
		https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
		<url>
			<loc>https://custodioimoveissc.com.br</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>
		<url>
			<loc>https://custodioimoveissc.com.br/a-imobiliaria/</loc>
			<lastmod><?php echo $hoje;?></lastmod>				
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>	
		<url>
			<loc>https://custodioimoveissc.com.br/imoveis/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://custodioimoveissc.com.br/novidades/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>			

		<url>
			<loc>https://custodioimoveissc.com.br/balneario-gaivota/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>

<?php
	$sqlImovel = "SELECT codImovel, urlImovel FROM imoveis WHERE statusImovel = 'T' ORDER BY codImovel DESC";
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){
			
		echo "<url>
				<loc>https://custodioimoveissc.com.br/imoveis/".$dadosImovel['codImovel']."-".$dadosImovel['urlImovel']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
	
	$sqlImovel = "SELECT I.codCidade FROM imoveis I WHERE I.statusImovel = 'T'  GROUP BY I.codCidade ORDER BY I.codImovel DESC";
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){
		
		$sqlCidade = "SELECT * FROM cidades WHERE codCidade = '".$dadosImovel['codCidade']."' LIMIT 0,1";
		$resultCidade = $conn->query($sqlCidade);
		$dadosCidade = $resultCidade->fetch_assoc();
			
		echo "<url>
				<loc>https://custodioimoveissc.com.br/imoveis/".$dadosCidade['urlCidade']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
	
	$sqlImovel = "SELECT DISTINCT I.codBairro, I.codCidade FROM imoveis I WHERE statusImovel = 'T' ORDER BY codImovel DESC";
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){
		
		$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$dadosImovel['codCidade']." LIMIT 0,1";
		$resultCidade = $conn->query($sqlCidade);
		$dadosCidade = $resultCidade->fetch_assoc();
		
		$sqlBairro = "SELECT * FROM bairros WHERE codBairro = ".$dadosImovel['codBairro']." LIMIT 0,1";
		$resultBairro = $conn->query($sqlBairro);
		$dadosBairro = $resultBairro->fetch_assoc();
			
		echo "<url>
				<loc>https://custodioimoveissc.com.br/imoveis/".$dadosCidade['urlCidade']."/".$dadosBairro['urlBairro']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
	
	$sqlImovel = "SELECT DISTINCT I.codTipoImovel FROM imoveis I WHERE statusImovel = 'T' ORDER BY codImovel DESC";
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){
		
		$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = ".$dadosImovel['codTipoImovel']." LIMIT 0,1";
		$resultTipoImovel = $conn->query($sqlTipoImovel);
		$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
			
		echo "<url>
				<loc>https://custodioimoveissc.com.br/imoveis/".$dadosTipoImovel['urlTipoImovel']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
	
	$sqlImovel = "SELECT DISTINCT I.codCidade, I.codTipoImovel FROM imoveis I WHERE statusImovel = 'T' ORDER BY codImovel DESC";
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){

		$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$dadosImovel['codCidade']." LIMIT 0,1";
		$resultCidade = $conn->query($sqlCidade);
		$dadosCidade = $resultCidade->fetch_assoc();
				
		$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = ".$dadosImovel['codTipoImovel']." LIMIT 0,1";
		$resultTipoImovel = $conn->query($sqlTipoImovel);
		$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
			
		echo "<url>
				<loc>https://custodioimoveissc.com.br/imoveis/".$dadosTipoImovel['urlTipoImovel']."/".$dadosCidade['urlCidade']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
	
	$sqlNovidade = "SELECT * FROM novidade WHERE statusNovidade = 'T'  ORDER BY codNovidade DESC ";
	$resultNovidade = $conn->query($sqlNovidade);
	while($dadosNovidade = $resultNovidade->fetch_assoc()){

		echo "<url>
				<loc>https://custodioimoveissc.com.br/novidades/".$dadosNovidade['codNovidade']."-".$dadosNovidade['urlNovidade']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";

	}


?>			
	
	</urlset>
