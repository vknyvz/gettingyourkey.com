<?php 
	require_once('_functions/php_data.php'); 

	if(!loggedIn() || !isset($_SESSION[$s_prefix.'street']) || !isset($_SESSION[$s_prefix.'city']) || !isset($_SESSION[$s_prefix.'state']) || !isset($_SESSION[$s_prefix.'zip']) || !isset($_SESSION[$s_prefix.'desc']) || !isset($_SESSION[$s_prefix.'bedroom']) || !isset($_SESSION[$s_prefix.'livingroom']) || !isset($_SESSION[$s_prefix.'kitchen']) || !isset($_SESSION[$s_prefix.'bathroom']) || !isset($_SESSION[$s_prefix.'price']) || !isset($_SESSION[$s_prefix.'area']) || !isset($_SESSION[$s_prefix.'type']) || !isset($_SESSION[$s_prefix.'listing']))
	{
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}
	
	$street = $_SESSION[$s_prefix.'street'];
	$city = $_SESSION[$s_prefix.'city'];
	$state = $_SESSION[$s_prefix.'state'];
	$zip = $_SESSION[$s_prefix.'zip'];
	$description = $_SESSION[$s_prefix.'desc'];
	$bedroom = $_SESSION[$s_prefix.'bedroom'];
	$livingroom = $_SESSION[$s_prefix.'livingroom'];
	$kitchen = $_SESSION[$s_prefix.'kitchen'];
	$bathroom = $_SESSION[$s_prefix.'bathroom'];
	$price = $_SESSION[$s_prefix.'price'];
	$area = floor($_SESSION[$s_prefix.'area']);
	$type = $_SESSION[$s_prefix.'type'];
	$listing = $_SESSION[$s_prefix.'listing'];
	
	$location = $city.', '.$state;
	$seller = $type;
	
	$submit = false;
	
	if(isset($_POST['submit']))
	{
		$submit = true;
		
		unset($_SESSION[$s_prefix.'street']);
		unset($_SESSION[$s_prefix.'city']);
		unset($_SESSION[$s_prefix.'state']);
		unset($_SESSION[$s_prefix.'zip']);
		unset($_SESSION[$s_prefix.'desc']);
		unset($_SESSION[$s_prefix.'bedroom']);
		unset($_SESSION[$s_prefix.'livingroom']);
		unset($_SESSION[$s_prefix.'kitchen']);
		unset($_SESSION[$s_prefix.'bathroom']);
		unset($_SESSION[$s_prefix.'price']);
		unset($_SESSION[$s_prefix.'area']);
		unset($_SESSION[$s_prefix.'type']);
		unset($_SESSION[$s_prefix.'listing']);
	
		unset($_POST);
		
		$_POST['street'] = $street;
		$_POST['city'] = $city;
		$_POST['state'] = $state;
		$_POST['zip'] = $zip;
		$_POST['description'] = $description;
		$_POST['bedroom'] = $bedroom;
		$_POST['livingroom'] = $livingroom;
		$_POST['kitchen'] = $kitchen;
		$_POST['bathroom'] = $bathroom;
		$_POST['price'] = $price;
		$_POST['area'] = $area;
		$_POST['type'] = $listing;
		$_POST['seller'] = $seller;
		$_POST['owner'] = $_SESSION[$s_prefix.'username'];
		$_POST['date'] = date("Y-m-d H:i:s");
		
		$id = insertDataIntoDatabase("listings", $_POST);
		
		mkdir("photos/".$id, 0777);
		
		if(isset($_SESSION[$s_prefix.'image0']) && file_exists("photos/temp/".$_SESSION[$s_prefix.'image0']))
		{
			$image0 = $_SESSION[$s_prefix.'image0'];
			unset($_SESSION[$s_prefix.'image0']);
			if(copy("photos/temp/".$image0, "photos/".$id."/thumb.jpg"))
				unlink("photos/temp/".$image0);
		}
		
		if(isset($_SESSION[$s_prefix.'image1']) && file_exists("photos/temp/".$_SESSION[$s_prefix.'image1']))
		{
			$image1 = $_SESSION[$s_prefix.'image1'];
			unset($_SESSION[$s_prefix.'image1']);
			if(copy("photos/temp/".$image1, "photos/".$id."/01.jpg"))
				unlink("photos/temp/".$image1);
		}
		
		if(isset($_SESSION[$s_prefix.'image2']) && file_exists("photos/temp/".$_SESSION[$s_prefix.'image2']))
		{
			$image2 = $_SESSION[$s_prefix.'image2'];
			unset($_SESSION[$s_prefix.'image2']);
			if(copy("photos/temp/".$image2, "photos/".$id."/02.jpg"))
				unlink("photos/temp/".$image2);
		}
		
		if(isset($_SESSION[$s_prefix.'image3']) && file_exists("photos/temp/".$_SESSION[$s_prefix.'image3']))
		{
			$image3 = $_SESSION[$s_prefix.'image3'];
			unset($_SESSION[$s_prefix.'image3']);
			if(copy("photos/temp/".$image3, "photos/".$id."/03.jpg"))
				unlink("photos/temp/".$image3);
		}
		
		if(isset($_SESSION[$s_prefix.'image4']) && file_exists("photos/temp/".$_SESSION[$s_prefix.'image4']))
		{
			$image4 = $_SESSION[$s_prefix.'image4'];
			unset($_SESSION[$s_prefix.'image4']);
			if(copy("photos/temp/".$image4, "photos/".$id."/04.jpg"))
				unlink("photos/temp/".$image4);
		}		
		
		decreaseCredits();
	}

	require_once('_includes/pre_header.php');
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content_wide">
            	<div class="min_height"></div>
				<?php					
					$sellerDescription = ( $type == "direct" ) ? "Direct Sale" : "Agent Sale";					
				?>
				
				<?php require_once('_includes/user_menu.php'); ?>
				
				<?php				
					if(!$submit)
					{
				?>
				
				<table class="listings" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top" rowspan="2">
							<?php echo '<div class="button"><img src="'.$siteRoot.'/_img/button_'.$seller.'.jpg" alt='.$sellerDescription.'" /></div><h1>'.$location.'</h1>'; ?>
							
							<div style="height: 10px;"></div>
							
							<div class="information">
								<div class="left" style="width: 90px;">Asking price:<br />Area:</div>
								<div class="left" style="width: 80px;"><?php echo '$'.$price.'<br />'.$area.' Sq. Ft.'; ?></div>
								<div class="left" style="width: 90px;">Bedroom:<br />Livingroom:</div>
								<div class="left" style="width: 25px;"><?php echo $bedroom.'<br />'.$livingroom; ?></div>
								<div class="left" style="width: 90px;">Kitchen:<br />Bathroom:</div>
								<div class="left" style="width: 20px;"><?php echo $kitchen.'<br />'.$bathroom; ?></div>
								<div class="clearer"></div>
							</div>
							
							<div class="description"><?php echo $description; ?></div>
						</td>
						<td valign="top" class="show">
							<img src="<?php echo $siteRoot; ?>/<?php echo $images[0]; ?>" name="show" />
						</td>
					</tr>
					<tr>
						<td valign="top" class="controls"><input type="button" value="<<" onClick="previous();" /><input type="button" value="Play / Pause" onClick="resume();" /><input type="button" value=">>" onClick="next();" /></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center; padding-top: 10px;">
							<form method="post" action="">
								<input type="button" value="Continue Editing" onClick="window.location.replace('<?php echo $siteRoot; ?>/submit.php');" />
								<br /><br />
								<input type="submit" value="Submit Listing" name="submit" />
							</form>
						</td>
					</tr>
				</table>
				
				<?php
					}
					else
					{
						$listing = mysql_fetch_assoc(getListing($id));
						$type = $listing['type'];
						$url = $siteRoot.'/detail.php?id='.$id;
			
						echo '<div style="text-align: center;">
						
						<h1>Your listing has been received.</h1><br /><br />It can now be accessed at the following url: <a href="'.$url.'">'.$url.'</a>. <br /><br />Your listing has been placed in the <a href="'.$siteRoot.'/listings.php?show='.$type.'">'.$type.'</a> category.
						</div>
						<div style="height: 200px;"></div>';
					}
				?>	
				
			</div>
			<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>