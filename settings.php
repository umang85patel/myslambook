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
		<a href="">Settings</a>
		<a href="">Log Off</a>
	<section>
		<h1>Settings</h1>
        <a href=""><h3>Personal</h3></a>
			<form action="signupsubmit.php" method="post">
				<br>First Name<input type="text" placeholder="First Name" name="firstname" Required>
				<br>Last Name<input type="text" placeholder="Last Name" name="lastname">
				<br>User Name<input type="text" placeholder="User Name" name="username" Required>
				<br>
				<Input type = 'Radio' Name ='gender' value= 'male'>Male
				<Input type = 'Radio' Name ='gender' value= 'female'>Female
				<br>Birth Date<input type="time" name="date">
				<br>Email<input type="email" placeholder="Email" name="email" Required>
				<br>Password<input type="password" placeholder="Password" name="password" Required>
				<input type="submit" name="savepersonalsubmit" value="Save">
				<input type="submit" name="cancelpersonalsubmit" value="Cancel">
			</form>

		<a href=""><h3>Security</h3></a>
			<form action="signupsubmit.php" method="post">
				<br>Password<input type="password" placeholder="Password" name="password" Required>
				<input type="submit" name="savesecuritysubmit" value="Save">
				<input type="submit" name="cancelsecuritysubmit" value="Cancel">
			</form>
		<a href=""><h3>Privacy</h3></a>
		<a href=""><h3>Blocking</h3></a>
		<a href=""><h3>Notifications</h3></a>
		
	</section>

	<footer>
		&copy;Slambook
	</footer>
</body>
</html>