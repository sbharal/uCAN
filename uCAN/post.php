<?php
require('check.php');
require('database.php');
if(!isset($_GET['post']))
{
	header('Location: home.php');
}
?>
<html>
<body>
<?php include('header.php'); ?>
<?php include('user.php'); ?>
<?php
$query = "SELECT * FROM post WHERE serial=".$_GET['post'];
$result = mysql_query($query);
$prow = mysql_fetch_array($result);

$query = "SELECT serial, name FROM profile WHERE serial=".$prow['postedby'];
$result = mysql_query($query);
$row = mysql_fetch_array($result);
?>
<table>
<tr style="background-color: rgb(180, 180, 200);"><td><?php echo "<a href=\"profile.php?profile=".$row['serial']."\">".$row['name']."</a>";?>
<br/><?php echo $prow['content'];?>
<br/><?php echo $prow['time'];?></td></tr>
<tr><td>
<span style="float: right;"><?php
$query = "SELECT COUNT(*) numlikes FROM likes WHERE post=".$_GET['post'];
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if($row['numlikes']!=0)
{
	echo $row['numlikes']." people like this.";
}
?></span>
<?php
$query = "SELECT serial FROM likes WHERE post=".$_GET['post']." AND postedby=".$_SESSION['serial'];
$result = mysql_query($query);
if(mysql_num_rows($result)==1)
{
	echo '<form action="likeupdate.php" method="post">
<input type="hidden" name="do" value="unlike"/>
<input type="hidden" name="post" value="'.$prow['serial'].'"/>
<input type="Submit" value="Unlike">';
}
else
{
	echo'<form action="likeupdate.php" method="post">
<input type="hidden" name="do" value="like"/>
<input type="hidden" name="post" value="'.$prow['serial'].'"/>
<input type="Submit" value="Like">
</form>';
}
?>
</form>

</td></tr>
<?php
$query = "SELECT profile.name, profile.serial, comment, time FROM comment INNER JOIN profile ON comment.postedby = profile.serial WHERE post=".$_GET['post'];
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
echo "<tr style=\"background-color: rgb(220, 220, 220);\"><td><a href=\"profile.php?profile=".$row['serial']."\">".$row['name']."</a><br/>".$row['comment']."<br/>posted at: ".$row['time']."</td></tr>";
}
?>
<form action="commentupdate.php" method="post">
<tr><td><textarea name="comment"></textarea></td></tr>
<tr><td><input type="Submit" value="Comment"></td></tr>
<input type="hidden" name="post" value="<?php echo $prow['serial'];?>"/>
</form>
</table>
<?php include('footer.php'); ?>
</body>
</html>