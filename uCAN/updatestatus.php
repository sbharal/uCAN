<?php
require('check.php');
require('database.php');


$query = "INSERT INTO post(postedby, content, time) VALUES(".$_SESSION['serial'].", '".$_POST['status']."', '".date('D, jS M (H:i a)', time())."' )";
$result = mysql_query($query);
header('Location: home.php');
?>