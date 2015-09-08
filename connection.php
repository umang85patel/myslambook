<?php 
	
	$db="slambook";
	$user="root";
	$password="";
	$host="localhost";
	
	if(!$conn=mysqli_connect($host,$user,$password,$db))
	{
		echo "unsuccessful connection";
	}
	

?>