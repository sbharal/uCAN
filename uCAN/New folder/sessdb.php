<?php
/* performs session start and declares the site-wide database variables.
	This file must be used to set the database variables that will be used everywhere.
	This file will:
		1. Start the session (or resume a last one)
		2. Open a database connection and selects the required DB
*/
session_start();
//error_reporting(0);
/*
$host = "mysql4.000webhost.com";
$database = "a1438406_ucan";
$user = "a1438406_ucan";
$password = "yes!you@can#";
*/
//*
$host = "localhost";
$user = "root";
$password = "";
$database = "ucan";
//*/
$con = mysql_connect($host, $user, $password) or die('Something went wrong!');
mysql_select_db($database) or die('Something went wrong again');

/* ---Set of common functions to be used everywhere--- */
//Clean up function for POSTed variables
function cleanupvar($var)
{
	if(( function_exists("get_magic_quotes_gpc") && get_magic_quotes_gpc() ) || ini_get('magic_quotes_sybase'))
	{//magic_quotes_gpc() correction
		$var = stripslashes(trim($var));
	}
	$var=mysql_real_escape_string($var);
	return $var;
}
//Notifications and Alerts function
function notifalert()
{
$query = "SELECT alerts, notif FROM profile WHERE pid=".$_SESSION['pid'].";";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
return array($row['notif'], $row['alerts']);
}

?>