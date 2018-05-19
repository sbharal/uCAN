<?php
require('database.php');

$name = $_GET['name'];

$query = "INSERT INTO testing (name) VALUES ('".$name."')";
$result = mysql_query($query);

if($result)
{
	echo "Success!";
}
else
{
	echo "Fail!";
}
?>
<html>
<head>
<title> Welcome to test</title>
</head>
<body>
<table border="1">
<tr><td>Serial</td><td>Name</td></tr>

<?php
$query = "Select * from testing";	//form a query
$result = mysql_query($query);		//pass query to mysql and return result-set to result variable


while($row = mysql_fetch_array($result))//get one row from result variable (fetch) and form an array of it and put it into row
{
echo "<tr>"."<td>".$row['serial']."</td>"."<td>".$row['name']."</td>"."</tr>";	//echo concatenated string
}
?>
</table>
</body>
</html>