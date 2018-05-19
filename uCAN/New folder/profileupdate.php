<?php
/*	profileupdate.php
	*. Updates the current profile
*/
require('common.php');
$gender = cleanupvar($_POST['gender']);
$birthdate = strtotime($_POST['year'].'-'.$_POST['month'].'-'.$_POST['date']);
$email = cleanupvar($_POST['email']);
$phone = cleanupvar($_POST['phone']);
$nativetown = cleanupvar($_POST['nativetown']);
$schooling = cleanupvar($_POST['schooling']);
$interests = cleanupvar($_POST['interests']);
$music = cleanupvar($_POST['music']);
$books = cleanupvar($_POST['books']);
$sports = cleanupvar($_POST['sports']);
$quotes = cleanupvar($_POST['quotes']);

$query = "UPDATE profile SET email='".$email."', phone='".$phone."', nativetown='".$nativetown."', schooling='".$schooling."', interests='".$interests."', music='".$music."', books='".$books."', sports='".$sports."', quotes='".$quotes."', birthdate=".$birthdate.", gender='".$gender."' WHERE pid=".$_SESSION['pid'].";";

$result = mysql_query($query);
if($result)
{
	header('Location: profile.php');
}
else
{
	header('Location: profile.php');
}
?>