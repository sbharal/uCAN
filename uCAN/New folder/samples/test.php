<?php
$host 		= "localhost";
$database 	= "test";
$user 		= "root";
$pass 		= "";
//One time things to do
mysql_connect($host, $user, $pass);	//make a connection
mysql_select_db($database);			//select the database

/*
while($row = mysql_fetch_array($result))//get one row from result variable (fetch) and form an array of it and put it into row
{
echo $row['serial'];				//echo first column
echo "<br/>";						//new line
echo $row['name'];					//echo second column
echo "<br/>";
}
*/
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

/*while($row = mysql_fetch_array($result))//get one row from result variable (fetch) and form an array of it and put it into row
{
echo $row['serial'];				//echo first column
echo "<br/>";						//new line
echo $row['name'];					//echo second column
echo "<br/>";
}*/

while($row = mysql_fetch_array($result))//get one row from result variable (fetch) and form an array of it and put it into row
{
echo "<tr>"."<td>".$row['serial']."</td>"."<td>".$row['name']."</td>"."</tr>";	//echo concatenated string
}
?>
</table>


<p>
<?php
$query = "Select name from testing where serial=6";
$result = mysql_query($query);

$row = mysql_fetch_array($result);
echo "Welcome, ".$row['name'];
?>
</p>

<?php
/* insert
$query = "insert into testing(name) values('Happy')";	//execute an insert query onto database table
$result = mysql_query($query);	//mysql will set result var to true or false based on whether query was successful or not

if($result)	//check the result variable to see if the query resulted in success or not
{
	echo "Insert successful!";
}
else
{
	echo "Insert failed!";
}
*/

/* update
$query = "update testing set serial=6 where name='Happy'";	//execute an insert query onto database table
$result = mysql_query($query);	//mysql will set result var to true or false based on whether query was successful or not

if($result)	//check the result variable to see if the query resulted in success or not
{
	echo "update successful!";
}
else
{
	echo "update failed!";
}
*/
/* delete
$query = "delete from testing";	//execute an insert query onto database table
$result = mysql_query($query);	//mysql will set result var to true or false based on whether query was successful or not

if($result)	//check the result variable to see if the query resulted in success or not
{
	echo "delete successful!";
}
else
{
	echo "delete failed!";
}
*/
?>


</body>
</html>