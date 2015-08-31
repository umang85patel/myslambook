<?php
	include 'connection.php';
	
	
	$sql="CREATE TABLE `userdetails`. ( `id` INT(4) NOT NULL AUTO_INCREMENT , `uname` VARCHAR(15) NOT NULL , `pwd` VARCHAR(20) NOT NULL , `email` VARCHAR(50) NOT NULL , `gender` TEXT NOT NULL , `fname` TEXT NOT NULL , `lname` TEXT NULL , `profilephoto` VARCHAR(200) NULL , `coverphoto` VARCHAR(200) NULL , PRIMARY KEY (`id`(4)), UNIQUE `uname` (`email`, `uname`))";
			if(mysqli_query($conn,$sql))
			{
				header("Location: setprofile.php");
				exit();
			}
			else
			{
				echo 'unsucessful';
			}
	
		?>