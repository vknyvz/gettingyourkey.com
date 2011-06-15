<?php 
	require_once('_functions/php_data.php'); 
			
	if(!loggedIn())
	{
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}
	
	if(isset($_POST['del']))
	{
		deleteListings($_POST);
		unset($_POST['del']);
		header('Location: '.$siteRoot.'/my.php');
		exit();
	}
	
	require_once('_includes/pre_header.php');
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content_wide">
            	<?php require_once('_includes/user_menu.php'); ?>
                        
                <div class="min_height"></div>
                <div style="text-align: center; padding-bottom: 20px;"><h1>My listings</h1></div>
				<table class="general" cellspacing="0" cellpadding="0">                	
                    <?php
						$data = getMyListings();
						
						if(mysql_num_rows($data) > 0)						
						{
							echo	'
										<form method="post" action="" onSubmit="return checkDel(this);">
											<input type="hidden" name="del" />
											<tr>
												<td class="top" style="width: 150px;">&nbsp;</td>
												<td class="top" style="width: 50px;">ID</td>
												<td class="top" style="width: 90px;">Date Posted</td>
												<td class="top">&nbsp;</td>
												<td class="top" style="width: 100px;">&nbsp;</td>
												<td class="top" style="width: 50px;">&nbsp;</td>
											</tr>
									';
						
							while($listing = mysql_fetch_assoc($data))
							{
								echo	'
											<tr>
												<td class="odd">
													<a href="'.$siteRoot.'/detail.php?id='.$listing['listing_id'].'"><img src="'.$siteRoot.'/photos/'.$listing['listing_id'].'/thumb.jpg" /></a>
												</td>
												<td class="even">'.$listing['listing_id'].'</td>
												<td class="odd">'.formatDate($listing['date']).'</td>
												<td class="even" valign="top" style="text-align: left;">
													Street: <strong>'.$listing['street'].'</strong><br />
													City: <strong>'.$listing['city'].'</strong><br />
													State: <strong>'.$listing['state'].'</strong><br />
													Zip Code: <strong>'.$listing['zip'].'</strong>
												</td>
												<td class="odd"><a href="'.$siteRoot.'/edit.php?id='.$listing['listing_id'].'">Edit Listing</a></td>
												<td class="even"><input type="checkbox" name="ids[]" value="'.$listing['listing_id'].'" /></td>
											</tr>
										';
							}
							
							echo	'
										<tr>
											<td colspan="6" class="top" style="text-align: right;">
												<input type="submit" value="Delete checked listings" />
											</td>
										</tr>
										</form>
									';
						}
						else
						{
							echo	'
										<div style="text-align: center;">You have not posted any listings.</div>
									';
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