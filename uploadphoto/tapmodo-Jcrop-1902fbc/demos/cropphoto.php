<?php

    session_start();

  if($_SESSION["user"]==null)
  {
    header("Location: index.php");
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
  // get the tmp url
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
    //header("Location: hello.php");
    echo "photo successfully uploaded";
  }
}
?>