<?php
/*	profileimgupload.php
	*. Uploads the profile picture
*/
session_start();
if(!$_POST['photofile']['error']>0) //check if no error has occured
		{
			$name = $_FILES['photofile']['name'];	//get the original name of the file
			
			list($width, $height, $type, $attr) = getimagesize($_FILES['photofile']['tmp_name']);	//capture all properties
			
			//get the file type and create a temporary image
			switch($type)
			{
			case IMAGETYPE_JPEG:
				$img = imagecreatefromjpeg($_FILES['photofile']['tmp_name']);
				$name = substr($name, 0, (strlen($name)-5));
				break;
			case IMAGETYPE_JPG:
				$img = imagecreatefromjpeg($_FILES['photofile']['tmp_name']);
				$name = substr($name, 0, (strlen($name)-4));
				break;
			case IMAGETYPE_GIF:
				$img = imagecreatefromgif($_FILES['photofile']['tmp_name']);
				$name = substr($name, 0, (strlen($name)-4));
				break;
			case IMAGETYPE_PNG:
				$img = imagecreatefrompng($_FILES['photofile']['tmp_name']);
				$name = substr($name, 0, (strlen($name)-4));
				break;
			default:
				exit; break;
			}
			
			if(strlen($_FILES['photofile']['name'])>10)	//if the length of the name of the original image is larger than 
			{	$name = substr($_FILES['photofile']['name'], 0, 10);	}
			
			$maxsize = 100;
			if($height>$maxsize || $width>$maxsize)	 //if either height or width exceeds the limits of maxsize px,
			{
				if($width>$height)	//if width is dominant,
				{
					$ratio = $height/$width;
					$newwidth = $maxsize;
					$newheight = $ratio*$maxsize;
				}
				else				//if height is more dominant,
				{
					$ratio = $width/$height;
					$newheight = $maxsize;
					$newwidth = $ratio*$maxsize;
				}
			}
			else
			{	//if no problem, put the new properties equal to the old
				$newwidth = $width;
				$newheight = $height;
			}
			
			$newimg = imagecreatetruecolor($newwidth, $newheight);									//create a blank image
			imagecopyresampled($newimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);	//resample image and put into the newimg object
			//saving the file
			$perm_name = 'pimg_'.$_SESSION['serial'].'.jpg';				//choosing the permanent name
			imagejpeg($newimg, "profileimages/".$perm_name, 100);	//save the new jpeg image
			echo $perm_name;
		}
header('Location: editprofile.php');
?>