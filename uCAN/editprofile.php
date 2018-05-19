<?php require('check.php'); ?>
<html>
<body>
<?php include('header.php'); ?>
<?php include('user.php'); ?>
<?php require('database.php');
$query = "SELECT * FROM profile WHERE serial=".$_SESSION['serial'];
$result = mysql_query($query);
$row = mysql_fetch_array($result);
?>

<table>
<tr><td colspan="2" align="center">Edit your profile</td></tr>
<tr><td>Your Profile Picture:</td><td><img src="profileimages/pimg_<?php echo $_SESSION['serial'];?>.jpg"/></td></tr>
<form action="profileimgupload.php" method="post" enctype="multipart/form-data">
<tr><td>Upload a new profile picture:</td><td><input type="file" name="photofile"/></td></tr>
<tr><td style="text-align: right;" colspan="2"><input type="submit" value="Upload Picture"/></td></tr>
</form>
<form action="updateprofile.php" method="post">
<tr><td>Gender:</td><td><input type="Radio" value="Male" name="gender" checked="checked">Male<input type="Radio" value="Female" name="gender">Female</td></tr>
<tr><td>Birthday: </td> <td><input type= "text" name="dob" value="<?php echo $row['dob'];?>"></td></tr>
<tr><td>Languages: </td><td><input type= "checkbox" name="english" value="English">English<input type= "checkbox" name="hindi" value="Hindi">Hindi</td></tr>
<tr><td>Mobile No.: </td><td><input type= "text" name="mobile" value="<?php echo $row['mobile'];?>"></td></tr>
<tr><td>Address: </td><td><input type= "text" name="address" value="<?php echo $row['address'];?>"></td></tr>
<tr><td>E-mail Address: </td><td><input type= "text" name="email" value="<?php echo $row['email'];?>"></td></tr>
</form>
</table>
<input type="Submit" name="Submit" value="Update">

<?php include('footer.php'); ?>
</body>
</html>