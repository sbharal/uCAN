<?php
require('database.php');

$query = "SELECT serial FROM userpass WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

if(mysql_num_rows($result)==1)
{
	session_start();
	$_SESSION['login'] =1;
	
	$query = "SELECT serial, name FROM profile WHERE serial=".$row['serial'];
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$_SESSION['serial'] = $row['serial'];
	$_SESSION['name'] = $row['name'];
	header('Location: home.php');
}
else
{
	echo "Username or password is incorrect!!!<br/><a href='index.php'>Click here to go back and try again!</a>";
}