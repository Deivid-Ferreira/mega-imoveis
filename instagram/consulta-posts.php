<?php
	include('../f/conf/config.php');
		
	$token = file_get_contents("token.txt");
	$url = "https://graph.instagram.com/me/media?access_token=".trim($token)."&fields=id,timestamp,media_url,thumbnail_url,media_type,caption,permalink";
	echo $url;
	
	if($token != ""){
			
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		$result = curl_exec($ch);
		$dados = json_decode($result);
				
		curl_close($ch);
		
		$posts = $dados->data;

		$confere = "";
		foreach($posts as $e){	
			$id = $e->id;
			if($id != ""){
				$confere = "ok";
			}
			break;
		}
		
		if($confere == "ok"){
											
			$contGeral = 0;
			$cont = 0;
			$totalNovas = 0;
			$e = "";
			
			$confereErro = "nao";
			
			foreach($posts as $e){
								
				$id = $e->id;
				$caption = $e->caption;
				
				$contGeral++;
				
				if($contGeral <= 21){
											
					$sqlInstagrams = "SELECT * FROM instagram WHERE id = '".$id."' LIMIT 0,1";
					$resultInstagrams = $conn->query($sqlInstagrams);
					$dadosInstagrams = $resultInstagrams->fetch_assoc();
					
					if($dadosInstagrams['id'] == ""){

						$cont++;

						$timestamp = $e->timestamp;
						$media_url = $e->media_url;
						$thumbnail_url = $e->thumbnail_url;
						$media_type = $e->media_type;
						$caption = $e->caption;
						$permalink = $e->permalink;

						$quebraTime = str_replace("+0000", "", $timestamp);
						$quebraTime = explode("T", $quebraTime);
																
						$sqlInserePosts = "INSERT INTO instagram VALUES(0, '".$id."', '".$quebraTime[0]." ".$quebraTime[1]."', '".$media_url."', '".$thumbnail_url."', '".$media_type."', '".$caption."', '".$permalink."', 'T')";
						$resultInserePosts = $conn->query($sqlInserePosts);
						
						
						if($resultInserePosts == 1){

							if($media_type == "VIDEO"){							
								$urlImagem = $thumbnail_url;
							}else{
								$urlImagem = $media_url;
							}
							
							$chI = curl_init();
							curl_setopt($chI, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($chI, CURLOPT_URL, $urlImagem);

							$result = curl_exec($chI);
							curl_close($chI);

							file_put_contents("../ger/f/instagram/".$id.".jpg", $result);					
							
						}else{
							$confereErro = "sim";						
						}
					
					}	
				}					
			}
			
			if($confereErro == "nao"){
				echo "Posts salvos com sucesso";				
			}else{
				echo "Erro ao salvar posts";						
			}
		
		}else{
			echo "Erro Consulta";
		}
		
	}else{
		echo "Token Inexistente";
	}
?>
