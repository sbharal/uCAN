<?php
require('database.php');

$language = "";
if(isset($_POST['English']))
{
	$language = $language."English ";
}
else
{
	$language = $language."Hindi";
}

$query = "INSERT INTO profile(name, language, gender, email, rollno) VALUES ('".$_POST['name']."', '".$language."', '".$_POST['gender']."', '".$_POST['email']."', '".$_POST['designation']."')";	//execute an insert query onto database table
$result = mysql_query($query);	//mysql will set result var to true or false based on whether query was successful or not
if($result)	//check the result variable to see if the query resulted in success or not
{
	echo "Signing up...";
}
else
{
	echo "You might have already signed up!!!";
}

$query = "SELECT serial FROM profile where email='".$_POST['email']."'";	//check by the email ID that is just entered
$result = mysql_query($query);	//fetch back the newest serial number for faculty that is generated for the faculty by the above INSERT query
$row = mysql_fetch_array($result);
$serial = $row['serial'];

$query = "INSERT INTO userpass(serial, username, password) VALUES (".$serial.", '".$_POST['username']."', '".$_POST['password']."')";	//execute an insert query onto database table
$result = mysql_query($query);	//mysql will set result var to true or false based on whether query was successful or not
if($result)	//check the result variable to see if the query resulted in success or not
{
	echo "<br/>Signup successful!";
	echo "<br/><a href='index.php'>Click here to login</a>";
}
else
{
	echo "You might have already signed up!!!";
}
?>