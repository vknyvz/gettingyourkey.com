<?php 
	require_once('_functions/php_data.php'); 
			
	if(!loggedIn())
	{
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}
	
	if(isset($_POST))
	{
		$user = mysql_fetch_assoc(getUser($_SESSION[$s_prefix.'username']));
		$id = $user['user_id'];
		
		if(isset($_POST['password']))
		{
			if(isset($_POST['current_password']) && isset($_POST['new_password1']) && isset($_POST['new_password2']))
			{
				$current = cleanInput($_POST['current_password']);
				$new1 = cleanInput($_POST['new_password1']);
				$new2 = cleanInput($_POST['new_password2']);
				
				if($current == "" || $new1 == "" || $new2 == "")
				{
					$_SESSION[$s_prefix.'message'] = "You must fill out all fields!";
					header('Location: '.$siteRoot.'/account.php');
					exit();
				}
				
				if(md5($current) != $user['password'])
				{
					$_SESSION[$s_prefix.'message'] = "Incorrect current password!";
					header('Location: '.$siteRoot.'/account.php');
					exit();
				}
				
				if($new1 !== $new2)
				{
					$_SESSION[$s_prefix.'message'] = "Entered passwords do not match!";
					header('Location: '.$siteRoot.'/account.php');
					exit();
				}
				
				$new1 = md5($new1);
				
				$query = "UPDATE users SET password='$new1' WHERE user_id='$id'";
				
				if(returnQueryResult($query))
				{
					$_SESSION[$s_prefix.'message'] = "Your password has been changed!";
					header('Location: '.$siteRoot.'/account.php');
					exit();
				}
			}
			else
			{
				$_SESSION[$s_prefix.'message'] = "You must fill out all fields!";
				header('Location: '.$siteRoot.'/account.php');
				exit();
			}
		}
		else if(isset($_POST['email']))
		{
			$email1 = cleanInput($_POST['new_email1']);
			$email2 = cleanInput($_POST['new_email2']);
			
			if($email1 == "" || $email2 == "")
			{
				$_SESSION[$s_prefix.'message'] = "You must fill out all fields!";
				header('Location: '.$siteRoot.'/account.php');
				exit();
			}
			
			if($email1 != $email2)
			{
				$_SESSION[$s_prefix.'message'] = "Entered emails do not match!";
				header('Location: '.$siteRoot.'/account.php');
				exit();
			}
			
			$query = "UPDATE users SET email='$email1' WHERE user_id='$id'";
			if(returnQueryResult($query))
			{
				$_SESSION[$s_prefix.'message'] = "Your email has been changed!";
				header('Location: '.$siteRoot.'/account.php');
				exit();
			}
		}
	}
	
	require_once('_includes/pre_header.php');
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content_wide">
            	<?php require_once('_includes/user_menu.php'); ?>
                        
                <div class="min_height"></div>
                
                <div style="text-align: center; padding: 10px;">
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
                	<tr>
                    	<td class="top" colspan="2">Change Password</td>
                        <td class="top" colspan="2">Change Email</td>
                    </tr>
                    <tr>
                    	<td style="width: 120px;">Current Password:</td>
                        <td style="width: 245px;"><input type="password" name="current_password" value="" class="account" /></td>
                        <td style="width: 120px;">Current Email:</td>
                        <td><?php echo $user['email']; ?></td>
                    </tr>
                    <tr>
                    	<td style="width: 120px;">New Password:</td>
                        <td style="width: 245px;"><input type="password" name="new_password1" value="" class="account" /></td>
                        <td style="width: 120px;">New Email:</td>
                        <td><input type="text" name="new_email1" value="" class="account" /></td>
                    </tr> 
                    <tr>
                    	<td style="width: 120px;">New Password: (again)</td>
                        <td style="width: 245px;"><input type="password" name="new_password2" value="" class="account" /></td>
                        <td style="width: 120px;">New Email: (again)</td>
                        <td><input type="text" name="new_email2" value="" class="account" /></td>
                    </tr>
                    <tr>
                    	<td class="top" colspan="2"><input type="submit" name="password" value="Change password" /></td>
                        <td class="top" colspan="2"><input type="submit" name="email" value="Change email" /></td>
                    </tr>
                    </form>
                </table>                
			</div>
			<div class="clearer"></div>			
		</div>
        
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>