<?php
require('check.php');
require('database.php');
?>
<html>
<body>
<?php include('header.php'); ?>
<?php include('user.php'); ?>
<h1 style="text-align:center; background-color: rgb(200,200,200);">Truba Online Magazine</h1>
<form action="updatemagazine.php" method="post">
<table>
<tr><td>Truba Magazine</td></tr>
<tr><td><textarea name="article"></textarea></td></tr>
<tr><td><input type="Submit" value="submit"></td></tr>
</table>
</form>
<hr/>
<?php
$query = "	SELECT magazine.serial mserial, magazine.content, magazine.time, profile.serial profserial, profile.name
			FROM magazine
			INNER JOIN profile
			ON magazine.postedby = profile.serial
			ORDER BY magazine.serial DESC";
		
$mresult = mysql_query($query);
while($mrow = mysql_fetch_array($mresult))
{
//start of one article
//every article will be in a separate table
?>
<table>
<tr style="background-color: rgb(180, 180, 200);"><td><img src="profileimages/pimg_<?php echo $mrow['profserial'];?>.jpg"/><?php echo "<a href=\"profile.php?profile=".$mrow['profserial']."\">".$mrow['name']."</a>";?>
<br/><?php echo $mrow['content'];?>
<br/><?php echo $mrow['time'];?></td></tr>
</table>
<hr/>
<?php
}
?>
<?php include('footer.php'); ?>
</body>
</html>