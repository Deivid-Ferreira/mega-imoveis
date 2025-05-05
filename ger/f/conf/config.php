<?php
	$configServer = "localhost";
	$configLogin = "root";
	$configSenha = "epitafio";
	$configBaseDados = "turimar-imobiliaria";	
	
	$conn = new mysqli($configServer, $configLogin, $configSenha, $configBaseDados);

	if ($conn->connect_error) {
		die("Erro de conexão: " . $conn->connect_error);
	}

	$configUrl = "http://192.168.1.200/turimar-imobiliaria/ger/";
	$configUrlGer = "http://192.168.1.200/turimar-imobiliaria/ger/";
	$configUrlSite = "http://192.168.1.200/turimar-imobiliaria/";

	$cookie = "turimarimobiliariaGer";
	$configLimite = 10;
	
	$urlUpload = "/turimar-imobiliaria/ger";

	$nomeEmpresa = "Ger | Mega Imóveis  [GER]";
	$nomeEmpresaMenor = "Mega Imóveis";
	$hostEmail = "srv214.prodns.com.br";
?>
	
