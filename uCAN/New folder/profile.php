<?php
/*	profile.php
	*. Displays a user profile
*/
require('common.php');

	$profile = (empty($_GET['profile']) || !isset($_GET['profile']) || !is_numeric($_GET['profile']))?$_SESSION['pid']:$_GET['profile'];
	$query = "SELECT * FROM profile WHERE pid = ".$profile.";";
	$result = mysql_query($query);
	if($result)
	{
		if(mysql_num_rows($result)==1)
		{
			$prow = mysql_fetch_array($result);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>uCAN</title>
    <link rel="stylesheet" href="commonstyle.php"/>
	<link rel="stylesheet" href="poststyle.php"/>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="ajax.js"></script>
	<script type="text/javascript" src="jquery.form.js"></script>
</head>
<body>
<?php require('banner.php'); ?>
<div id="main">
        <div id="leftbar">
			<a href="profile.php"><div class="nav">Profile</div></a>
			<a href="magazine.php"><div class="nav">Magazine</div></a>
			<a href="college.php"><div class="nav">College</div></a>
			<a href="forum.php"><div class="nav">Forum</div></a>
			<a href="photos.php"><div class="nav">My Photos</div></a>
		</div>
        <div id="rightbar">
			<?php
			list($notif, $alert) = notifalert();
			if(!empty($notif))
			{	echo '<a href="notifications.php"><div class="nav" id="notif">Notifications<div class="notifnum">'.count(explode("#*#", $notif)).'</div>
				</div></a>';
			}
			else
			{	echo '<a href="alerts.php"><div class="nav" id="notif">Notifications</div></a>';
			}
			if(!empty($alert))
			{	echo '<a href="alerts.php"><div class="nav" id="alert">Alerts<div class="notifnum">new</div></div></a>';
			}
			else
			{	echo '<a href="alerts.php"><div class="nav" id="alert">Alerts</div></a>';
			}?>
			<a href="messages.php"><div class="nav">Messages</div></a>
			<a href="friends.php"><div class="nav">Friends</div></a>
			<a href="settings.php"><div class="nav">Settings</div></a>
		</div>
        <div id="midbar">
            <?php if($prow){?>
			<div id="midbarpicture" style="text-align: center;">
					<img id="largedp" src="profileimages/pimg_<?php echo $prow['pid']; ?>.jpg" alt="profile picture"/>
            </div>
			<div id="actionarea">
				<form action="addfriend.php" method="POST" id="friendform" style="float: right;margin-right: 20px;margin-top: 20px;">
					<input type="hidden" name="sid" value="<?php echo $prow['pid'];?>"/>
					<input type="submit" value="Add as Friend" class="ubutton" style="font-size: 20px;"/>
				</form>
				<script type="text/javascript">$('#friendform').ajaxForm({success: function(data, status, xhr, z){alert(data);}});</script>
				<a href="profile.php?pid=<?php echo $prow['pid']; ?>"><div id="name"><?php echo $prow['fname'].' '.$prow['lname'];?></div></a>
				<?php
				if($profile == $_SESSION['pid'])
				echo '<a href="editprofile.php"><div>Edit your profile</div></a>';
				?>
				<div>
					<div><?php 	if($prow['rid']!='Faculty') {echo (($prow['gender']=='F')?"She":"He").' is from '.$prow['branch'].', '.$prow['sem'].' semester';}
								else {echo (($prow['gender']=='F')?"She":"He").' is a Faculty Member';}?></div>
					<div>Born on <?php echo date('jS F, Y', $prow['birthdate']);?></div>
					<div>Has <?php echo count(explode("#*#", $prow['friends']));?> friends</div>
				</div>
				<div id="options">
					<div class="option" onclick="$('#posts').fadeOut('fast');$('#info').fadeIn('fast')">View Info</div>
					<div class="option" onclick="$('#info').fadeOut('fast');$('#posts').fadeIn('fast')">View Posts</div>
				</div>
			</div>
			<?php }
			else
			{
				echo '<br/><br/><div class="nav"></div><div class="nav" style="vertical-align: middle;">No such profile found!</div><div class="nav"></div>';
			}?>
        </div>
</div>
<hr/>
<?php if($prow){ ?>
<div id="stream" style="margin: 0 100px 0 100px;">
	<div class="page" id="posts" style="display: none;">
		<?php
			include('getposts.php');
			include('getphotos.php');
			$query = "	SELECT * FROM (
							SELECT post.postid 'id', post.stamp, 'post' FROM post WHERE pid = ".$profile."
							UNION
							SELECT photo.photoid 'id', photo.stamp, 'photo' FROM photo WHERE pid = ".$profile."
							) a  ORDER BY a.stamp DESC LIMIT 0, 5";
				$result = mysql_query($query);
				while($row = mysql_fetch_array($result))
				{
					if($row['post']=='post')
						getposts($row['id']);
					if($row['post']=='photo')
						getphotos($row['id']);
				}
		?>
	</div>
	<div class="page" id="info">
		<div class="property">
			<div class="pkey pkl">Email ID</div>
			<div class="pval"><?php echo $prow['email'].(!empty($prow['email']))?$prow['email']:' No info to show';?></div>
		</div>
		<div class="property">
			<div class="pkey pkr">Nativetown</div>
			<div class="pval"><?php echo (!empty($prow['nativetown']))?$prow['nativetown']:' No info to show';?></div>
		</div>
		<div class="property">
			<div class="pkey pkl">School</div>
			<div class="pval"><?php echo (!empty($prow['schooling']))?$prow['schooling']:' No info to show';?></div>
		</div>
		<div class="property">
			<div class="pkey pkr">Interests</div>
			<div class="pval"><?php echo (!empty($prow['interests']))?$prow['interests']:' No info to show';?></div>
		</div>
		<div class="property">
			<div class="pkey pkl">Music</div>
			<div class="pval"><?php echo (!empty($prow['music']))?$prow['music']:' No info to show';?></div>
		</div>
		<div class="property">
			<div class="pkey pkr">Books</div>
			<div class="pval"><?php echo (!empty($prow['books']))?$prow['books']:' No info to show';?></div>
		</div>
		<div class="property">
			<div class="pkey pkl">Sports</div>
			<div class="pval"><?php echo (!empty($prow['sports']))?$prow['sports']:' No info to show';?></div>
		</div>
		<div class="property">
			<div class="pkey pkr">Quotes</div>
			<div class="pval"><?php echo (!empty($prow['quotes']))?$prow['quotes']:' No info to show';?></div>
		</div>
		<div class="property">
			<div class="pkey pkl">Phone</div>
			<div class="pval"><?php echo (!empty($prow['phone']))?$prow['phone']:' No info to show';?></div>
		</div>
	</div>
	
</div>
<?php } ?>

<?php require('footer.php'); ?>
</body>
</html>