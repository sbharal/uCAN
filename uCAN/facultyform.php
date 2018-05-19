<?php require('database.php'); ?>
<html>
<head><title>Faculty Registration Form</title></head>
<body>
<?php include('header.php'); ?>
<h1>Faculty Registration Form</h1>
<table>
<form action="facultyformbackend.php" method= "post">
<tr><td>Name:</td><td><input type= "text" name="name"></td></tr>
<tr><td>Username:</td><td><input type= "text" name="username"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr><td>Email ID:</td><td><input type="text" name="email"></td></tr>
<tr><td>Select the Language</td>
<td><input type= "checkbox" name="English" value="1">English
<input type= "checkbox" name="Hindi" value="1">Hindi</td></tr>
<tr><td>Select gender</td>
<td><input type="Radio" name="gender" value="Male">Male
<input type="Radio" name="gender" value="Female">Female</td></tr>
<tr><td>Select department</td>
<td><Select name="department">
<option value= "IT">Information Technology</option>
<option value= "CSE">Computer Science Engineering</option>
<option value= "CE">Civil Engineering</option>
<option value= "MECH">Mechanical Engineering</option>
<option value= "EC">Electronics And Communication</option>
<option value= "EX">Electrical And Electronics</option>
</Select></td></tr>
<tr><td>Select Designation</td>
<td><Select name="designation">
<option value= "Lecturer">Lecturer</option>
<option value= "Professor">Professor</option>
<option value= "Assistant Professor">Assistant Professor</option>
<option value= "HOD">HOD</option>
<option value= "Director">Director</option>
<option value= "Chairman">Chairman</option>
<option value= "Dean">Dean</option>
</Select></td></tr>
</table>
<input type="Submit" name="Submit" value="Submit">
<input type="Reset" name="Reset" value="Reset">
<?php include('footer.php'); ?>
</body>
</html>