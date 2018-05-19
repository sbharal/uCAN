<?php
require('check.php');
require('database.php');
$language = "";
if(isset($_POST['english']))
{
	$language = $language."English ";
}
if(isset($_POST['hindi']))
{
	$language = $language."Hindi";
}

$query = "UPDATE profile SET language='".$language."', gender='".$_POST['gender']."', address='".$_POST['address']."', dob='".$_POST['dob']."', mobile='".$_POST['mobile']."', email='".$_POST['email']."' WHERE serial=".$_SESSION['serial'];	//execute an insert query onto database table
$result = mysql_query($query);	//mysql will set result var to true or false based on whether query was successful or not

if($result)	//check the result variable to see if the query resulted in success or not
{
	header('Location: profile.php');
}
else
{
	echo "update failed!";
}
?>