<!DOCTYPE html>


<html>
<body>

<form action="setprofile.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html> 
<?php

session_start();
	// Echo session variables that were set on previous page
	if($_SESSION["user"]==null)
	{
		header("Location: index.php");
	}
	else if($_SESSION["user"]!=null and $_SESSION["signup"]==null)
	{
		header("Location: myview.php");
	}

	include 'connection.php';

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
if(isset($_POST['submit']))
{
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "<br>Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "<br>Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} 
		else 
		{
			echo $_SESSION['photoname']=generateRandomString().'.'.$imageFileType;
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"uploads/".$_SESSION['photoname'])) {
		        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		        $photo=$_SESSION['photoname'];
		        $user=$_SESSION['user'];
		        $sql="UPDATE `slambook`.`userdetails` SET `profilephoto` = '$photo' WHERE `userdetails`.`uname` = '$user'";
				if(mysqli_query($conn,$sql))
				{
					$_SESSION["signup"]=null;
					header("Location: myview.php");
					exit();
				}
				else
				{
					echo 'unsucessful';
				}
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
}
?> 