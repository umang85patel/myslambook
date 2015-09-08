<?php

    session_start();

  if($_SESSION["user"]==null)
  {
    header("Location: index.php");
  }
  else if($_SESSION["user"]!=null and $_SESSION["signup"]==null)
	{
		//header("Location: myview.php");
	}

if(isset($_POST['cropphoto']))
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $targ_w = $targ_h = 150;
    $jpeg_quality = 90;
    $output_filename=$_SESSION['cropphoto'];
    $src = $_SESSION['cropphoto'];
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
  
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
    $targ_w,$targ_h,$_POST['w'],$_POST['h']);
  
    //header('Content-type: image/jpeg');
    imagejpeg($dst_r, $output_filename, $jpeg_quality);
    header("Location: hello.php");
    exit;
  }
}

if(isset($_POST['uploadphoto']))
{
  $photo_src = $_FILES['photo']['tmp_name'];
// test if the photo realy exists
if (is_file($photo_src)) {
	// photo path in our example
	$photo_dest = 'images/photo_'.time().'.jpg';
	// copy the photo from the tmp path to our path
	copy($photo_src, $photo_dest);
	// call the show_popup_crop function in JavaScript to display the crop popup
	echo '<script type="text/javascript">window.top.window.show_popup_crop("'.$photo_dest.'")</script>';
	$_SESSION["cropphoto"]=$photo_dest;
	header("Location: hello.php");
	//echo "photo successfully uploaded";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Live Cropping Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="demo_files/main.css" type="text/css" />
  <link rel="stylesheet" href="demo_files/demos.css" type="text/css" />
  <link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />

<script type="text/javascript">

  $(function(){

    $('#cropbox').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }



</style>

</head>
<body>

<div class="container">
<div class="row">
<div class="span12">
<div class="jc-demo-box">

    <form action="hello.php" method="post" enctype="multipart/form-data" target="upload_frame" onsubmit="submit_photo()">
                <input type="file" name="photo" id="photo" class="file_input">
                <div id="loading_progress"></div>
                <input type="submit" value="Upload photo" id="upload_btn" name="uploadphoto">
    </form>
    <!-- This is the image we're attaching Jcrop to -->
    <img src="<?= $_SESSION['cropphoto']?>" class="photolarge" id="cropbox" />

    <!-- This is the form that our event handler fills -->
    <form action="hello.php" method="post" onsubmit="return checkCoords();">
      <input type="text" id="x" name="x" />
      <input type="text" id="y" name="y" />
      <input type="text" id="w" name="w" />
      <input type="text" id="h" name="h" />
      <input type="submit" value="Crop Image" name="cropphoto" class="btn btn-large btn-inverse" />
    </form>


  </div>
  </div>
  </div>
  </div>
  </body>

</html>
