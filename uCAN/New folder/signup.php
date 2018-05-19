<?php
/*	signup.php
	*. Sign up page for Faculties
	*. Will first ask for a static password
	*. If the password is correct, then the signup process can begin
*/
require('sessdb.php');
if($_POST['okay'])
{
	$fname = mysql_real_escape_string(trim($_POST['fname']));
	$lname = mysql_real_escape_string(trim($_POST['lname']));
	$username = mysql_real_escape_string(trim($_POST['username']));
	$password = mysql_real_escape_string(trim($_POST['password']));
	$crypted_password = md5(implode("#!#", str_split($password, 5)).md5(strlen($password))).md5(strlen($password));
	$query = "INSERT INTO profile (fname, lname, rid, username, password, active)
			VALUES ('".$fname."','".$lname."','Faculty','".$username."','".$crypted_password."',1)";
	$result = mysql_query($query);
	if($result)
	{
		$query = "SELECT fname, lname, pid, rid FROM profile WHERE username='".$username."' AND password = '".$crypted_password."';";
			//echo $query;
			$result = mysql_query($query);
			if(mysql_num_rows($result) ==1)
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
				header('Location: editprofile.php?profile='.$_SESSION['pid']);
			}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>uCAN - sign up</title>
    <link rel="stylesheet" href="commonstyle.php"/>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="ajax.js"></script>
</head>
<body style="background: url(ucanback.png);background-repeat: no-repeat;background-position: center center;">
<?php require('banner.php'); ?>

<div style="height: 400px;position: relative;">
	<div style="vertical-align: middle;position: absolute;top: 50%;width: 100%;left: 50%;width: 350px;height: 350px;margin-top: -175px;margin-left: -175px;background-color: rgba(255,255,255,0.7);padding: 5px;">
	
	<?php
	if($_POST)
	{
	if($_POST['pass'] == 'uitrgpvfaculty')
	{
	//show the signup form
	echo '<div>
		<table>
		<form action="" method="post">	
			<tr>
				<td>First name:</td>
				<td><input type="text" name="fname" placeholder="First name"/></td>
			</tr>
			<tr>
				<td>Last name:</td>
				<td><input type="text" name="lname" placeholder="First name"/></td>
			</tr>
			<tr>
				<td>Choose a username:</td>
				<td><input type="text" name="username" placeholder="choose a username"></td>
				<input type="hidden" name="mode" value="uselect"/>
				<td><div id="umsg"></div></td>
			</tr>
			<tr>
				<td>Choose a password:</td>
				<td><input type="password" name="password" placeholder="type a password"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="okay" value="yes">
				<input type="submit" id="uselectsub" value="Activate" class="ubutton"></td>
			</tr>
			</form>
		</table>
	</div>';
	}
	else
	{
	echo '<div>
		<form action="" method="post">
		<div>Incorrect password</div>
		<div>Enter password: <input type="password" name="pass"/></div>
		</input type="submit" value="Signup" class="ubutton"/>
		</form>';
	}
	}
	else
	{
	echo '<div>
		<form action="" method="post">
		<div>Enter password: <input type="password" name="pass"/></div>
		</input type="submit" value="Signup" class="ubutton"/>
		</form>';
	}
	?>
</div>
</div>
<script type="text/javascript">
$('input[name="username"]').blur(function(){
	$.post('activate2.php',
			{ mode: 'uselect', username: $('input[name="username"]').val()},
			function(data)
			{
				if(data == 1)
				{ $('#umsg').html('Username available!');$('form').submit(function(){})}
				else
				{ $('#umsg').html('Username unavailable!'); $('input[name="username"]').val('');$('form').submit(function(event){event.preventDefault();});}
			});
});
</script>

<?php require('footer.php'); ?>
</body>
</html>