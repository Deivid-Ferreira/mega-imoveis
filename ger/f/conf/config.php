<?php
	$configServer = "localhost";
	$configLogin = "root";
	$configSenha = "epitafio";
	$configBaseDados = "mega-imoveis";	
	
	$conn = new mysqli($configServer, $configLogin, $configSenha, $configBaseDados);

	if ($conn->connect_error) {
		die("Erro de conexão: " . $conn->connect_error);
	}

	$configUrl = "http://192.168.1.200/mega-imoveis/ger/";
	$configUrlGer = "http://192.168.1.200/mega-imoveis/ger/";
	$configUrlSite = "http://192.168.1.200/mega-imoveis/";

	$cookie = "megaImoveisGer";
	$configLimite = 10;
	
	$urlUpload = "/mega-imoveis/ger";

	$nomeEmpresa = "Ger | Mega Imóveis  [GER]";
	$nomeEmpresaMenor = "Mega Imóveis";
	$hostEmail = "srv214.prodns.com.br";
?>
	
