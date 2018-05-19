<html>
<head>
<title>Registration Form</title>
</head>
<body>
<?php include('header.php'); ?>
<h1>Registration Form - Step 1</h1>
<table>
<form name="RegForm" action="signup2.php" method="post">
<tr><td colspan="2">Enter your enrollment number to continue signup</td></tr>
<tr><td>Enrollment No.</td><td><input type="text" name="rollno"></td></tr>

<tr><td><input type="Submit" value="Continue">
<input type="Reset" name="Reset"></td></tr>
</table>
<?php include('footer.php'); ?>
</html>
</body>