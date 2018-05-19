<?php
echo '<div style="background-color: rgb(200,200,200);padding-left: 20px;padding-right: 20px;padding-top: 2px;padding-bottom: 2px;">
<div style="float:right;"><a href="logout.php">Logout</a></div>
<div style="float:right;margin-right:5px;"><a href="magazine.php">Magazine</a></div>
<div style="float:right;margin-right:5px;"><a href="forum.php">Discussion Forum</a></div>
<div><a href="home.php">HOME </a>| ';
echo '<a href="profile.php?profile='.$_SESSION['serial'].'">'.$_SESSION['name'].'</a>';
echo '</div>
</div>';
?>