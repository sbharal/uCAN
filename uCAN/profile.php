<?php require('check.php'); ?>
<html>
<body>
<?php include('header.php'); ?>
<?php include('user.php'); ?>
<table>
<?php
require('database.php');
if(isset($_GET['profile']))	//if there is no profile option in URL, then use default logged in user by session or if some profile is mentioned then use that user's serial
{
	$serial = $_GET['profile'];
}
else
{
	$serial = $_SESSION['serial'];
}
$query = "SELECT * FROM profile WHERE serial=".$serial;
$result = mysql_query($query);
$row = mysql_fetch_array($result);
?>
<tr><td>Name: </td><td><?php echo $row['name'];?></td></tr>
<tr><td>Gender: </td><td><?php echo $row['gender'];?></td></tr>
<tr><td>Birthday: </td><td><?php echo $row['dob'];?></td></tr>
<tr><td>Languages: </td><td><?php echo $row['language'];?></td></tr>
<tr><td>Mobile No.: </td><td><?php echo $row['mobile'];?></td></tr>
<tr><td>Address: </td><td><?php echo $row['address'];?></td></tr>
<tr><td>E-mail Address: </td><td><?php echo $row['email'];?></td></tr>
</table>
<a href="editprofile.php">Edit your profile</a>
<?php include('footer.php'); ?>
</body>
</html>