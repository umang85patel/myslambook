<?php 

	// Start the session
	session_start();

include 'connection.php';
	if(isset($_POST['submitsignup']))
	{	
		if( !empty($_POST['firstname']) and !empty($_POST['username']) and !empty($_POST['email']) and !empty($_POST['password']) and isset($_POST['gender']))
		{
			$fname=$_POST['firstname'];
			$lname=$_POST['lastname'];
			$uname=$_POST['username'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			if($_POST['gender']=='male')
			{
				$gender='male';
				$profilephoto='mpp.png';

			}
			else
			{
				$gender='female';
				$profilephoto='fmm.png';
			}


			$sql="INSERT INTO `slambook`.`userdetails` (`uname`, `pwd`, `email`,`gender`,`fname`,`lname`,`profilephoto`) VALUES('$uname','$password','$email','$gender','$fname','$lname','$profilephoto')";
			if(mysqli_query($conn,$sql))
			{
				$_SESSION["user"] = $uname;
				$_SESSION["signup"] = 'yes';
				header("Location: setprofile.php");
				exit();
			}
			else
			{
				echo 'unsucessful';
			}
		}
		else
		{
			echo 'something is empty';
		}


	}

	if(isset($_POST['submitlogin']))
	{
		if(!empty($_POST['username']) and !empty($_POST['password']) )
		{
			$uname=$_POST['username'];
			$password=$_POST['password'];
			$sql="SELECT * FROM `slambook`.`userdetails` WHERE uname='$uname' and pwd='$password'";
			$result=mysqli_query($conn,$sql);
			if($count=mysqli_num_rows($result)==1)
			{
				// Set session variables
				$_SESSION["user"] = $uname;
				header("Location: myview.php");
				exit();
			}
			else
			{
				echo "username password invalid";
			}
		}
		else
		{
			echo 'somethingjb';
		}
	}


	if(isset($_POST['logoffsubmit']))
	{
		// remove all session variables
		//session_unset();

		// destroy the session
		//session_destroy();
		$_SESSION["user"] = "";
		$_SESSION["photoname"] = "";
		header("Location: index.php");
	}
 ?>