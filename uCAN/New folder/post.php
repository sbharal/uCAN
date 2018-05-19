<?php
require('sessdb.php');
if(is_numeric($_GET['postid']) && !is_null($_GET['postid']))
{
	$postid = $_GET['postid'];
}
require('getposts.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>uCAN</title>
	<link rel="stylesheet" href="commonstyle.php"/>
	<link rel="stylesheet" href="poststyle.php"/>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="ajax.js"></script>
</head>
<body>
<?php require('banner.php'); ?>
<?php getposts($postid); ?>
<?php require('footer.php'); ?>
</body>
</html>