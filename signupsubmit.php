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
			$result=mysqli_query($conn,$sql);
			if($result)
			{
				echo "umng";
				$_SESSION["user"] = $uname;
				$_SESSION["signup"] = 'yes';
				$_SESSION["user_id"]=$row['id'];
				header("Location: uploadphoto.php");
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
				$row = mysqli_fetch_array($result);
				 $_SESSION["user_id"]=$row['id'];
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
		$_SESSION['cropphoto'] ="";
		header("Location: index.php");
	}


	if(isset($_POST['searchsubmit']))
	{
		$tempstr=$_POST['search'];
		header('Location: search.php?'.$tempstr);
	}

	if(isset($_POST['viewsubmit']))
	{
		
		header('Location: view.php?');
	}

	
	//this code is for add as a amigo
   	if(isset($_POST['addfriend']))
   	{
   		$friend_id=$_SESSION['friendid'];
    	$user_id=$_SESSION['user_id'];
		$sql="INSERT INTO `slambook`.`friends` (`user_id`, `friend_id`) VALUES('$user_id','$friend_id')";
		$result=mysqli_query($conn,$sql);
		if($result)
		{
			echo "<br><br>friend has been added";
			// $_SESSION["user"] = $uname;
			// $_SESSION["signup"] = 'yes';
			$headchange='Location: http://localhost/myslambook/'.$_SESSION['friend'];
			header($headchange);
			exit();
		}
		else
		{
			echo 'cant be added';
		}
	}

	//this code is for remove friend
	if(isset($_POST['removefriend']))
   	{
   		$friend_id=$_SESSION['friendid'];
    	$user_id=$_SESSION['user_id'];
	 	$sql="DELETE from `slambook`.`friends` where `user_id`='$user_id' and `friend_id`='$friend_id'";
			
			if($result=mysqli_query($conn,$sql))
			{
				
				$headchange='Location: http://localhost/myslambook/'.$_SESSION['friend'];
				header($headchange);
				exit();
			}
			else
			{
				echo 'cant be added';
			}
	}

	//this is ffor the slam submit buuton 
	if(isset($_POST['submitslam']) and !empty($_POST['slamcontent']))
   	{
   		$friend_id=$_SESSION['friendid'];
    	$user_id=$_SESSION['user_id'];
    	$slamcontent=$_POST['slamcontent'];
		$sql="INSERT INTO `slam`(`rcv`, `snd`,`content`) VALUES ('$friend_id','$user_id','$slamcontent')";
		echo $result=mysqli_query($conn,$sql);
		if($result)
		{
			echo "<br><br>slam has been added";
			// $_SESSION["user"] = $uname;
			// $_SESSION["signup"] = 'yes';
			$headchange='Location: http://localhost/myslambook/'.$_SESSION['friend'];
			header($headchange);
			exit();
		}
		else
		{
			echo 'slam cant be added';
		}
	}
 ?>