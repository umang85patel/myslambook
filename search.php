<?php
	session_start();
	// Echo session variables that were set on previous page
	if($_SESSION["user"]==null)
	{
		header("Location: index.php");
	}
	/*
	include 'connection.php';
	$hello=$_SESSION['user'];
	$query = "SELECT `profilephoto` FROM `slambook`.`userdetails` WHERE `userdetails`.`uname` = '$hello'";
	
	$result=mysqli_query($conn,$query);

	if(!$result){
	    die("BAD!");
	}
	else if(mysqli_num_rows($result)==1){
	    $row = mysqli_fetch_array($result);
	    $_SESSION['photoname']=$row['profilephoto'];
	    if($_SESSION['photoname']!=null)
	    {
	    	$_SESSION['photoname']=$row['profilephoto'];
	    }
	    else
	    {
	    	$_SESSION['photoname']="mpp.jpg";
	    }
	}
	else{
	    echo "not found!";
	}
	*/
?>


<!DOCTYPE html>
<html>
<head>
	<title>Search Results|Slambook</title>
	<script src="js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4>Search Results for '<?= $_SERVER['QUERY_STRING']?>'</h4>
			</div>
			<div class="panel-body">
					<ul class="list-group">
					<?php
						//echo $_SERVER['QUERY_STRING'];

						include 'connection.php';
						$tempuname=$_SERVER['QUERY_STRING'];
						$sql = "SELECT id, uname, fname, lname,  profilephoto FROM userdetails WHERE uname LIKE '%$tempuname%'";
						$result=mysqli_query($conn,$sql);

						if (mysqli_num_rows($result) > 0) {
						    // output data of each row

							//$row = mysqli_fetch_array($result);
							//printf ("%s (%s)\n",$row["uname"],$row["fname"]);

						    while($row = mysqli_fetch_array($result)) {
						        echo '<li class="list-group-item"><ul class="media-list"><li class="media"><div class="media-left"><a href="http://localhost/myslambook/'.$row["uname"].'"><img class="media-object img-circle img-thumbnail" src="uploads/'.$row["profilephoto"].'"></a></div><div class="media-body"><a href="http://localhost/myslambook/'.$row["uname"].'"><h3 class="media-heading">'.$row["fname"].' '.$row["lname"].'</h3></a><h5>'.$row["id"].'</h5><h5><b>'.$row["profilephoto"].'</b></h5><button class="btn btn-info">Add as Amigo</button></div></li></ul></li>';

						    	
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
		</div>
		<footer>
			<small>&copy;Slambook</small>
		</footer>
	</div>

	<script src="js/jquery-2.0.2.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>