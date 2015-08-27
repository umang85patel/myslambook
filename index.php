<!DOCTYPE html>
<?php
	session_start();
	// Echo session variables that were set on previous page
	if($_SESSION["user"]!=null)
	{
		header("Location: myview.php");
	}
?>
<html>
<head>
	<title>Home|Slambook</title>
</head>
<body>
	<header>
		<form action="signupsubmit.php" method="post">
			User Name<input type="text" placeholder="User Name" name="username" Required>
			<br>Password<input type="password" placeholder="Password" name="password" Required>
			<br><a href="">forgot password?</a>
			<br><input type="submit" value="Log In" name="submitlogin">
		</form>
	</header>

	<section>
		<h1>Sign UP</h1>
		<form action="signupsubmit.php" method="post">
			<br>First Name<input type="text" placeholder="First Name" name="firstname" Required>
			<br>Last Name<input type="text" placeholder="Last Name" name="lastname">
			<br>User Name<input type="text" placeholder="User Name" name="username" Required>
			<br>
			<Input type = 'Radio' Name ='gender' value= 'male' checked>Male
			<Input type = 'Radio' Name ='gender' value= 'female'>Female
			<br>Birth Date<input type="date" name="date">
			<br>Email<input type="email" placeholder="Email" name="email" Required>
			<br>Password<input type="password" placeholder="Password" name="password" Required>
			<br><input type="submit" value="Sign Up" name="submitsignup">
		</form>
	</section>

	<footer>
		&copy;Slambook
	</footer>
</body>
</html>