<?php
	if($url[2] == ""){
		$sqlHistorico = "SELECT * FROM quemSomos LIMIT 0,1";
		$resultHistorico = $conn->query($sqlHistorico);
		$dadosHistorico = $resultHistorico->fetch_assoc();
	
		$title = $nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoQuemSomos']);
	}else
	if($url[2] == "a-imobiliaria"){
		$sqlHistorico = "SELECT * FROM quemSomos LIMIT 0,1";
		$resultHistorico = $conn->query($sqlHistorico);
		$dadosHistorico = $resultHistorico->fetch_assoc();
		
		$title = "A Imobiliária | ".$nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoQuemSomos']);
	}else
	if($url[2] == "imoveis"){
		$title = "Imóveis | ".$nomeEmpresa;
		$description = "";		
		
		if($url[3] != "" && !is_numeric($url[3]) && $tipoImovel == "" && $cidadeFiltra == ""){

			$quebraUrl = explode('-', $url[3]);

			$sqlImovel = "SELECT * FROM imoveis WHERE codImovel = ".$quebraUrl[0]." LIMIT 0,1";
			$resultImovel = $conn->query($sqlImovel);
			$dadosImovel = $resultImovel->fetch_assoc();
			
			$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$dadosImovel['codCidade']." LIMIT 0,1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();
			
			$sqlBairro = "SELECT * FROM bairros WHERE codBairro = ".$dadosImovel['codBairro']." LIMIT 0,1";
			$resultBairro = $conn->query($sqlBairro);
			$dadosBairro = $resultBairro->fetch_assoc();

			$text = strip_tags($dadosImovel['descricaoImovel']);		

			$title = $dadosImovel['nomeImovel']." em ".$dadosCidade['nomeCidade']." - ".$dadosBairro['nomeBairro']." - Imóveis | ".$nomeEmpresa;
			$description = $text;
		}else
		if($url[4] != "" && $tipoImovel != "" && $cidadeFiltra != ""){
			$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = ".$tipoImovel." LIMIT 0,1";
			$resultTipoImovel = $conn->query($sqlTipoImovel);
			$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
			
			$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$cidadeFiltra." LIMIT 0,1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();			

			$title = $dadosTipoImovel['nomeTipoImovel']." em ".$dadosCidade['nomeCidade']." - Imóveis | ".$nomeEmpresa;
		}else
		if($url[4] != "" && $cidadeFiltra != "" && $bairroFiltra != ""){			
			$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$cidadeFiltra." LIMIT 0,1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();			

			$sqlBairro = "SELECT * FROM bairros WHERE codBairro = '".$bairroFiltra."' ORDER BY codBairro ASC";
			$resultBairro = $conn->query($sqlBairro);
			$dadosBairro = $resultBairro->fetch_assoc();	

			$title = "Imóveis no bairro ".$dadosBairro['nomeBairro']." em ".$dadosCidade['nomeCidade']."/".$dadosCidade['estadoCidade']." - Imóveis | ".$nomeEmpresa;
		}else
		if($url[3] != "" && $tipoImovel != ""){
			$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = ".$tipoImovel." LIMIT 0,1";
			$resultTipoImovel = $conn->query($sqlTipoImovel);
			$dadosTipoImovel = $resultTipoImovel->fetch_assoc();		

			$title = $dadosTipoImovel['nomeTipoImovel']." - Imóveis | ".$nomeEmpresa;
		}else
		if($url[3] != "" && $cidadeFiltra != ""){
			$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$cidadeFiltra." LIMIT 0,1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();	

			$title = "Imóveis em ".$dadosCidade['nomeCidade']."/".$dadosCidade['estadoCidade']." - Imóveis | ".$nomeEmpresa;
		}
	
	}else
	if($url[2] == "novidades"){
		$title = "Novidades | ".$nomeEmpresa;
		if($url[3] != ""){

			$quebraUrl = explode('-', $url[3]);

			$sqlBlog = "SELECT * FROM blog WHERE codBlog = ".$quebraUrl[0]." LIMIT 0,1";
			$resultBlog = $conn->query($sqlBlog);
			$dadosBlog = $resultBlog->fetch_assoc();
			$title =  ''.$dadosBlog['nomeBlog']. " - Novidades | ".$nomeEmpresa;
		}
	}else
	if($url[2] == "contato"){ 
		$title = "Contato | ".$nomeEmpresa;
		$description = "Para entrar em contato com o ".$nomeEmpresaMenor.", basta você preencher todos os campos, enviar e em breve entramos em contato com você.";
		
		if($url[3] != ""){
			$title = "Contato enviado com sucessso - Contato | ".$nomeEmpresa;			
		}
	}else
	if($url[2] == "politica-de-privacidade"){
		$title = "Política de Privacidade | ".$nomeEmpresa;
	}else
	if($url[2] == "sendEmail"){
		$title = "Contato WhatsApp Enviado | ".$nomeEmpresa;
	}else
	if($url[2] == "depoimentos"){
		$title = "Depoimentos | ".$nomeEmpresa;
	}else
	if($url[2] == "contato-whatsapp-enviado"){
		$title = "Contato WhatsApp Enviado | ".$nomeEmpresa;
		$description = "";
	}else{
		$title = "Página não encontrada | ".$nomeEmpresa;
		$description = "Utilize os menu acima para navegar pelo site";
	}if($url[2] == "balneario-gaivota"){
		$title = "Balneário Gaivota | ".$nomeEmpresa;
		$description = "Localizada no extremo sul de Santa Catarina, Balneário Gaivota é atualmente uma das cidades que mais se destaca em seu desenvolvimento estrutural";
		
		if($url[3] != ""){
			$title = "Contato enviado com sucessso - Contato | ".$nomeEmpresa;			
		}
	}
	
	$keywords = $keywordsConfig; 
?>
