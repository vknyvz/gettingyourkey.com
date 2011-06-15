<?php 
	require_once('../_functions/php_data.php'); 
	
	if(!loggedIn() || !$admin || !isset($_GET['id']))
	{
		header('Location: '.$siteRoot);
		exit();
	}
	
	$id = cleanInput(intval($_GET['id']));
	$user = mysql_fetch_assoc(getUserByID($id));
	
	if(isset($_POST['delete']) && $admin)
	{
		deleteUsers($_POST);
		
		$_SESSION[$s_prefix.'message'] = "The user has been deleted!";
		
		header('Location: '.$siteRoot.'/admin/user_management.php');
		exit();
	}
	
	if(isset($_POST['submit']) && $admin)
	{
		updateDataInsideDatabase("users", "user_id", $id, $_POST);
		
		$_SESSION[$s_prefix.'message'] = "Information updated!";
		
		header('Location: '.$siteRoot.'/admin/edit_user.php?id='.$id);
		exit();
	}
			
	require_once('../_includes/pre_header.php');
	require_once('../_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('../_includes/search_form.php'); ?>
	
			<div id="content_wide">
            	<div class="min_height"></div>
				
				<?php require_once('../_includes/user_menu.php'); ?>
                                
               	<div style="text-align: center; font-weight: bold; padding: 10px;">
                	<?php
						if(isset($_SESSION[$s_prefix.'message']))
						{
							echo $_SESSION[$s_prefix.'message'];
							
							unset($_SESSION[$s_prefix.'message']);
						}
					?>
                </div>
                
                <table class="general" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td class="top" style="width: 100px;">&nbsp;</td>
                        <td class="top" style="width: 250px;">Current</td>
                        <td class="top">New</td>
                    </tr>
                    <form method="post" action="">
                    <tr>
                    	<td class="top">Username</td>
                        <td><?php echo $user['username']; ?></td>
                        <td><input type="text" name="username" class="edit" value="<?php echo $user['username']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td class="top">Email</td>
                        <td><?php echo $user['email']; ?></td>
                        <td><input type="text" name="email" class="edit" value="<?php echo $user['email']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td class="top">First Name</td>
                        <td><?php echo $user['first_name']; ?></td>
                        <td><input type="text" name="first_name" class="edit" value="<?php echo $user['first_name']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td class="top">Last Name</td>
                        <td><?php echo $user['last_name']; ?></td>
                        <td><input type="text" name="last_name" class="edit" value="<?php echo $user['last_name']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td class="top">Type</td>
                        <td><?php echo $user['type']; ?></td>
                        <td>
                        	<select name="type" style="width: 100px;">
                                <option <?php if($user['type'] == "normal"){echo ' selected="selected"'; } ?>>normal</option>
                                <option <?php if($user['type'] == "admin"){echo ' selected="selected"'; } ?>>admin</option>
                            </select>                        
                        </td>
                    </tr>
                    <tr>
                    	<td class="top">Credits</td>
                        <td><?php echo $user['credits']; ?></td>
                        <td><input type="text" name="credits" class="edit" value="<?php echo $user['credits']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td class="top">Messages</td>
                        <td><?php echo $user['messages']; ?></td>
                        <td><input type="text" name="messages" class="edit" value="<?php echo $user['messages']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td class="top" colspan="2">
                        		<input type="submit" name="submit" value="Update user" />
                            </form>
                        </td>
                        <td class="top">
                        	<form method="post" action="" onSubmit="return checkDel(this);">
                            	<input type="hidden" name="ids[]" value="<?php echo $user['user_id']; ?>" />
                            	<input type="submit" name="delete" value="Delete user" />
                            </form>
                        </td>
                    </tr> 
                </table>
			</div>
		<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('../_includes/footer.php');
	require_once('../_includes/post_footer.php');	
?>