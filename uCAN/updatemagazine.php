<?php
require('check.php');
require('database.php');


$query = "INSERT INTO magazine(postedby, content, time) VALUES(".$_SESSION['serial'].", '".$_POST['article']."', '".date('D, jS M (H:i a)', time())."' )";
$result = mysql_query($query);
header('Location: magazine.php');
?>