<?php
	require_once('_functions/php_data.php'); 
	
	if(isset($_GET['logout']))
	{
		session_destroy();
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username = cleanInput($_POST['username']);
		$password = cleanInput($_POST['password']);
		
		if(verifyLogin($username, md5($password)))
		{
			$_SESSION[$s_prefix.'username'] = $username;
			header('Location: '.$siteRoot.'/index.php');
			exit();
		}
	}

	if(isset($_POST['submit']))
	{
		if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['listing']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['postal_code']) && isset($_POST['country']))
		{
			$first_name = cleanInput($_POST['first_name']);
			$last_name = cleanInput($_POST['last_name']);
			$username = cleanInput($_POST['username']);
			$email = cleanInput($_POST['email']);
			$password1 = cleanInput($_POST['password1']);
			$password2 = cleanInput($_POST['password2']);
			$listing = cleanInput(intval($_POST['listing']));
			
			$street = cleanInput($_POST['street']);
			$city = cleanInput($_POST['city']);
			$state = cleanInput($_POST['state']);
			$postal_code = cleanInput($_POST['postal_code']);
			$country = cleanInput($_POST['country']);
			
			if($first_name != "" && $last_name != "" && $username != "" && $email != "" && $password1 != "" && $password2 != "" && $listing != "" && $street != "" && $city != "" && $state != "" && $postal_code != "" && $country != "")
			{
				if(strlen($first_name) <= 50)
				{
					if(strlen($last_name) <= 50)
					{
						if( !preg_match('/[^a-z0-9]/i', $username) )
						{
							if(!checkExistance("users", "username", $username))
							{
								if(!checkExistance("users", "email", $email))
								{
									if($password1 == $password2)
									{
										$_SESSION[$s_prefix.'reg_first_name'] = $first_name;
										$_SESSION[$s_prefix.'reg_last_name'] = $last_name;
										$_SESSION[$s_prefix.'reg_username'] = $username;
										$_SESSION[$s_prefix.'reg_email'] = $email;
										$_SESSION[$s_prefix.'reg_password'] = md5($password1);
										$_SESSION[$s_prefix.'reg_credits'] = $listing;
										$_SESSION[$s_prefix.'reg_messages'] = ($listing * getParameter("messages_limit"));
										
										$_SESSION[$s_prefix.'reg_street'] = $street;
										$_SESSION[$s_prefix.'reg_city'] = $city;
										$_SESSION[$s_prefix.'reg_state'] = $state;
										$_SESSION[$s_prefix.'reg_postal_code'] = $postal_code;
										$_SESSION[$s_prefix.'reg_country'] = $country;
									
										unset($_POST);
									
										header('Location: '.$siteRoot.'/register2.php');
										exit();
										/*
										unset($_POST);
																				
										$_POST['first_name'] = $first_name;
										$_POST['last_name'] = $last_name;
										$_POST['username'] = $username;
										$_POST['email'] = $email;
										$_POST['password'] = md5($password1);
										$_POST['credits'] = $listing;
										$_POST['messages'] = ($listting * getParameter("messages_limit"));
										
										insertDataIntoDatabase("users", $_POST);
										$_SESSION[$s_prefix.'username'] = $username;
										header('Location: '.$siteRoot.'/index.php');
										exit();
										*/
									}
									else
										$_SESSION[$s_prefix.'message'] = "Entered passwords do not match.";
								}
								else
									$_SESSION[$s_prefix.'message'] = "The email you selected is already in use.";
							}
							else
								$_SESSION[$s_prefix.'message'] = "The username you selected is already in use.";
						}
						else
							$_SESSION[$s_prefix.'message'] = "Username can only contain letters and numbers.";					
					}
					else
						$_SESSION[$s_prefix.'message'] = "You have entered too much information for your last name.";
				}
				else
					$_SESSION[$s_prefix.'message'] = "You have entered too much information for your first name.";
			}
			else
				$_SESSION[$s_prefix.'message'] = "You must fill out all fields.";
		}
		else
			$_SESSION[$s_prefix.'message'] = "You must fill out all fields.";
	}

	require_once('_includes/pre_header.php'); 
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content" style="padding-top: 0;">
				<div class="min_height"></div>    
                <div style="text-align: center; padding: 10px; font-weight: bold; color: #FF0000;">
					<?php
                    	if(isset($_SESSION[$s_prefix.'message']))
						{
							echo $_SESSION[$s_prefix.'message'];
							unset($_SESSION[$s_prefix.'message']);
						}
					?>
                	</div>
                <?php
					if(!isset($_POST['decision']))
					{
				?>
                <div id="register_form">
                    <h1>New user registration</h1>
                    <form method="post" action="">
                    <table class="listings" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="width: 150px;">First Name:</td>
                            <td><input type="text" class="register" maxlength="50" name="first_name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Last Name:</td>
                            <td><input type="text" class="register" maxlength="50" name="last_name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Street Address:</td>
                            <td><input type="text" class="register" maxlength="60" name="street" value="<?php if(isset($_POST['street'])){echo $_POST['street'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">City:</td>
                            <td><input type="text" class="register" maxlength="50" name="city" value="<?php if(isset($_POST['city'])){echo $_POST['city'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">State:</td>
                            <td><input type="text" class="register" maxlength="50" name="state" value="<?php if(isset($_POST['state'])){echo $_POST['state'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Postal Code:</td>
                            <td><input type="text" class="register" maxlength="50" name="postal_code" value="<?php if(isset($_POST['postal_code'])){echo $_POST['postal_code'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Country:</td>
                            <td><input type="text" class="register" maxlength="50" name="country" value="<?php if(isset($_POST['country'])){echo $_POST['country'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Username:</td>
                            <td><input type="text" class="register" maxlength="30" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Email</td>
                            <td><input type="text" class="register" maxlength="200" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Password:</td>
                            <td><input type="password" class="register" name="password1" /></td>
                        </tr> 
                        <tr>
                            <td style="width: 100px;">Password (again):</td>
                            <td><input type="password" class="register" name="password2" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">How many listings will you be placing?</td>
                            <td>
                            	<select name="listing">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select> If placing 5 or more listings, please contact us for discounted rates.
                            </td>
                        </tr>                   
                        <tr>
                        	<td colspan="2" style="text-align: center;"><input type="submit" name="submit" value="Submit" /></td>
                        </tr>
                    </table>
                    </form>                    
             	</div>
             <?php
			 	}
				else
				{
					if($_POST['decision'] == "ACCEPT")
					{
						$first_name = cleanInput($_POST['billTo_firstName']);	
						$last_name = cleanInput($_POST['billTo_lastName']);	
						
						$street = cleanInput($_POST['billTo_street1']);	
						$city = cleanInput($_POST['billTo_city']);	
						$state = cleanInput($_POST['billTo_state']);
						$postal_code = cleanInput($_POST['billTo_postalCode']);		
						$country = cleanInput($_POST['billTo_country']);	
						
						$email = cleanInput($_POST['billTo_email']);	
						$username = cleanInput($_POST['billTo_customerID']);	
						$password = cleanInput($_POST['password']);	
						$credits = cleanInput($_POST['credits']);	
						$messages = cleanInput($_POST['messages']);
						
						unset($_POST);
																					
						$_POST['first_name'] = $first_name;
						$_POST['last_name'] = $last_name;
						$_POST['username'] = $username;
						$_POST['email'] = $email;
						$_POST['password'] = $password;
						$_POST['credits'] = $credits;
						$_POST['messages'] = $messages;
						
						$_POST['street'] = $street;
						$_POST['city'] = $city;
						$_POST['state'] = $state;
						$_POST['postal_code'] = $postal_code;
						$_POST['country'] = $country;
						
						insertDataIntoDatabase("users", $_POST);
						
						echo "Your order has been approved and your account has been created. Please login.";						
					}
					else					
						echo "Your order has been rejected.";
				}
			 ?>
			</div>
			<?php require_once('_includes/right_column.php'); ?>
	
			<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>