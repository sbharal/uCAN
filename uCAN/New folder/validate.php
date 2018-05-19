<?php
require('sessdb.php');
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if(!empty($username) && !empty($password))
{
	if(  ( function_exists("get_magic_quotes_gpc") && get_magic_quotes_gpc() ) || ini_get('magic_quotes_sybase')  )
	{//magic_quotes_gpc() correction
            $username = stripslashes($username);
            $password = stripslashes($password);
	}
	$username=mysql_real_escape_string($username);
	$crypted_password = md5(implode("#!#", str_split($password, 5)).md5(strlen($password))).md5(strlen($password));
	$password=mysql_real_escape_string($crypted_password);
		
	$query = "SELECT fname, lname, pid, rid FROM profile WHERE username='".$username."' AND password = '".$password."';";
	//echo $query;
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 1)
	{
		$res=mysql_fetch_array($result);
		$_SESSION['login'] = 1;
		$_SESSION['fname'] = $res['fname']; 
		$_SESSION['lname'] = $res['lname'];
		$_SESSION['name'] = $res['fname'].' '.$res['lname'];
		$_SESSION['pid'] = $res['pid'];
		$_SESSION['rid'] = $res['rid'];
			if($_POST['remember']=='yes')
			{
				setcookie('login', 1, time()+604800);
				setcookie('pid', $res['pid'], time()+604800);
			}
		header('Location: index.php');
	}
	else
	{	header('Location: home.php?err=wup');	}
}
else
{	header('Location: home.php?err=wup');	}
?>