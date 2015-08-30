<?php 
	
	$db="slambookdb";
	$user="b8e54c581cedbf";
	$password="c585089e";
	$host="ap-cdbr-azure-southeast-a.cloudapp.net";
	
	if(!$conn=mysqli_connect($host,$user,$password,$db))
	{
		echo "unsuccessful";
	}
	

?>