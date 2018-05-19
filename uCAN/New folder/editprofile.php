<?php
/*	editprofile.php
	*. Displays a user profile
*/
require('common.php');

	$profile = $_SESSION['pid'];
	$query = "SELECT * FROM profile WHERE pid = ".$profile.";";
	$result = mysql_query($query);
	if($result)
	{
		if(mysql_num_rows($result)==1)
		{
			$row = mysql_fetch_array($result);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>uCAN</title>
    <link rel="stylesheet" href="commonstyle.php"/>
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
			{	echo '<a href="notifications.php"><div class="nav">Notifications<div class="notifnum">'.count(explode("#*#", $notif)).'</div>
				</div></a>';
			}
			else
			{	echo '<a href="alerts.php"><div class="nav">Notifications</div></a>';
			}
			if(!empty($alert))
			{	echo '<a href="alerts.php"><div class="nav">Alerts<div class="notifnum">new</div></div></a>';
			}
			else
			{	echo '<a href="alerts.php"><div class="nav">Alerts</div></a>';
			}?>
			<a href="messages.php"><div class="nav">Messages</div></a>
			<a href="friends.php"><div class="nav">Friends</div></a>
			<a href="settings.php"><div class="nav">Settings</div></a>
		</div>
        <div id="midbar">
            <?php if($row){?>
			<div id="midbarpicture" style="text-align: center;position: relative;">
					<div>
					<form action="profileimgupload.php" method="POST" enctype="multipart/form-data" style="background-color: rgba(255,255,255, 0.7);position: absolute;left: 0px;top: 0px;padding: 2px;z-index: 5;margin:0 auto 0 auto;text-align: center;" id="uploaddp">
						<input type="button" id="uploadpic" class="ubutton" value="Edit Profile Picture"/>
						<input type="file" name="photofile" id="filebtn" size="0" style="display: none;" value="Edit Picture" class="ubutton"/>
					</form>
					</div>
					<script type="text/javascript">
					$('#uploadpic').click(function(){
						$('#filebtn').click();
					});
					$('#uploaddp').on('change',function(){
						$('#uploaddp').submit();
					});
					$('#uploaddp').ajaxForm({
						clearForm: true,
						success: function(data){
							$('#largedp').attr('src', 'profileimages/'+data);
							alert('Pic uploaded');
						}
						});
					</script>
					<img id="largedp" src="profileimages/pimg_<?php echo $row['pid']; ?>.jpg" alt="profile picture"/>
            </div>
			<div id="actionarea">
				<a href="profile.php?pid=<?php echo $row['pid']; ?>"><div id="name"><?php echo $row['fname'].' '.$row['lname'];?></div></a>
				<div id="profilemsg" style="background-color: #222;color: #ccc;box-shadow:0 0 3px #000;">Click on the fields to edit</div>
				<div>
					<div><?php 	if($row['rid']!='Faculty') {echo (($row['gender']=='F')?"She":"He").' is from '.$row['branch'].', '.$row['sem'].' semester';}
								else {echo ($row['gender']=='F')?"She":"He".' is a Faculty Member';}?></div>
					<div>Born on <?php echo date('jS F, Y', $row['birthdate']);?></div>
					<div>Has <?php echo count(explode("#*#", $row['friends']));?> friends</div>
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
<?php if($row){ ?>
<div id="stream" style="margin: 0 100px 0 100px;">
<form action="profileupdate.php" method="POST">
	<div class="page" id="info">
		<div class="property">
			<div class="pkey pkl">Basic Info</div>
			<div class="pval">
			<select name="gender" value="Female">
				<option value="F" <?php if($row['gender']== 'F'){ echo 'selected';}?>>Female</option>
				<option value="M" <?php if($row['gender']== 'M'){ echo 'selected';}?>>Male</option>
			</select>
			</div>
			<div class="pval">
			<select name="date">
				<?php for($i=1;$i<=31;$i++){echo '<option value="'.$i.'" '.((date('j',$row['birthdate'])==$i)?'selected':'').'>'.$i.'</option>';} ?>
			</select>
			<select name="month">
				<?php for($i=1;$i<=12;$i++){echo '<option value="'.$i.'" '.((date('F',$row['birthdate'])==$i)?'selected':'').'>'.$i.'</option>';} ?>
			</select>
			<select name="year">
				<?php for($i=2012;$i>=1900;$i--){echo '<option value=" '.$i.'"'.((date('Y',$row['birthdate'])==$i)?'selected':'').'>'.$i.'</option>';} ?>
			</select>
			</div>
		</div>
		<div class="property">
			<div class="pkey pkl">Email ID</div>
			<div class="pval"><input type="text" name="email" <?php echo (!empty($row['email']))?'value="'.$row['email'].'"':'placeholder="No info...click to edit"';?>/></div>
		</div>
		<div class="property">
			<div class="pkey pkr">Nativetown</div>
			<div class="pval"><input type="text" name="nativetown" <?php echo (!empty($row['nativetown']))?'value="'.$row['nativetown'].'"':'placeholder="No info...click to edit"';?>/></div>
		</div>
		<div class="property">
			<div class="pkey pkl">School</div>
			<div class="pval"><input type="text" name="schooling" <?php echo (!empty($row['schooling']))?'value="'.$row['schooling'].'"':'placeholder="No info...click to edit"';?>/></div>
		</div>
		<div class="property">
			<div class="pkey pkr">Interests</div>
			<div class="pval"><?php echo (!empty($row['interests']))?'<textarea name="interests" >'.$row['interests']:'<textarea name="interests" placeholder="No info...click to edit">';?></textarea></div>
		</div>
		<div class="property">
			<div class="pkey pkl">Music</div>
			<div class="pval"><?php echo (!empty($row['music']))?'<textarea name="music" >'.$row['music']:'<textarea name="music" placeholder="No info...click to edit">';?></textarea></div>
		</div>
		<div class="property">
			<div class="pkey pkr">Books</div>
			<div class="pval"><?php echo (!empty($row['books']))?'<textarea name="books" >'.$row['books']:'<textarea name="books" placeholder="No info...click to edit">';?></textarea></div>
		</div>
		<div class="property">
			<div class="pkey pkl">Sports</div>
			<div class="pval"><?php echo (!empty($row['sports']))?'<textarea name="sports" >'.$row['sports']:'<textarea name="sports" placeholder="No info...click to edit">';?></textarea></div>
		</div>
		<div class="property">
			<div class="pkey pkr">Quotes</div>
			<div class="pval"><?php echo (!empty($row['quotes']))?'<textarea name="quotes" >'.$row['quotes']:'<textarea name="quotes" placeholder="No info...click to edit">';?></textarea></div>
		</div>
		<div class="property">
			<div class="pkey pkl">Phone</div>
			<div class="pval"><input type="text" name="phone" <?php echo (!empty($row['phone']))?'value="'.$row['phone'].'"':'placeholder="No info...click to edit"';?>/></div>
		</div>
		<input type="submit" value="Save Profile"/>
	</form>
	</div>
	
</div>
<?php } ?>

<?php require('footer.php'); ?>
</body>
</html>