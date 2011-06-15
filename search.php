<?php 
	require_once('_functions/php_data.php'); 

	if(!isset($_POST['state']) || !isset($_POST['city']) || !isset($_POST['zip']) || !isset($_POST['price_min']) || !isset($_POST['price_max']) || !isset($_POST['bedroom']) || !isset($_POST['livingroom']) || !isset($_POST['kitchen']) || !isset($_POST['bathroom']) || !isset($_POST['keywords']))
	{
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}
	
	$data = search($_POST);	
		
	require_once('_includes/pre_header.php');
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content_wide">
				<?php require_once('_includes/user_menu.php'); ?>
				<div class="min_height"></div>
				<table class="listings" cellspacing="0" cellpadding="0">
				<?php
					if(mysql_num_rows($data) > 0)
					{
						while($listing = mysql_fetch_assoc($data))
						{
							$id = $listing['listing_id'];
							$location = $listing['city'].', '.$listing['state'];
							$description = $listing['description'];
							$seller = $listing['seller'];
							$sellerDescription = ( $seller == "direct" ) ? "Direct Sale" : "Agent Sale";		
									
							if(strlen($description) > 200)
							{
								$description = substr($description, 0, 228);
								$pos = strrpos($description, " ");
								$description = substr($description, 0, $pos).'... <a href="'.$siteRoot.'/detail.php?id='.$id.'">More</a>';
							}
							
							$area = floor($listing['area']);
							$bedroom = str_replace(".0", "", $listing['bedroom']);
							$livingroom = str_replace(".0", "", $listing['livingroom']);
							$kitchen = str_replace(".0", "", $listing['kitchen']);
							$bathroom = str_replace(".0", "", $listing['bathroom']);
							
							$file = 'photos/'.$id.'/thumb.jpg';
							
							if(!file_exists($file))
								$file = 'photos/nia_thumb.jpg';								
							
							echo	'
										<tr><td class="picture" valign="top" rowspan="3"><a href="'.$siteRoot.'/detail.php?id='.$id.'"><img src="'.$siteRoot.'/'.$file.'" alt="" /></a></td>
										<td class="location" valign="top"><div class="button"><img src="'.$siteRoot.'/_img/button_'.$seller.'.jpg" alt='.$sellerDescription.'" /></div><h1><a href="'.$siteRoot.'/detail.php?id='.$id.'">'.$location.'</a></h1></td>
										<td class="links" valign="top" rowspan="3"><a href="'.$siteRoot.'/detail.php?id='.$id.'">View Details</a><br /><a href="'.$siteRoot.'/messages.php?new&id='.$id.'">Message Seller</a></td></tr>
										<tr><td class="content" valign="top">'.$description.'</td></tr>
										<tr><td class="info" valign="top"><h5>'.$area.' Sq. Ft.</h5> Bedroom: '.$bedroom.' | Livingroom: '.$livingroom.' | Kitchen: '.$kitchen.' | Bathroom: '.$bathroom.'</td></tr>
									';
						}
						echo '<tr><td style="text-align: center; height: 100px;" colspan="3">';
						echo '</td></tr>';											
					}
					else
					{
						echo '<tr><td style="text-align: center; height: 200px;">No results have been found.</td></tr>';
					}
				?>
				</table>
			</div>
			<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>