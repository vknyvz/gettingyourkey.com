<?php 
	require_once('_functions/php_data.php'); 

	if(!loggedIn())
	{
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}
	
	if(isset($_SESSION[$s_prefix.'image0']))
		if(file_exists("photos/temp/".$_SESSION[$s_prefix.'image0']))
			unlink("photos/temp/".$_SESSION[$s_prefix.'image0']);
		
	if(isset($_SESSION[$s_prefix.'image1']))
		if(file_exists("photos/temp/".$_SESSION[$s_prefix.'image1']))
			unlink("photos/temp/".$_SESSION[$s_prefix.'image1']);
		
	if(isset($_SESSION[$s_prefix.'image2']))
		if(file_exists("photos/temp/".$_SESSION[$s_prefix.'image2']))
			unlink("photos/temp/".$_SESSION[$s_prefix.'image2']);
	
	if(isset($_SESSION[$s_prefix.'image3']))
		if(file_exists("photos/temp/".$_SESSION[$s_prefix.'image3']))
			unlink("photos/temp/".$_SESSION[$s_prefix.'image3']);
	
	if(isset($_SESSION[$s_prefix.'image4']))
		if(file_exists("photos/temp/".$_SESSION[$s_prefix.'image4']))
			unlink("photos/temp/".$_SESSION[$s_prefix.'image4']);
	

	require_once('_includes/pre_header.php'); 
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
			
			<div id="content_wide">
	            <div class="min_height"></div>
			
			<?php require_once('_includes/user_menu.php'); ?>
			
			<?php
				$user = mysql_fetch_assoc(getUser($_SESSION[$s_prefix.'username']));
			
				$credits = $user['credits'];
			
				echo '<div style="text-align: center;">';
			
				if($credits > 0)
				{
					echo 'You can submit <b>'.$credits.'</b> more listing(s).';
					echo '</div>';
			?>
			
					<div id="submit_form">
							<h1 style="padding-left: 2px;">New listing</h1>
							<form method="post" action="<?php echo $siteRoot; ?>/_scripts/_process_listing.php" target="process" enctype="multipart/form-data">
							<table class="listings" cellspacing="0" cellpadding="0">
								<tr>
									<td style="width: 70px;">Street:</td>
									<td><input type="text" name="street" value="<?php if(isset($_SESSION[$s_prefix.'street'])){echo $_SESSION[$s_prefix.'street'];} ?>" /></td>
									<td style="width: 70px;">City/Town:</td>
									<td><input type="text" name="city" value="<?php if(isset($_SESSION[$s_prefix.'city'])){echo $_SESSION[$s_prefix.'city'];} ?>" /></td>
								</tr>
								<tr>
									<td>State:</td>
									<td>
										<?php
											if(isset($_SESSION[$s_prefix.'state']))
												$state = $_SESSION[$s_prefix.'state'];
											else
												$state = "";
											
										?>
									<select name="state">
										<option <?php if($state == "Alabama"){echo ' selected="selected"'; } ?> value="Alabama">Alabama</option>
										<option <?php if($state == "Alaska"){echo ' selected="selected"'; } ?> value="Alaska">Alaska</option>
										<option <?php if($state == "Arizona"){echo ' selected="selected"'; } ?> value="Arizona">Arizona</option>
										<option <?php if($state == "Arkansas"){echo ' selected="selected"'; } ?> value="Arkansas">Arkansas</option>
										<option <?php if($state == "California"){echo ' selected="selected"'; } ?> value="California">California</option>
										<option <?php if($state == "Colorado"){echo ' selected="selected"'; } ?> value="Colorado">Colorado</option>
										<option <?php if($state == "Connecticut"){echo ' selected="selected"'; } ?> value="Connecticut">Connecticut</option>
										<option <?php if($state == "Delaware"){echo ' selected="selected"'; } ?> value="Delaware">Delaware</option>
										<option <?php if($state == "Florida"){echo ' selected="selected"'; } ?> value="Florida">Florida</option>
										<option <?php if($state == "Georgia"){echo ' selected="selected"'; } ?> value="Georgia">Georgia</option>
										
										<option <?php if($state == "Gawaii"){echo ' selected="selected"'; } ?> value="Gawaii">Hawaii</option>
										<option <?php if($state == "Idaho"){echo ' selected="selected"'; } ?> value="Idaho">Idaho</option>
										<option <?php if($state == "Illinois"){echo ' selected="selected"'; } ?> value="Illinois">Illinois</option>
										<option <?php if($state == "Indiana"){echo ' selected="selected"'; } ?> value="Indiana">Indiana</option>
										<option <?php if($state == "Iowa"){echo ' selected="selected"'; } ?> value="Iowa">Iowa</option>
										<option <?php if($state == "Kansas"){echo ' selected="selected"'; } ?> value="Kansas">Kansas</option>
										<option <?php if($state == "Kentucky"){echo ' selected="selected"'; } ?> value="Kentucky">Kentucky</option>
										<option <?php if($state == "Louisiana"){echo ' selected="selected"'; } ?> value="Louisiana">Louisiana</option>								
										<option <?php if($state == "Maine"){echo ' selected="selected"'; } ?> value="Maine">Maine</option>
										<option <?php if($state == "Maryland"){echo ' selected="selected"'; } ?> value="Maryland">Maryland</option>
										
										<option <?php if($state == "Massachusetts"){echo ' selected="selected"'; } ?> value="Massachusetts">Massachusetts</option>
										<option <?php if($state == "Michigan"){echo ' selected="selected"'; } ?> value="Michigan">Michigan</option>
										<option <?php if($state == "Minnesota"){echo ' selected="selected"'; } ?> value="Minnesota">Minnesota</option>
										<option <?php if($state == "Mississippi"){echo ' selected="selected"'; } ?> value="Mississippi">Mississippi</option>
										<option <?php if($state == "Missouri"){echo ' selected="selected"'; } ?> value="Missouri">Missouri</option>
										<option <?php if($state == "Montana"){echo ' selected="selected"'; } ?> value="Montana">Montana</option>
										<option <?php if($state == "Nebraska"){echo ' selected="selected"'; } ?> value="Nebraska">Nebraska</option>
										<option <?php if($state == "Nevada"){echo ' selected="selected"'; } ?> value="Nevada">Nevada</option>								
										<option <?php if($state == "New Hampshire"){echo ' selected="selected"'; } ?> value="New Hampshire">New Hampshire</option>
										<option <?php if($state == "New Jersey"){echo ' selected="selected"'; } ?> value="New Jersey">New Jersey</option>
										
										<option <?php if($state == "New Mexico"){echo ' selected="selected"'; } ?> value="New Mexico">New Mexico</option>
										<option <?php if($state == "New York"){echo ' selected="selected"'; } ?> value="New York">New York</option>
										<option <?php if($state == "North Carolina"){echo ' selected="selected"'; } ?> value="North Carolina">North Carolina</option>
										<option <?php if($state == "North Dakota"){echo ' selected="selected"'; } ?> value="North Dakota">North Dakota</option>
										<option <?php if($state == "Ohio"){echo ' selected="selected"'; } ?> value="Ohio">Ohio</option>
										<option <?php if($state == "Oklahoma"){echo ' selected="selected"'; } ?> value="Oklahoma">Oklahoma</option>
										<option <?php if($state == "Oregon"){echo ' selected="selected"'; } ?> value="Oregon">Oregon</option>
										<option <?php if($state == "Pennsylvania"){echo ' selected="selected"'; } ?> value="Pennsylvania">Pennsylvania</option>								
										<option <?php if($state == "Rhode Islan"){echo ' selected="selected"'; } ?> value="Rhode Island">Rhode Island</option>
										<option <?php if($state == "South Carolina"){echo ' selected="selected"'; } ?> value="South Carolina">South Carolina</option>
										
										<option <?php if($state == "South Dakota"){echo ' selected="selected"'; } ?> value="South Dakota">South Dakota</option>
										<option <?php if($state == "Tennessee"){echo ' selected="selected"'; } ?> value="Tennessee">Tennessee</option>
										<option <?php if($state == "Texas"){echo ' selected="selected"'; } ?> value="Texas">Texas</option>
										<option <?php if($state == "Utah"){echo ' selected="selected"'; } ?> value="Utah">Utah</option>
										<option <?php if($state == "Vermont"){echo ' selected="selected"'; } ?> value="Vermont">Vermont</option>
										<option <?php if($state == "Virginia"){echo ' selected="selected"'; } ?> value="Virginia">Virginia</option>								
										<option <?php if($state == "Washington"){echo ' selected="selected"'; } ?> value="Washington">Washington</option>
										<option <?php if($state == "West Virginia"){echo ' selected="selected"'; } ?> value="West Virginia">West Virginia</option>
										<option <?php if($state == "Wisconsin"){echo ' selected="selected"'; } ?> value="Wisconsin">Wisconsin</option>
										<option <?php if($state == "Wyoming"){echo ' selected="selected"'; } ?> value="Wyoming">Wyoming</option>
									</select>
									</td>
									<td>Zip Code:</td>
									<td><input type="text" name="zip" maxlength="5" value="<?php if(isset($_SESSION[$s_prefix.'zip'])){echo $_SESSION[$s_prefix.'zip'];} ?>" /></td>
								</tr>
								<tr>
									<td valign="top">Description:</td>
									<td colspan="3">
										<textarea id="desc" name="desc"><?php if(isset($_SESSION[$s_prefix.'desc'])){echo $_SESSION[$s_prefix.'desc'];} ?></textarea>
									</td>
								</tr>
							</table>
							
							<table class="listings" cellspacing="0" cellpadding="0">						
								<tr>
									<td style="width: 70px;">Price <div style="display: inline; padding-left: 25px;">$</div></td>
									<td style="width: 150px;"><input type="text" style="width: 80px;" name="price" value="<?php if(isset($_SESSION[$s_prefix.'price'])){echo $_SESSION[$s_prefix.'price'];} ?>" /> (USD)</td>
									<td style="width: 70px;">Bedroom</td>
									<td style="width: 70px;">
										<?php
											if(isset($_SESSION[$s_prefix.'bedroom']))
												$bedroom = $_SESSION[$s_prefix.'bedroom'];
											else
												$bedroom = "";
										?>
										
										<select name="bedroom" style="width: 50px;">
											<option <?php if($bedroom == 0){echo ' selected="selected"'; } ?>>0</option>
											<option <?php if($bedroom == 1){echo ' selected="selected"'; } ?>>1</option>
											<option <?php if($bedroom == 2){echo ' selected="selected"'; } ?>>2</option>
											<option <?php if($bedroom == 3){echo ' selected="selected"'; } ?>>3</option>
											<option <?php if($bedroom == 4){echo ' selected="selected"'; } ?>>4</option>
											<option <?php if($bedroom == 5){echo ' selected="selected"'; } ?>>5</option>
											<option <?php if($bedroom == 6){echo ' selected="selected"'; } ?>>6</option>
											<option <?php if($bedroom == 7){echo ' selected="selected"'; } ?>>7</option>
											<option <?php if($bedroom == 8){echo ' selected="selected"'; } ?>>8</option>
											<option <?php if($bedroom == 9){echo ' selected="selected"'; } ?>>9</option>
											<option <?php if($bedroom == "10+"){echo ' selected="selected"'; } ?>>10+</option>
										</select>
									</td>
									<td style="width: 70px;">Photo 1</td>
									<td><input type="file" name="image1" /></td>							
								</tr>
								<tr>
									<td>Area</td>
									<td><input type="text" style="width: 80px;" name="area" value="<?php if(isset($_SESSION[$s_prefix.'area'])){echo $_SESSION[$s_prefix.'area'];} ?>" /> (Sq. Ft.)</td>
									<td>Livingroom</td>
									<td>
										<?php
											if(isset($_SESSION[$s_prefix.'livingroom']))
												$livingroom = $_SESSION[$s_prefix.'livingroom'];
											else
												$livingroom = "";
										?>
										
										<select name="livingroom" style="width: 50px;">
											<option <?php if($livingroom == 0){echo ' selected="selected"'; } ?>>0</option>
											<option <?php if($livingroom == 1){echo ' selected="selected"'; } ?>>1</option>
											<option <?php if($livingroom == 2){echo ' selected="selected"'; } ?>>2</option>
											<option <?php if($livingroom == 3){echo ' selected="selected"'; } ?>>3</option>
											<option <?php if($livingroom == 4){echo ' selected="selected"'; } ?>>4</option>
											<option <?php if($livingroom == 5){echo ' selected="selected"'; } ?>>5</option>
											<option <?php if($livingroom == 6){echo ' selected="selected"'; } ?>>6</option>
											<option <?php if($livingroom == 7){echo ' selected="selected"'; } ?>>7</option>
											<option <?php if($livingroom == 8){echo ' selected="selected"'; } ?>>8</option>
											<option <?php if($livingroom == 9){echo ' selected="selected"'; } ?>>9</option>
											<option <?php if($livingroom == "10+"){echo ' selected="selected"'; } ?>>10+</option>
										</select>
									</td>
									<td style="width: 70px;">Photo 2</td>
									<td><input type="file" name="image2" /></td>							
								</tr>
								<tr>
									<td colspan="2" rowspan="2">
										Are you an agent or an individual? <br />
										
										<?php
											$agent = "";
											$individual = "";
										
											if(isset($_SESSION[$s_prefix.'type']))
											{
												if($_SESSION[$s_prefix.'type'] == "agent")
												{
													$agent = " checked ";
													$individual = "";
												}
												else
												{
													$agent = "";
													$individual = " checked ";
												}
											}
										?>
										
										<input type="radio" name="type" value="agent" style="width: 20px;" <?php echo $agent; ?> /> Agent 
										<input type="radio" name="type" value="direct" style="width: 20px;" <?php echo $individual; ?> /> Individual
									</td>							
									<td>Kitchen</td>
									<td>
										<?php
											if(isset($_SESSION[$s_prefix.'kitchen']))
												$kitchen = $_SESSION[$s_prefix.'kitchen'];
											else
												$kitchen = "";
										?>
										
										<select name="kitchen" style="width: 50px;">
											<option <?php if($kitchen == 0){echo ' selected="selected"'; } ?>>0</option>
											<option <?php if($kitchen == 1){echo ' selected="selected"'; } ?>>1</option>
											<option <?php if($kitchen == 2){echo ' selected="selected"'; } ?>>2</option>
											<option <?php if($kitchen == 3){echo ' selected="selected"'; } ?>>3</option>
											<option <?php if($kitchen == 4){echo ' selected="selected"'; } ?>>4</option>
											<option <?php if($kitchen == 5){echo ' selected="selected"'; } ?>>5</option>
											<option <?php if($kitchen == 6){echo ' selected="selected"'; } ?>>6</option>
											<option <?php if($kitchen == 7){echo ' selected="selected"'; } ?>>7</option>
											<option <?php if($kitchen == 8){echo ' selected="selected"'; } ?>>8</option>
											<option <?php if($kitchen == 9){echo ' selected="selected"'; } ?>>9</option>
											<option <?php if($kitchen == "10+"){echo ' selected="selected"'; } ?>>10+</option>
										</select>
									</td>
									<td style="width: 70px;">Photo 3</td>
									<td><input type="file" name="image3" /></td>							
								</tr>
								<tr>							
									<td>Bathroom</td>
									<td>
										<?php
											if(isset($_SESSION[$s_prefix.'bathroom']))
												$bathroom = $_SESSION[$s_prefix.'bathroom'];
											else
												$bathroom = "";
										?>
										<select name="bathroom" style="width: 50px;">
											<option <?php if($bathroom == 0){echo ' selected="selected"'; } ?>>0</option>
											<option <?php if($bathroom == 0.5){echo ' selected="selected"'; } ?>>0.5</option>
											<option <?php if($bathroom == 1){echo ' selected="selected"'; } ?>>1</option>
											<option <?php if($bathroom == 1.5){echo ' selected="selected"'; } ?>>1.5</option>
											<option <?php if($bathroom == 2){echo ' selected="selected"'; } ?>>2</option>
											<option <?php if($bathroom == 2.5){echo ' selected="selected"'; } ?>>2.5</option>
											<option <?php if($bathroom == 3){echo ' selected="selected"'; } ?>>3</option>
											<option <?php if($bathroom == 3.5){echo ' selected="selected"'; } ?>>3.5</option>
											<option <?php if($bathroom == 4){echo ' selected="selected"'; } ?>>4</option>
											<option <?php if($bathroom == 4.5){echo ' selected="selected"'; } ?>>4.5</option>
											<option <?php if($bathroom == "5+"){echo ' selected="selected"'; } ?>>5+</option>
										</select>
									</td>
									<td style="width: 70px;">Photo 4</td>
									<td><input type="file" name="image4" /></td>							
								</tr>	
								<tr>
									<td colspan="6">
										<?php
											if(isset($_SESSION[$s_prefix.'listing']))
												$listing = $_SESSION[$s_prefix.'listing'];
											else
												$listing = "";
										?>
									
										Which of the following best describes your listing?
										<select name="listing" style="width: 100px;">
											<option <?php if($listing == "apartment"){echo ' selected="selected"'; } ?>>apartment</option>
											<option <?php if($listing == "house"){echo ' selected="selected"'; } ?>>house</option>
											<option <?php if($listing == "loft"){echo ' selected="selected"'; } ?>>loft</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="6" style="text-align: center; padding: 30px;">
										<input type="submit" value="Preview Listing" style="width: 110px;" />
									</td>
								</tr>	
							</table>
                            	<input type="hidden" name="MAX_FILE_SIZE" value="25000" />
							</form>
							<div id="msg" style="text-align: center; font-size: 150%;"></div>
							<iframe name="process" style="border: 0; width: 0; height: 0;"></iframe>
						</div>
			
			<?php
				}
				else
				{
					echo 'You do not have sufficient credit in your account to submit a new listing. Please purchase more credit.';
					echo '</div><div style="height: 100px"></div>';
				}
				
			?>
			
			</div>
	
			<div class="clearer"></div>
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>