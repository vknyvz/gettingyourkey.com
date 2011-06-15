<?php
	require_once ('../_functions/php_data.php');
	
	function fail($i)
	{
		if($i == 1)
		{
			echo '<html><head><script type="text/javascript">this.parent.document.getElementById(\'msg\').innerHTML = "<div style=\'color: #FF0000;\'>You must fill out all fields! Photos are not required.</div>";</script></head><body></body></html>';
			exit();
		}
		elseif($i == 2)
		{
			echo '<html><head><script type="text/javascript">this.parent.document.getElementById(\'msg\').innerHTML = "<div style=\'color: #FF0000;\'>Improper Zip Code.</div>";</script></head><body></body></html>';
			exit();
		}
		elseif($i == 3)
		{
			echo '<html><head><script type="text/javascript">this.parent.document.getElementById(\'msg\').innerHTML = "<div style=\'color: #FF0000;\'>Price must only contain numbers.</div>";</script></head><body></body></html>';
			exit();
		}
		elseif($i == 4)
		{
			echo '<html><head><script type="text/javascript">this.parent.document.getElementById(\'msg\').innerHTML = "<div style=\'color: #FF0000;\'>Only JPEG images are allowed!</div>";</script></head><body></body></html>';
			exit();
		}
		elseif($i == 5)
		{
			echo '<html><head><script type="text/javascript">this.parent.document.getElementById(\'msg\').innerHTML = "<div style=\'color: #FF0000;\'>Area must only contain numbers.</div>";</script></head><body></body></html>';
			exit();
		}
	}
	
	function success()
	{
		echo '<html><head><script type="text/javascript">this.parent.window.location.replace("../preview.php");</script></head><body></body></html>';
		exit();
	}
	
	function processFile($i)
	{		
		if($_FILES['image'.$i]['name'] != "")
		{
			if($_FILES['image'.$i]['type'] == "image/jpeg" || $_FILES['image'.$i]['type'] == "image/pjpeg")
			{
				global $s_prefix;
				$f_prefix = md5($s_prefix.' picture ');
			
				$pic = $_FILES['image'.$i]['tmp_name'];
				$src = imagecreatefromjpeg($pic);
				list($width, $height) = getimagesize($pic);
				
				if($height >= $width)
				{
					$newWidth = 300;
					$newHeight = 300 / ($width / $height);					
				}
				else
				{
					$newHeight = 200;
					$newWidth = 200 / ($height / $width);
				}
				
				$tmp = imagecreatetruecolor($newWidth, $newHeight);
				
				imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				
				//make sure there is no chance the filename will be repeated in another process (thus overwriting this file)
				$imageName = md5($_SESSION[$s_prefix.'username'].mktime()).$i.$f_prefix.".jpg";
				
				$file = "../photos/temp/".$imageName;
				
				$_SESSION[$s_prefix.'image'.$i] = $imageName;
				
				imagejpeg($tmp, $file, 100);
				
				//make the thumbnail from the first image
				if($i ==  1)
				{
					if($height >= $width)
					{
						$newWidth = 150;
						$newHeight = 150 / ($width / $height);					
					}
					else
					{
						$newHeight = 100;
						$newWidth = 100 / ($height / $width);
					}					
					
					$tmp = imagecreatetruecolor($newWidth, $newHeight);
				
					imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
					
					//make sure there is no chance the filename will be repeated in another process (thus overwriting this file)
					$imageName = md5($_SESSION[$s_prefix.'username'].mktime())."0".$f_prefix.".jpg";
					
					$file = "../photos/temp/".$imageName;
					
					$_SESSION[$s_prefix.'image0'] = $imageName;
					
					imagejpeg($tmp, $file, 100);
				}
				
				imagedestroy($src);
				imagedestroy($tmp);
			}
			else
			{
				fail(4);
				exit();
			}
		}		
	}
	
	if(!loggedIn())
		exit();
	
	if(!isset($_POST))
		exit();
	
	if(!isset($_POST['street']) || !isset($_POST['city']) || !isset($_POST['state']) || !isset($_POST['zip']) || !isset($_POST['desc']) || !isset($_POST['bedroom']) || !isset($_POST['livingroom']) || !isset($_POST['kitchen']) || !isset($_POST['bathroom']) || !isset($_POST['price']) || !isset($_POST['area']) || !isset($_POST['type']))
	{
		fail(1);
		exit();
	}
	
	$street = cleanInput($_POST['street']);
	$city = cleanInput($_POST['city']);
	$state = cleanInput($_POST['state']);
	$zip = cleanInput($_POST['zip']);
	$desc = cleanInput($_POST['desc']);
	$bedroom = cleanInput($_POST['bedroom']);
	$livingroom = cleanInput($_POST['livingroom']);
	$kitchen = cleanInput($_POST['kitchen']);
	$bathroom = cleanInput($_POST['bathroom']);
	$price = cleanInput($_POST['price']);
	$price = str_replace("$", "", $price);
	$area = cleanInput($_POST['area']);
	$listing = cleanInput($_POST['listing']);
	$type = (cleanInput($_POST['type']) == "agent") ? "agent" : "direct";
	
	if($street == "" || $city == "" || $state == "" || $zip == "" || $desc == "" || $bedroom == "" || $livingroom == "" || $kitchen == "" || $bathroom == "" || $price == "" || $area == "" || $type == "")
	{
		fail(1);
		exit();
	}
	
	if(ereg('[^0-9]', $zip) || strlen($zip) != 5)
	{
		fail(2);
		exit();
	}
	
	if(ereg('[^0-9]', $price))
	{
		fail(3);
		exit();
	}
	
	if(ereg('[^0-9]', $area))
	{
		fail(5);
		exit();
	}
	
	$_SESSION[$s_prefix.'street'] = $street;
	$_SESSION[$s_prefix.'city'] = $city;
	$_SESSION[$s_prefix.'state'] = $state;
	$_SESSION[$s_prefix.'zip'] = $zip;
	$_SESSION[$s_prefix.'desc'] = $desc;
	$_SESSION[$s_prefix.'bedroom'] = $bedroom;
	$_SESSION[$s_prefix.'livingroom'] = $livingroom;
	$_SESSION[$s_prefix.'kitchen'] = $kitchen;
	$_SESSION[$s_prefix.'bathroom'] = $bathroom;
	$_SESSION[$s_prefix.'price'] = $price;
	$_SESSION[$s_prefix.'area'] = $area;
	$_SESSION[$s_prefix.'type'] = $type;
	$_SESSION[$s_prefix.'listing'] = $listing;
	
	processFile(1);
	processFile(2);
	processFile(3);
	processFile(4);
	
	/*
	
	if($_FILES['image1']['type'] == "image/jpeg")
	{ 
		$pic = $_FILES['image1']['tmp_name'];
		$src = imagecreatefromjpeg($pic);
		list($width, $height) = getimagesize($pic);

		$newWidth = 300;
		$newHeight = 200; //($height/$width)*600;
		$tmp = imagecreatetruecolor($newWidth, $newHeight);
		
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		
		$file = "../photos/temp/".$f_prefix."01.jpg";
		
		imagejpeg($tmp, $file, 100);
		
		imagedestroy($src);
		imagedestroy($tmp);
		
	
//		copy($_FILES['image1']['tmp_name'], "../photos/temp/".$f_prefix."01.jpg");
	}
	else
	{
		fail(4);
		exit();
	}
	
	*/
	
	success();
?>