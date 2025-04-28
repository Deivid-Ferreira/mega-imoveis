<?php
	include('../../f/conf/config.php');

	$pastaDestino = $_SERVER['DOCUMENT_ROOT'].$urlUpload.'/f/balnearioGaivota/';
	
	$codBalnearioGaivota = $_POST['codBalnearioGaivota'];

	function saveWebPImage($original_image, $new_image_path, $quality = 100) {
		if (imagewebp($original_image, $new_image_path, $quality)) {
			return true;
		} else {
			return false;
		}
	}
									
	foreach ($_FILES['arquivo']['tmp_name'] as $index => $tmp_name) {

		if (!is_uploaded_file($tmp_name)) {
			continue;
		}
		  
		$file_name = $_FILES['arquivo']['name'][$index];
		$file_type = $_FILES['arquivo']['type'][$index];
		$file_size = $_FILES['arquivo']['size'][$index];

		if (strpos($file_type, 'image') === false) {
			continue;
		}

		$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
  
		if(in_array($ext, ['jpg', 'jpeg', 'png', 'svg'])){	
			
			$file_name = uniqid().'.'.$ext;							
				
			$sqlBalnearioGaivota = "INSERT INTO balnearioGaivotaImagens VALUES(0, ".$codBalnearioGaivota.", 'F', '".$ext."')";
			$resultBalnearioGaivota = $conn->query($sqlBalnearioGaivota);	

			$sqlPegaBalnearioGaivota = "SELECT codBalnearioGaivotaImagem FROM balnearioGaivotaImagens ORDER BY codBalnearioGaivotaImagem DESC LIMIT 0,1";
			$resultPegaBalnearioGaivota = $conn->query($sqlPegaBalnearioGaivota);
			$dadosPegaBalnearioGaivota = $resultPegaBalnearioGaivota->fetch_assoc();
						
			$codBalnearioGaivotaImagem = $dadosPegaBalnearioGaivota['codBalnearioGaivotaImagem'];
				
			move_uploaded_file($tmp_name, $pastaDestino.$codBalnearioGaivota."-".$codBalnearioGaivotaImagem."-O.".$ext);
							
			chmod($pastaDestino.$codBalnearioGaivota."-".$codBalnearioGaivotaImagem."-O.".$ext, 0755);
			
			if($ext != "svg"){
							   
				$imagemWebP = $pastaDestino.$codBalnearioGaivota."-".$codBalnearioGaivotaImagem."-W.webp";

				switch ($ext) {
					case 'jpg':
					case 'jpeg':
					$original_image = imagecreatefromjpeg($pastaDestino.$codBalnearioGaivota."-".$codBalnearioGaivotaImagem."-O.".$ext);
					break;
					case 'png':
					$original_image = imagecreatefrompng($pastaDestino.$codBalnearioGaivota."-".$codBalnearioGaivotaImagem."-O.".$ext);
					break;
					case 'gif':
					$original_image = imagecreatefromgif($pastaDestino.$codBalnearioGaivota."-".$codBalnearioGaivotaImagem."-O.".$ext);
					break;
				}

				saveWebPImage($original_image, $imagemWebP, 95);
				imagedestroy($original_image);

				chmod($pastaDestino.$codBalnearioGaivota."-".$codBalnearioGaivotaImagem."-W.webp", 0755);								
			}

		}else{
			$erroExt = "erro";
		}
	}

	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."cadastros/balnearioGaivota/imagens/".$codBalnearioGaivota."/'>";		
?>
