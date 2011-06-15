<?php 
	require_once('_functions/php_data.php'); 

	if(isset($_GET['id']))
	{
		$id = intval(cleanInput($_GET['id']));
		
		if(!checkExistance("listings", "listing_id", $id))
		{
			header ('Location: '.$siteRoot.'/index.php');
			exit();
		}
	}
	else
	{
		header ('Location: '.$siteRoot.'/index.php');
		exit();
	}
			
	require_once('_includes/pre_header.php');
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content_wide">
            	<div class="min_height"></div>
				<?php
					$listing = mysql_fetch_assoc(getListing($id));
					$location = $listing['city'].', '.$listing['state'];
					$description = $listing['description'];
					$seller = $listing['seller'];
					$sellerDescription = ( $seller == "direct" ) ? "Direct Sale" : "Agent Sale";		
					$price = $listing['price'];
					$area = floor($listing['area']);
					$bedroom = str_replace(".0", "", $listing['bedroom']);
					$livingroom = str_replace(".0", "", $listing['livingroom']);
					$kitchen = str_replace(".0", "", $listing['kitchen']);
					$bathroom = str_replace(".0", "", $listing['bathroom']);	
				?>
				
				<?php require_once('_includes/user_menu.php'); ?>
				
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
							<img src="<?php echo $siteRoot; ?>/photos/nia.jpg" name="show" />
						</td>
					</tr>
					<tr>
						<td valign="top" class="controls"><input type="button" value="<<" onClick="previous();" /><input type="button" value="Play / Pause" onClick="resume();" /><input type="button" value=">>" onClick="next();" />
                        <br /><br />
                        <?php
							echo	'
										<a href="'.$siteRoot.'/new_message.php?id='.$id.'">Message Seller</a>
									';
							if($admin)
							{
								echo	'
											<br /><br />
											<a href="'.$siteRoot.'/edit.php?id='.$id.'">Edit Listing</a>
										';
							}
						?>
                        
                        </td>
					</tr>
				</table>
			</div>
		<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>