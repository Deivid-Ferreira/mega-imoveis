<?php
	$token = file_get_contents("token.txt");
	$url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=".trim($token);
	
	if($token != ""){

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		$result = curl_exec($ch);
		$dados = json_decode($result);
		curl_close($ch);

		$novoToken = $dados->access_token;
			
		$arquivo = "token.txt";

		if (is_writable($arquivo)) {
			$manipular = fopen("$arquivo", 'w+');

			if (!$manipular) {
				echo "Erro<br /><br />Não foi possível abrir o arquivo.";
			}else{
				if(!fwrite($manipular, $novoToken)) {
				echo "Erro<br /><br />Não foi possível gravar as informações no arquivo.";
				} else {
				echo "O texto foi gravado com sucesso!";
				} // if !fwrite

				fclose($manipular);
			} // if !$manipular
		}else{
			echo "O $arquivo não tem permissões de leitura e/ou escrita.";
		}
		
	} 	
?>
