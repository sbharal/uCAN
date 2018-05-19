<?php
require('database.php');

$query = "INSERT INTO userpass(serial, username, password) VALUES ('".$_POST['serial']."', '".$_POST['username']."', '".$_POST['password']."')";	//execute an insert query onto database table
$result = mysql_query($query);	//mysql will set result var to true or false based on whether query was successful or not
if($result)	//check the result variable to see if the query resulted in success or not
{
	echo "Signup successful!";
	echo "<a href='index.php'>Click here to login</a>";
}
else
{
	echo "You might have already signed up!!!";
}
?>