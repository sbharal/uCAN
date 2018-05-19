<?php
$host 		= "localhost";
$database 	= "ucan";
$user 		= "root";
$pass 		= "";
//One time things to do
mysql_connect($host, $user, $pass);	//make a connection
mysql_select_db($database);			//select the database
$query = "Select * from profile";	//form a query
$result = mysql_query($query);		//pass query to mysql and return result-set to result variable
?>
<html>
<head>
<title> Welcome To Testing Table</title>
</head>
<body>
<table border="1">
<tr><td><h4>Serial No.</h4></td><td><h4>Roll No.</h4></td><td><h4>Name</h4></td><td><h4>E-Mail</h4></td></tr>
<?php
$query = "Select * from profile";	//form a query
$result = mysql_query($query);		//pass query to mysql and return result-set to result variable
while($row = mysql_fetch_array($result))//get one row from result variable (fetch) and form an array of it and put it into row
{
echo "<tr>"."<td>".$row['serial']."</td>"."<td>".$row['rollno']."</td>"."<td>".$row['name']."</td>"."<td>".$row['email']."</td>"."</tr>";	//echo concatenated string
}
?>
</table>
</body>
</html>