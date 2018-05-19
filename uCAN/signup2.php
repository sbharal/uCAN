<?php
require('database.php');

$query = "SELECT serial, name FROM profile WHERE rollno='".$_POST['rollno']."'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

?>
<html>
<head>
<title>Registration Form</title>
</head>
<body>
<?php include('header.php'); ?>
<h1>Registration Form - Step 2</h1>
<table>
<form name="RegForm" action="signupbackend.php" method="post">
<tr><td colspan="2">Create your username and password to complete signup</td></tr>
<tr><td colspan="2">You are: <?php echo $row['name'];?></td></tr>
<tr><td>Username</td><td><input type="text" name="username"></td></tr>
<tr><td>Password</td><td><input type="password" name="password"></td></tr>
<input type="hidden" name="serial" value="<?php echo $row['serial'];?>"/>
<tr><td><input type="Submit" value="Signup">
<input type="Reset" name="Reset"></td></tr>
</table>
<?php include('footer.php'); ?>
</body>
</html>