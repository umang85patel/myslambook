<?php 
	
	$db="slambook";
	$user="bbe7139df82ec6";
	$password="fe0583d5";
	$host="ap-cdbr-azure-southeast-a.cloudapp.net";
	
	if(!$conn=mysqli_connect($host,$user,$password,$db))
	{
		echo "unsuccessful connection";
	}
	

?>
