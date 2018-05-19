<?php
require('check.php');
require('database.php');
?>
<html>
<body>
<?php include('header.php'); ?>
<?php include('user.php'); ?>
<h1 style="text-align:center; background-color: rgb(200,200,200);">News Feed</h1>
<form action="updatestatus.php" method="post">
<table>
<tr><td>Update Status</td></tr>
<tr><td><textarea name="status"></textarea></td></tr>
<tr><td><input type="Submit" value="Post"></td></tr>
</table>
</form>
<hr/>
<?php
$query = "	SELECT post.serial pserial, post.content, post.time, profile.serial profserial, profile.name
			FROM post
			INNER JOIN profile
			ON post.postedby = profile.serial
			ORDER BY post.serial DESC";
		
$presult = mysql_query($query);
while($prow = mysql_fetch_array($presult))
{
//start of one post
//every post will be in a separate table
?>
<table>
<tr style="background-color: rgb(180, 180, 200);"><td><img src="profileimages/pimg_<?php echo $prow['profserial'];?>.jpg"/><?php echo "<a href=\"profile.php?profile=".$prow['profserial']."\">".$prow['name']."</a>";?>
<br/><?php echo $prow['content'];?>
<br/><?php echo $prow['time'];?></td></tr>
<tr><td>
<span style="float: right;"><?php
$query = "SELECT COUNT(*) numlikes FROM likes WHERE post=".$prow['pserial'];
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if($row['numlikes']!=0)
{
	echo $row['numlikes']." people like this.";
}
?></span>
<?php
$query = "SELECT serial FROM likes WHERE post=".$prow['pserial']." AND postedby=".$_SESSION['serial'];
$result = mysql_query($query);
if(mysql_num_rows($result)==1)
{
	echo '<form action="likeupdate.php" method="post">
<input type="hidden" name="do" value="unlike"/>
<input type="hidden" name="post" value="'.$prow['pserial'].'"/>
<input type="Submit" value="Unlike">';
}
else
{
	echo'<form action="likeupdate.php" method="post">
<input type="hidden" name="do" value="like"/>
<input type="hidden" name="post" value="'.$prow['pserial'].'"/>
<input type="Submit" value="Like">
</form>';
}
?>
</form>
</td></tr>
<?php
$query = "	SELECT profile.name, profile.serial, comment, time
			FROM comment
			INNER JOIN profile
			ON comment.postedby = profile.serial
			WHERE post=".$prow['pserial'];
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
echo "<tr style=\"background-color: rgb(220, 220, 220);\"><td><img src=\"profileimages/pimg_".$row['serial'].".jpg\"/><a href=\"profile.php?profile=".$row['serial']."\">".$row['name']."</a><br/>".$row['comment']."<br/>posted at: ".$row['time']."</td></tr>";
}
?>
<form action="commentupdate.php" method="post">
<tr><td><textarea name="comment"></textarea></td></tr>
<tr><td><input type="Submit" value="Comment"></td></tr>
<input type="hidden" name="post" value="<?php echo $prow['pserial'];?>"/>
</form>
</table>
<hr/>
<?php
}
?>
<?php include('footer.php'); ?>
</body>
</html>