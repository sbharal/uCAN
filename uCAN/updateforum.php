<?php
require('check.php');
require('database.php');


$query = "INSERT INTO forum(postedby, query, time) VALUES(".$_SESSION['serial'].", '".$_POST['queries']."', '".date('D, jS M (H:i a)', time())."' )";
$result = mysql_query($query);
header('Location: forum.php');
?>