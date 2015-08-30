<?php
  session_start();
	// Echo session variables that were set on previous page
	if($_SESSION["user"]==null)
	{
		header("Location: index.php");
	}
?>


<html lang="en">
<head>
  <title>Hello World | Jcrop Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />

<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.Jcrop.js"></script>
<script type="text/javascript">
  jQuery(function($){

    // How easy is this??
    $('#target').Jcrop();

  });

</script>
<link rel="stylesheet" href="demo_files/main.css" type="text/css" />
<link rel="stylesheet" href="demo_files/demos.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />

</head>



<body>

  <div class="container">
    <div class="row">
      <div class="span12">
        <div class="jc-demo-box">
  
          <form action="upload_photo.php" method="post" enctype="multipart/form-data" target="upload_frame" onsubmit="submit_photo()">
                <input type="file" name="photo" id="photo" class="file_input">
                <div id="loading_progress"></div>
                <input type="submit" value="Upload photo" id="upload_btn">
          </form>
  
    
    <img src="<?= $_SESSION['cropphoto']?>" id="target" alt="[Jcrop Example]" />

  </div>
  </div>
  </div>
  </div>

</body>
</html>

