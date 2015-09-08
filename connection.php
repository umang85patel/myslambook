<?php 
	
	$db="u724522403_slam";
	$user="u724522403_book";
	$password="@2Mukesh";
	$host="mysql.hostinger.in";
	
	if(!$conn=mysqli_connect($host,$user,$password,$db))
	{
		echo "unsuccessful connection";
	}
	

?>