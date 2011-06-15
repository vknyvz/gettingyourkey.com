<?php 
	require_once('_functions/php_data.php'); 
			
	if(!loggedIn() || !isset($_GET['id']))
	{
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}
	
	$id = cleanInput(intval($_GET['id']));
	$listing = mysql_fetch_assoc(getListing($id));
	
	if(!$admin && $listing['owner'] != $_SESSION[$s_prefix.'username'])
	{
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}
	
	if(isset($_POST['delete']) && $admin && isset($_POST['ids']))
	{	
		deleteListings($_POST);
		$_SESSION[$s_prefix.'message'] = "The listing has been deleted.";
		header('Location: '.$siteRoot.'/edit.php?id='.$id);
		exit();
	}
	
	if(isset($_POST['submit']))
	{
		$street = cleanInput($_POST['street']);
		$city = cleanInput($_POST['city']);
		$state = cleanInput($_POST['state']);
		$zip = cleanInput($_POST['zip']);
		$bedroom = cleanInput($_POST['bedroom']);
		$livingroom = cleanInput($_POST['livingroom']);
		$kitchen = cleanInput($_POST['kitchen']);
		$bathroom = cleanInput($_POST['bathroom']);
		$area = cleanInput($_POST['area']);
		$price = cleanInput($_POST['price']);
		$description = cleanInput($_POST['description']);
		$type = cleanInput($_POST['type']);
		$seller = cleanInput($_POST['seller']);
		
		unset($_POST);
		
		if($street == "" || $city == "" || $state == "" || $zip == "" || $bedroom == "" || $kitchen == "" || $livingroom == "" || $bathroom == "" || $area == "" || $price == "" || $description == "" || $type == "" || $seller == "")
		{
			$_SESSION[$s_prefix.'message'] = '<div style="color: #FF0000;">You must fill out all fields.</div>';
			header('Location: '.$siteRoot.'/edit.php?id='.$id);
			exit();
		}
		
		if(ereg('[^0-9]', $zip) || strlen($zip) != 5)
		{
			$_SESSION[$s_prefix.'message'] = '<div style="color: #FF0000;">Improper zip code.</div>';
			header('Location: '.$siteRoot.'/edit.php?id='.$id);
			echo $_POST['zip'].'test';
			exit();
		}
		
		if(ereg('[^0-9]', $price))
		{
			$_SESSION[$s_prefix.'message'] = '<div style="color: #FF0000;">Price must only contain numbers.</div>';
			header('Location: '.$siteRoot.'/edit.php?id='.$id);
			echo $_POST['zip'].'test';
			exit();
		}
		
		if(ereg('[^0-9]', $area))
		{
			$_SESSION[$s_prefix.'message'] = '<div style="color: #FF0000;">Area must only contain numbers.</div>';
			header('Location: '.$siteRoot.'/edit.php?id='.$id);
			echo $_POST['zip'].'test';
			exit();
		}
		
		$_POST['street'] = $street;
		$_POST['city'] = $city;
		$_POST['state'] = $state;
		$_POST['zip'] = $zip;
		$_POST['bedroom'] = $bedroom;
		$_POST['livingroom'] = $livingroom;
		$_POST['kitchen'] = $kitchen;
		$_POST['bathroom'] = $bathroom;
		$_POST['area'] = $area;
		$_POST['price'] = $price;
		$_POST['description'] = $description;
		$_POST['type'] = $type;
		$_POST['seller'] = $seller;
	
		updateDataInsideDatabase("listings", "listing_id", $id, $_POST);		
		
		$_SESSION[$s_prefix.'message'] = '<div style="color: #1fa700;">Your changes have been made.</div>';
		header('Location: '.$siteRoot.'/edit.php?id='.$id);
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
                <div style="text-align: center; padding: 10px; font-weight: bold;">
					<?php
                		if(isset($_SESSION[$s_prefix.'message']))
						{
							echo $_SESSION[$s_prefix.'message'];
							unset($_SESSION[$s_prefix.'message']);
						}
					?>
                </div>
				<table class="general" cellspacing="0" cellpadding="0">   
                <form method="post" action="">
                <?php
					$street = $listing['street'];
					$city = $listing['city'];
					$state = $listing['state'];
					$zip = $listing['zip'];
					$bedroom = str_replace(".0", "", $listing['bedroom']);
					$livingroom = str_replace(".0", "", $listing['livingroom']);
					$kitchen = str_replace(".0", "", $listing['kitchen']);
					$bathroom = str_replace(".0", "", $listing['bathroom']); 
					$area = floor($listing['area']); 
					$price = $listing['price'];
					$description = $listing['description'];
					$type = $listing['type'];
					$seller = $listing['seller'];
					$sellerDescription = ( $seller == "direct" ) ? "Direct Sale" : "Agent Sale";
					
					$agent = "";
					$individual = "";				

					if($seller == "agent")
					{
						$agent = " checked ";
						$individual = "";
					}
					else
					{
						$agent = "";
						$individual = " checked ";
					}

				?>					
                    <tr>
                        <td class="top" style="width: 100px;">&nbsp;</td>
                        <td class="top" style="width: 250px;">Current</td>
                        <td class="top">New</td>
                    </tr>
                    <tr>
                        <td class="top">Street</td>
                        <td class="even"><?php echo $street; ?></td>
                        <td class="even"><input type="text" class="edit" name="street" value="<?php echo $street; ?>" maxlength="100" /></td>
                    </tr>
                     <tr>
                        <td class="top">City</td>
                        <td class="even"><?php echo $city; ?></td>
                        <td class="even"><input type="text" class="edit" name="city" value="<?php echo $city; ?>" maxlength="100" /></td>
                    </tr>
                     <tr>
                        <td class="top">State</td>
                        <td class="even"><?php echo $state; ?></td>
                        <td class="even">
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
                    </tr>
                     <tr>
                        <td class="top">Zip Code</td>
                        <td class="even"><?php echo $zip; ?></td>
                        <td class="even"><input type="text" class="edit" name="zip" value="<?php echo $zip; ?>" maxlength="5" /></td>
                    </tr>
                     <tr>
                        <td class="top">Bedroom</td>
                        <td class="even"><?php echo $bedroom; ?></td>
                        <td class="even">
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
                    </tr>
                     <tr>
                        <td class="top">Livingroom</td>
                        <td class="even"><?php echo $livingroom; ?></td>
                        <td class="even">
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
                    </tr>
                     <tr>
                        <td class="top">Kitchen</td>
                        <td class="even"><?php echo $kitchen; ?></td>
                        <td class="even">
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
                    </tr>
                     <tr>
                        <td class="top">Bathroom</td>
                        <td class="even"><?php echo $bathroom; ?></td>
                        <td class="even">
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
                    </tr>
                     <tr>
                        <td class="top">Area</td>
                        <td class="even"><?php echo $area; ?> Sq. Ft.</td>
                        <td class="even"><input type="text" class="edit" name="area" value="<?php echo $area; ?>" maxlength="15" /></td>
                    </tr>
                     <tr>
                        <td class="top">Price</td>
                        <td class="even">$ <?php echo $price; ?> USD</td>
                        <td class="even"><input type="text" class="edit" name="price" value="<?php echo $price; ?>" maxlength="20" /></td>
                    </tr>
                     <tr>
                        <td class="top" valign="top">Description</td>
                        <td class="even" valign="top" style="text-align: justify;"><?php echo $description; ?></td>
                        <td class="even" valign="top"><textarea name="description" id="description" class="edit"><?php echo $description; ?></textarea></td>
                    </tr>
                     <tr>
                        <td class="top">Type</td>
                        <td class="even"><?php echo $type; ?></td>
                        <td class="even">
                        	<select name="type" style="width: 100px;">
                                <option <?php if($type == "apartment"){echo ' selected="selected"'; } ?>>apartment</option>
                                <option <?php if($type == "house"){echo ' selected="selected"'; } ?>>house</option>
                                <option <?php if($type == "loft"){echo ' selected="selected"'; } ?>>loft</option>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <td class="top">&nbsp;</td>
                        <td class="even"><?php echo $sellerDescription; ?></td>
                        <td class="even">
                        	<input type="radio" name="seller" value="agent" style="width: 20px;" <?php echo $agent; ?> /> Agent 
                            <input type="radio" name="seller" value="direct" style="width: 20px;" <?php echo $individual; ?> /> Individual
                        </td>
                    </tr>
                    <tr>
                    <?php
						if($admin)
						{
					?>		
                        <td class="top" colspan="2">
                            	<input type="submit" name="submit" value="Update listing" />
                            </form>
                        </td>
                        <td class="top">
                            <form method="post" action="" onsubmit="return checkDel(this);">
                            	<input type="hidden" name="ids[]" value="<?php echo $listing['listing_id']; ?>" />
                            	<input type="submit" name="delete" value="Delete listing" />	
                            </form>
                        </td>
                    <?php
						}
						else
						{
					?>
                    	<td class="top" colspan="3">
                            	<input type="submit" name="submit" value="Update listing" />
                            </form>
                        </td>
                    <?php
						}
					?>
                    </tr>
               
                </table>                
			</div>
			<div class="clearer"></div>			
		</div>
        
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>