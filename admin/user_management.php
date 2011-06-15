<?php 
	require_once('../_functions/php_data.php'); 
	
	if(!loggedIn() || !$admin)
	{
		header('Location: '.$siteRoot);
		exit();
	}
	
	if(isset($_POST['delete']) && $admin)
	{
		deleteUsers($_POST);
		
		$_SESSION[$s_prefix.'message'] = "Checked users have been deleted!";
		
		header('Location: '.$siteRoot.'/admin/user_management.php');
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
                    	<td class="top" style="width: 50px;">ID</td>
                        <td class="top" style="width: 150px;">Username</td>
                        <td class="top">Email</td>
                        <td class="top">Name</td>
                        <td class="top" style="width: 60px;">Type</td>
                        <td class="top" style="width: 30px;">&nbsp;</td>
                    </tr>
                    <form method="post" action="" onSubmit="return checkDel(this);">
                    <?php
						$data = getUsers();
						
						while($user = mysql_fetch_assoc($data))
						{
							echo	'
										<tr>
											<td class="odd">'.$user['user_id'].'</td>
											<td class="even"><a href="'.$siteRoot.'/admin/edit_user.php?id='.$user['user_id'].'">'.$user['username'].'</a></td>
											<td class="odd">'.$user['email'].'</td>
											<td class="even">'.$user['first_name'].' '.$user['last_name'].'</td>
											<td class="odd">'.$user['type'].'</td>
											<td class="even"><input type="checkbox" name="ids[]" value="'.$user['user_id'].'" /></td>
										</tr>
									';
						}
					?>
                    <tr>
                    	<td class="top" colspan="6" style="text-align: right;">
                        	<input type="submit" name="delete" value="Delete checked users" />
                        </td>
                    </tr>
                    </form>                    
                </table>
			</div>
		<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('../_includes/footer.php');
	require_once('../_includes/post_footer.php');	
?>