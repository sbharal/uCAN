<?php
require('check.php');
require('database.php');

if($_POST['do'] == "like")
{
$query = "INSERT INTO likes(postedby, post, time) VALUES(".$_SESSION['serial'].", '".$_POST['post']."', '".date('D, jS M (H:i a)', time())."' )";
$result = mysql_query($query);
}
else
{
$query = "DELETE FROM likes WHERE post=".$_POST['post']." AND postedby=".$_SESSION['serial'];
$result = mysql_query($query);
}
header('Location: post.php?post='.$_POST['post']);
?>