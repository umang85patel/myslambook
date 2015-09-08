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
	<script src="js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">
						<img alt="Slambook" src="brand.png">
					</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Slambook</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      	<ul class="nav navbar-nav navbar-right">
				        <form class="form-inline" action="signupsubmit.php" method="post">
				        	<a href="">forgot password?</a>
				        	<div class="form-group">
				        		<input type="text" class="form-control" placeholder="User Name" name="username" Required>
								<input type="password" class="form-control" placeholder="Password" name="password" Required>
				        	</div>
							<button type="submit" class="btn btn-default" name="submitlogin">Log In</button>
						</form>
			      	</ul>
				</div>
			</div>
		</div>
	</nav>   

	<br>
	<br>
	<br>

	<div class="container-fluid">
		<form action="signupsubmit.php" method="post">
			<div class="form-group col-md-3">
				  	<input type="text" class="form-control" placeholder="First Name" name="firstname" Required>
				<br>
					<input type="text" class="form-control" placeholder="Last Name" name="lastname">
				<br>
				  	<input type="text" class="form-control" placeholder="User Name" aria-describedby="basic-addon1" name="username" Required>
				<div class="radio">
				    <label>
				    	<input type="radio" aria-label="Male" value="male" name="gender">
				    	Male
				    </label>
				</div>
				<div class="radio">  
				    <label>
				    	<input type="radio" aria-label="Female" value="female" name="gender">
				    	Female
				    </label>
				</div>
				  	<input type="date" class="form-control" placeholder="dd/mm/yyyy" name="date" Required>
				<br>
				  	<input type="email" class="form-control" placeholder="Email" name="email" Required>
				<br>
				  	<input type="password" class="form-control" placeholder="Password" name="password" Required>
				<br>
				<div class="col-md-5 col-md-offset-3">
					<button type="submit" class="form-control btn-info" name="submitsignup">Sign Up</button>
				</div>
			</div>
		</form>
	</div>

	<footer>
		&copy;Slambook
	</footer>

	<script src="js/jquery-2.0.2.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>