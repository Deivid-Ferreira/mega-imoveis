<?php	 
  /*******************************************************
   * Only these origins will be allowed to upload images *
   ******************************************************/
  $accepted_origins = array("http://192.168.0.200", "http://softbest");

  /*********************************************
   * Change this line to set the upload folder *
   *********************************************/
  $imageFolder = "images/";
  $imageFolder2 = "http://192.168.0.200/mega-imoveis/ger/images/";

  reset ($_FILES);
  $temp = current($_FILES);
  if (is_uploaded_file($temp['tmp_name'])){
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.1 403 Origin Denied");
        return;
      }
    }

    /*
      If your script needs to receive cookies, set images_upload_credentials : true in
      the configuration and enable the following two headers.
    */
    // header('Access-Control-Allow-Credentials: true');
    // header('P3P: CP="There is no P3P policy."');

    // Sanitize input
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.1 400 Invalid file name.");
        return;
    }

    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        header("HTTP/1.1 400 Invalid extension.");
        return;
    }
	
	$limpaData = date('Y-m-d');
	$limpaData = str_replace("-", "", $limpaData);
	$limpaData = str_replace("-", "", $limpaData);
	$limpaData = str_replace("-", "", $limpaData);
	
	$limpaHora = date('H:i:s');
	$limpaHora = str_replace(":", "", $limpaHora);
	$limpaHora = str_replace(":", "", $limpaHora);
	$limpaHora = str_replace(":", "", $limpaHora);

	$novoNome = $limpaData.$limpaHora.$temp['name'];

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $novoNome;
    $filetowrite2 = $imageFolder2 . $novoNome;
    move_uploaded_file($temp['tmp_name'], $filetowrite);

    // Respond to the successful upload with JSON.
    // Use a location key to specify the path to the saved image resource.
    // { location : '/your/uploaded/image/file'}
    echo json_encode(array('location' => $filetowrite2));
  } else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
  }
?>
