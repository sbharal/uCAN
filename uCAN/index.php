<html>
<head>
<title>Welcome to uCAN</title>
</head>
<body>
<?php include('header.php'); ?>
<div style="overflow:hidden;">

<div style="width:400px;float:right;">
<div style="padding: 5px;">
	<form action="validate.php" method="POST">
	<table>
	<tr><td><label>Username:</td><td><input type="text" name="username"/></label></td></tr>
	<tr><td><label>Password:</td><td><input type="password" name="password"/></label></td></tr>
	<tr><td colspan="2" style="text-align:center;"><input type="Submit" value="Login"/></td></tr>
	</table>
	</form>
</div>
<div style="text-align:center;padding: 4px;">
	<a href="signup1.php" style="font-size: 22px;border: 1px solid rgb(0,0,0);background-color: rgb(240, 240, 240);color: rgb(0,0,0);padding: 2px;">Sign Up for Students</a>
	<br/><br/>
	<a href="facultyform.php" style="font-size: 22px;border: 1px solid rgb(0,0,0);background-color: rgb(240, 240, 240);color: rgb(0,0,0);padding: 2px;">Sign Up form for Faculties</a>
</div>
</div>
<div style="text-align:center;">
	<img src="TrubaLogo.jpg" style="height: 400px; width: 400px;"/>
<div>
</div>
<?php include('footer.php'); ?>
</body>
</html>