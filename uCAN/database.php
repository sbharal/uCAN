<?php
$host 		= "localhost";
$database 	= "ucan";
$user 		= "root";
$pass 		= "";
//One time things to do
mysql_connect($host, $user, $pass);	//make a connection
mysql_select_db($database);			//select the database
?>