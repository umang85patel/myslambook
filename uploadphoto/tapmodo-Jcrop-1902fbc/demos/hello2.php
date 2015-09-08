<?php

    session_start();

  $db="slambook";
  $user="root";
  $password="";
  $host="localhost";
  
  if(!$conn=mysqli_connect($host,$user,$password,$db))
  {
    echo "unsuccessful";
  }

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
    header("Location: hello2.php");
    exit;
}

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

if(isset($_POST['uploadphoto']))
{

    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["uploadphoto"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
            exit;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        exit;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<br>Sorry, your file is too large.";
        $uploadOk = 0;
        exit;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        exit;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<br>Sorry, your file was not uploaded.";
        exit;
    // if everything is ok, try to upload file
    } 
    else 
    {
      echo $_SESSION['photoname']=generateRandomString().'.'.$imageFileType;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"images/".$_SESSION['photoname'])) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $photo=$_SESSION['photoname'];
            $user=$_SESSION['user'];
            $sql="UPDATE `slambook`.`userdetails` SET `profilephoto` = '$photo' WHERE `userdetails`.`uname` = '$user'";
            if(mysqli_query($conn,$sql))
            {
              $_SESSION["signup"]=null;
              $_SESSION['cropphoto']='images/'.$_SESSION['photoname'];
              header("Location: hello2.php");
              exit();
            }
            else
            {
              echo 'unsucessful';
              exit;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Live Cropping Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.min.js"></script>
  <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />

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

    <form action="hello2.php" method="post" enctype="multipart/form-data" target="upload_frame" onsubmit="submit_photo()">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <div id="loading_progress"></div>
                <input type="submit" value="Upload photo" id="upload_btn" name="uploadphoto">
    </form>
    <!-- This is the image we're attaching Jcrop to -->
    <img src="<?=$_SESSION['cropphoto']?>" class="photolarge" id="cropbox" />

    <!-- This is the form that our event handler fills -->
    <form action="hello2.php" method="post" onsubmit="return checkCoords();">
      <input type="text" id="x" name="x" />
      <input type="text" id="y" name="y" />
      <input type="text" id="w" name="w" />
      <input type="text" id="h" name="h" />
      <input type="submit" value="Crop Image" name="cropphoto" />
    </form>


  </div>
  </div>
  </div>
  </div>
  </body>

</html>
