<?php

	session_start();
	// Echo session variables that were set on previous page
	if($_SESSION["user"]==null)
	{
		header("Location: index.php");
	}

	  $targ_w = $targ_h = 200;
	  $jpeg_quality = 90;

	  $src = $_SESSION['cropphoto'];
	  $img_r = imagecreatefromjpeg($src);
	  $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	  imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	      $targ_w,$targ_h,$_POST['w'],$_POST['h']);

	  //header('Content-type: image/jpeg');
	  imagejpeg($dst_r, $output_filename, $jpeg_quality);


?>