<?php
	session_start();
	// Echo session variables that were set on previous page
	if($_SESSION["user"]==null)
	{
		header("Location: index.php");
	}

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
	<title>Home|Slambook</title>
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
		<form action="signupsubmit.php" method="post">
			<input type="search" name="search">
			<input type="submit" name="searchsubmit" value="Search" >
		</form>
	<section>
		<h1>My View</h1>
		<div id="coverpart" style="width: 100%;height: 100px;margin-top:10px">
            <img src="">   
        </div>
        <div id="photopart" style="width: 100%;height: 50px;margin-top:10px">
            <img src="<?='uploads/'.$_SESSION['photoname']?>">
        </div>
        <a href="">Slams</a>
		<a href="">Details</a>
		<a href="">Amigos</a>
	</section>

	<footer>
		&copy;Slambook
	</footer>
</body>
</html>