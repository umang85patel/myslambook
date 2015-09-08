<!DOCTYPE html>
<?php

//this code is to fetch ruid from db but by now i am doing it simply 
$_SESSION['ruid']='12';
if(isset($_POST['sendslam']) and isset($_POST['slam']))
{
    echo 'h t hefw ni';
}
else
{
	echo "google";
}
?>

<html>
    <body>
        <fonm action="amigo.php" method="post">
        <input type="text" name="slam" placeholder="slam">
        <input type="submit" name="sendslam" value="Slam it">
        </form>
    </body>
</html>