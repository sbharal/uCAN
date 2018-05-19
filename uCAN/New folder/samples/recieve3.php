<?php
echo "You entered the following details:";
echo "<br/>";
echo "Name: ".$_GET['name'];
echo "<br/>";
echo "Interests: ";
$interests="";
if(isset($_GET['badminton']))
{
	$interests = $interests."Badminton ";
}
if(isset($_GET['cricket']))
{
	$interests = $interests."Cricket";
}
echo "<br/>";
echo "Gender: ".$_GET['gender'];
echo "<br/>";
echo "Address: ".$_GET['address'];

require('database.php');

$query = "INSERT INTO sample(name, interests, gender, address) VALUES ('".$_GET['name']."', '".$interests."', '".$_GET['gender']."', '".$_GET['address']."')";	//execute an insert query onto database table
$result = mysql_query($query);	//mysql will set result var to true or false based on whether query was successful or not

if($result)	//check the result variable to see if the query resulted in success or not
{
	echo "Insert successful!";
}
else
{
	echo "Insert failed!";
}
?>
