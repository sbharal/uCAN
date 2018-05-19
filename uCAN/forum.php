<?php
require('check.php');
require('database.php');
?>
<html>
<body>
<?php include('header.php'); ?>
<?php include('user.php'); ?>
<h1 style="text-align:center; background-color: rgb(200,200,200);">Truba Discussion Forum</h1>
<form action="updateforum.php" method="post">
<table>
<tr><td>Truba Discussion Forum</td></tr>
<tr><td><textarea name="queries"></textarea></td></tr>
<tr><td><input type="Submit" value="submit"></td></tr>
</table>
</form>
<hr/>
<?php
$query = "	SELECT forum.serial fserial, forum.query, forum.time, profile.serial profserial, profile.name
			FROM forum
			INNER JOIN profile
			ON forum.postedby = profile.serial
			ORDER BY forum.serial DESC";
		
$fresult = mysql_query($query);
while($frow = mysql_fetch_array($fresult))
{
//start of one queries
//every queries will be in a separate table
?>
<table>
<tr style="background-color: rgb(180, 180, 200);"><td><img src="profileimages/pimg_<?php echo $frow['profserial'];?>.jpg"/><?php echo "<a href=\"profile.php?profile=".$frow['profserial']."\">".$frow['name']."</a>";?>
<br/><?php echo $frow['query'];?>
<br/><?php echo $frow['time'];?></td></tr>
<?php
$query = "	SELECT profile.name, profile.serial, comment, time
			FROM forumcomment
			INNER JOIN profile
			ON forumcomment.postedby = profile.serial
			WHERE post=".$frow['fserial'];
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
echo "<tr style=\"background-color: rgb(220, 220, 220);\"><td><img src=\"profileimages/pimg_".$row['serial'].".jpg\"/><a href=\"profile.php?profile=".$row['serial']."\">".$row['name']."</a><br/>".$row['comment']."<br/>posted at: ".$row['time']."</td></tr>";
}
?>
<form action="forumcommentupdate.php" method="post">
<tr><td><textarea name="comment"></textarea></td></tr>
<tr><td><input type="Submit" value="Comment"></td></tr>
<input type="hidden" name="post" value="<?php echo $frow['fserial'];?>"/>
</form>
</table>
<hr/>
<?php
}
?>
<?php include('footer.php'); ?>
</body>
</html>