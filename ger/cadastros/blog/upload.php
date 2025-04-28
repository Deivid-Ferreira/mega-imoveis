<?php
	include('../../f/conf/config.php');

	$pastaDestino = $_SERVER['DOCUMENT_ROOT'].$urlUpload.'/f/blog/';
	
	$codBlog = $_POST['codBlog'];

	$sizes = [
		['width' => 200, 'height' => 150, 'tamanho' => 'P'],
		['width' => 400, 'height' => 300, 'tamanho' => 'M'],
		['width' => 800, 'height' => 600, 'tamanho' => 'G'],
	];
								
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
  
		if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])){	
			
			$file_name = uniqid().'.'.$ext;							
				
			$sqlBlog = "INSERT INTO blogImagens VALUES(0, ".$codBlog.", 'F', '".$ext."')";
			$resultBlog = $conn->query($sqlBlog);	

			$sqlPegaBlog = "SELECT codBlogImagem FROM blogImagens ORDER BY codBlogImagem DESC LIMIT 0,1";
			$resultPegaBlog = $conn->query($sqlPegaBlog);
			$dadosPegaBlog = $resultPegaBlog->fetch_assoc();
						
			$codBlogImagem = $dadosPegaBlog['codBlogImagem'];
				
			move_uploaded_file($tmp_name, $pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);
							
			chmod($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext, 0755);
							   
			foreach ($sizes as $size) {
				list($width, $height) = getimagesize($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);

				$ratio = $width / $height;
				$new_width = $size['width'];
				$new_height = $new_width / $ratio;
				$tamanho = $size['tamanho'];

				$new_image = imagecreatetruecolor($new_width, $new_height);

				switch ($ext) {
					case 'jpg':
					case 'jpeg':
					$original_image = imagecreatefromjpeg($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);
					break;
					case 'png':
					$original_image = imagecreatefrompng($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);
					break;
					case 'gif':
					$original_image = imagecreatefromgif($pastaDestino.$codBlog."-".$codBlogImagem."-O.".$ext);
					break;
				}

				imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

				switch ($ext) {
					case 'jpg':
					case 'jpeg':
					imagejpeg($new_image, $pastaDestino.$codBlog."-".$codBlogImagem."-".$tamanho.".".$ext, 100);
					break;
					case 'png':
					imagepng($new_image, $pastaDestino.$codBlog."-".$codBlogImagem."-".$tamanho.".".$ext);
					break;
					case 'gif':
					imagegif($new_image, $pastaDestino.$codBlog."-".$codBlogImagem."-".$tamanho.".".$ext);
					break;
				}

				imagedestroy($new_image);

				chmod($pastaDestino.$codBlog."-".$codBlogImagem."-P.".$ext, 0755);
				chmod($pastaDestino.$codBlog."-".$codBlogImagem."-M.".$ext, 0755);
				chmod($pastaDestino.$codBlog."-".$codBlogImagem."-G.".$ext, 0755);								
			}

		}else{
			$erroExt = "erro";
		}
	}

	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."cadastros/blog/imagens/".$codBlog."/'>";		
?>
