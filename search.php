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
</head>
<body>
	<header>
		
	</header>
		<a href="">
			<h2>Slambook</h2>
		</a>
		<a href="">Side View</a>
		<a href="">Amigos</a>
		<a href="settings.php">Settings</a>
		<form action="signupsubmit.php" method="post">
		<input type="submit" name="logoffsubmit" value="Log Off">
		</form>
		<form>
		<input type="search" name="search">
		<input type="submit" name="searchsubmit" value="Search" >
		</form>
	<section>
		<h1>
		<label></label>
		Search Results for <?= $_SERVER['QUERY_STRING']?></h1>
		<div>
			<?php
				//echo $_SERVER['QUERY_STRING'];

				include 'connection.php';
				$tempuname=$_SERVER['QUERY_STRING'];
				$sql = "SELECT id, fname, lname,  profilephoto FROM userdetails WHERE uname='$tempuname'";
				$result=mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) > 0) {
				    // output data of each row

					//$row = mysqli_fetch_array($result);
					//printf ("%s (%s)\n",$row["uname"],$row["fname"]);

				    while($row = mysqli_fetch_array($result)) {
				        echo "<b>id:</b> " . $row["id"]. " - Name: " . $row["fname"]. " ". $row["lname"]. "<img src="."uploads/".$row["profilephoto"].">" . $row["profilephoto"]. "<br>";
				    }
				} else {
				    echo "No results found for $tempuname";
				}
				// Free result set
				mysqli_free_result($result);

				mysqli_close($conn);
			?>
			<?php $result=mysqli_query($conn,$sql);?>
		</div>
	</section>

	<footer>
		&copy;Slambook
	</footer>
</body>
</html>