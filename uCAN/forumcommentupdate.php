<?php
require('check.php');
require('database.php');


$query = "INSERT INTO forumcomment(post, postedby, comment, time) VALUES('".$_POST['post']."', ".$_SESSION['serial'].", '".$_POST['comment']."', '".date('D, jS M (H:i a)', time())."' )";
$result = mysql_query($query);
header('Location: forum.php');
?>