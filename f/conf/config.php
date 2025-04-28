<?php
	$configUrl = "http://192.168.1.200/mega-imoveis/";
	$configUrlSeg = "http://192.168.1.200/mega-imoveis_m/";
	$configUrlGer = "http://192.168.1.200/mega-imoveis/ger/";

	$configServer = "localhost";
	$configLogin = "root";
	$configSenha = "epitafio";
	$configBaseDados = "mega-imoveis";

	$conn = new mysqli($configServer, $configLogin, $configSenha, $configBaseDados);
	$conn->set_charset("utf8mb4");

	if ($conn->connect_error) {
		die("Erro de conexão: " . $conn->connect_error);
	}

	$sqlSession = "SET SESSION sql_mode = ''";
	$resultSession = $conn->query($sqlSession);
	
	$nomeEmpresa = "Mega Imóveis - Imobiliária em Balneário Gaivota / SC";
	$nomeEmpresaMenor = "Mega Imóveis";
	
	$cookie = "megaImoveisSite";
	
	$aux = "";
	
	$politicaNome = "Mega Imóveis";
	$politicaNomeA = "a Mega Imóveis";

	$linguagem = "Portuguese";
	$pais = "Brazil";
	$estado = "Santa Catarina";
	$cidade = "Balneário Gaivota";

	$sqlInformacao = "SELECT * FROM informacoes WHERE codInformacao = 1";
	$resultInformacao = $conn->query($sqlInformacao);
	$dadosInformacao = $resultInformacao->fetch_assoc();
	
	$celularWhats = $dadosInformacao['celularInformacao'];
	$endereco = $dadosInformacao['enderecoInformacao'];
	$atendimento = $dadosInformacao['atendimentoInformacao'];
	$rota = $dadosInformacao['rotaInformacao'];
	$telefone = $dadosInformacao['telefoneInformacao'];
	$celular = $dadosInformacao['celularInformacao'];
	$email = $dadosInformacao['emailInformacao'];	
	$creci = $dadosInformacao['creciInformacao'];	
	$facebook = $dadosInformacao['facebookInformacao'];
	$instagram = $dadosInformacao['instagramInformacao'];	
	$mapa = $dadosInformacao['mapaInformacao'];
	$tagsHead = $dadosInformacao['tagsHeadInformacao'];
	$tagsBody = $dadosInformacao['tagsBodyInformacao'];
	$tagsConversao = $dadosInformacao['tagsConversaoInformacao'];
	
	$keywordsConfig = "";

	$hostEmail = "email-ssl.com.br";
	$dominio = "https://imoveisbalneariogaivota.com.br";
	$dominioSem = "imoveisbalneariogaivota.com.br";
	$chaveSite = "6Lcf_40qAAAAABj2Mh24GvTcutl8b_299JrKrsOU";
	$chaveSecreta = "6Lcf_40qAAAAAIDMDoww_YgGHq88QWP0T9op_TVy";
	
	$cor1 = "#01CCD2";
	$cor2 = "#01CCD2";
?>
	
