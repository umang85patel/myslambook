<?php
	session_start();
	// Echo session variables that were set on previous page
	if($_SESSION["user"]==null)
	{
		header("Location: index.php");
	}

	include 'connection.php';
	$username=$_SESSION['user'];
	$query = "SELECT `fname`,`lname`,`profilephoto` FROM `slambook`.`userdetails` WHERE `userdetails`.`uname` = '$username'";
	
	$result=mysqli_query($conn,$query);

	if(!$result){
	    die("BAD!");
	}
	else if(mysqli_num_rows($result)==1){
	    $row = mysqli_fetch_array($result);
	    $_SESSION['photoname']=$row['profilephoto'];
	    $_COOKIE['fname']=$row['fname'];
	    $_COOKIE['lname']=$row['lname'];
	    /*if($_SESSION['photoname']!=null)
	    {
	    	$_SESSION['photoname']=$row['profilephoto'];
	    }
	    else
	    {
	    	$_SESSION['photoname']="mpp.jpg";
	    }*/
	}
	else{
	    echo "not found!";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title><?= $_SESSION["user"] ?>|Slambook</title>
	<script src="js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid">
		<center>
		<div id="coverpart" class="coverpart">
            <img class="imgcover" src="uploads/mosaic.jpg">   
        </div>
        </center>
        <div id="photopart" style="width: 100%;height: 250px;margin-top:-100px">
            <div style="width: 100%; height: 100%;">
                <center>
                    <img src="<?='uploads/'.$_SESSION['photoname']?>" class="img-circle img-thumbnail">
                    <h2 style="font-family:Segoe UI Light;color:black"><?=$_COOKIE['fname'].' '.$_COOKIE['lname']; ?></h2>
                </center>
            </div>
        </div>
        <!-- Large modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload Photo</button>
        <!-- Modal for upload photo -->
        <div id="myModal" class="modal fade">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Upload Photo</h4>
		      </div>
		      <div class="modal-body">
		        <!-- <p>One fine body&hellip;</p> -->
		        <iframe src="http://localhost/myslambook/uploadphoto.php"></iframe>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

        <a href="">Slams</a>
		<a href="">Details</a>
		<a href="">Amigos</a>
	</section>

	<footer>
		&copy;Slambook
	</footer>

	<script src="js/jquery-2.0.2.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>