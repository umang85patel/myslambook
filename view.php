<?php
	session_start();
	// Echo session variables that were set on previous page
	if($_SESSION["user"]==null)
	{
	header("Location: index.php");
	}

	include 'connection.php';
	$oview=$_SERVER['QUERY_STRING'];
	$_SESSION['friend']=$_SERVER['QUERY_STRING'];

	$query = "SELECT `id`,`fname`,`lname`,`profilephoto` FROM `slambook`.`userdetails` WHERE `userdetails`.`uname` = '$oview'";
	
	$result=mysqli_query($conn,$query);

	if(!$result){
	    die("BAD!");
	}
	else if(mysqli_num_rows($result)==0)
	{
		header('Location: noresult.php');
		exit();
	}
	else if(mysqli_num_rows($result)==1){
	    $row = mysqli_fetch_array($result);
	    //$_SESSION['photoname']=$row['profilephoto'];
	    if($_SESSION['photoname']!=null)
	    {   
	    	$_SESSION['photoname']=$row['profilephoto'];
	    	$_SESSION['friendid']=$row['id'];
	    	$_COOKIE['fname']=$row['fname'];
	    	$_COOKIE['lname']=$row['lname'];
	    }
	    else
	    {
	    	$_SESSION['photoname']="mpp.jpg";
	    }
	}
	else{
	    echo "not found!";
	}

     
?>


<!DOCTYPE html>
<html>
<head>
	<title><?=$_SERVER['QUERY_STRING']?>|Slambook</title>
	<script src="js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body style="max-width:1100px; margin:0 auto;">
	<?php include 'navbar.php'; ?>	
	<div class="container-fluid">
			<div id="coverpart" class="">
	            <img class="imgcover" src="uploads/mosaic.jpg">   
	        </div>
	    <center>
        <div style="margin-top:-100px">
                    <img src="<?='uploads/'.$_SESSION['photoname']?>" class="img-circle img-thumbnail">
                    <h2 style="font-family:Segoe UI Light;color:black"><?=$_COOKIE['fname'].' '.$_COOKIE['lname']; ?></h2>
        </div>
        </center>
        </div>
        <form action="signupsubmit.php" method="post">
        <input type="hidden" value="$_SESSION['friendid'] " name="fid">
        <?php
        	 $x=$_SESSION['user_id'];
        	 $y=$_SESSION['friendid'];
             $check="SELECT * FROM `slambook`.`friends` WHERE `friends`.`user_id` = '$x' and `friends`.`friend_id`='$y'";
             if($result=mysqli_query($conn,$check))
             {
             	if(mysqli_num_rows($result)==0)
             	{
             		echo "<button class=\"btn btn-info\" name=\"addfriend\" type=\"submit\">Add as Amigo</button>";
             	}
             	else
             	{
             		echo "<button class=\"btn btn-info\" name=\"removefriend\" type=\"submit\">Remove Amigo</button>";
             	}

             }
        ?>
        </form>

		<div class="tabbable tabs-left">
            <ul class="nav nav-pills">
                <li class="active"><a href="#tab1" data-toggle="tab">Slams</a></li>
                <li><a href="#tab2" data-toggle="tab">Details</a></li>
                <li><a href="#tab3" data-toggle="tab">Amigos</a></li>
            </ul>
            <br>
            <div class="tab-content">
                

					<div class="tab-pane active" id="tab1">
	                    <div class="form-group">
		                    <div class="row">
							  <div class="col-lg-8">
							  	<form action="signupsubmit.php" method="post">
								    <div class="input-group">
								      	<input type="text" class="form-control" name="slamcontent" placeholder="Slam whatever you feel..." Required>
								      	<span class="input-group-btn">
								        	<button class="btn btn-success" name="submitslam" type="submit">Slam</button>
								      	</span>
								    </div><!-- /input-group -->
								</form>
							  </div><!-- /.col-lg-6 -->
							</div>
	                    </div>
                    <ul class="list-group">
                    <?php
                    	include 'connection.php';
						$tempuname=$_SERVER['QUERY_STRING'];
						$sql = "SELECT id, uname FROM userdetails WHERE uname LIKE '%$tempuname%'";
						$result=mysqli_query($conn,$sql);
						if (mysqli_num_rows($result) > 0) {
						    // output data of each row

							//$row = mysqli_fetch_array($result);
							//printf ("%s (%s)\n",$row["uname"],$row["fname"]);

						    while($row = mysqli_fetch_array($result)) {

						    	$myid=$row["id"];
						    	$sql2="SELECT snd, time, content, photo FROM slam WHERE rcv=$myid ORDER BY time DESC";
								$result2=mysqli_query($conn,$sql2);

								while($row2 = mysqli_fetch_array($result2)) {

									$sndid=$row2["snd"];
									$sql3="SELECT uname, fname, lname, profilephoto FROM userdetails WHERE id=$sndid ";
									$result3=mysqli_query($conn,$sql3);

									while($row3 = mysqli_fetch_array($result3)) {


						        		echo '<li class="list-group-item"><ul class="media-list"><li class="media"><div class="media-left"><a href="http://localhost/myslambook/'.$row3["uname"].'"><img class="media-object img-circle img-thumbnail" style="width:80px; height:80px;" src="uploads/'.$row3["profilephoto"].'"></a></div><div class="media-body"><a href="http://localhost/myslambook/'.$row3["uname"].'"><h4 class="media-heading">'.$row3["fname"].' '.$row3["lname"].'</h4></a><h6>'.$row3["uname"].'</h6><h6><b>'.$row2["content"].'</b></h6><button class="btn btn-link">Like</button></div></li></ul></li>';
									}
								}
						    }
						} else {
						    echo "No results found for $tempuname";
						}
						// Free result set
						mysqli_free_result($result);

						mysqli_close($conn);

                    ?>
                    </ul>

                </div>

                <div class="tab-pane" id="tab2">
                    <p>This is the page content for Tab Details</p>
                </div>
                <div class="tab-pane" id="tab3">
                    <p>This is the page content for Tab Amigos</p>
                </div>
            </div>
        </div>

	<footer>
		&copy;Slambook
	</footer>


	<script src="js/jquery-2.0.2.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>