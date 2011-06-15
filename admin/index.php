<?php 
	require_once('../_functions/php_data.php'); 
	
	if(!loggedIn() || !$admin)
	{
		header('Location: '.$siteRoot);
		exit();
	}
	
	if(isset($_POST['submit']))
	{
		updateParameters($_POST);
		header('Location: '.$siteRoot.'/admin/');
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
                                
                <ul id="admin" style="padding-bottom: 10px;">
                	<li><a href="<?php echo $siteRoot; ?>/admin/user_management.php">User management</a></li>
                </ul>
                
                <table class="general" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td class="top" style="width: 200px;">Parameter Name</td>
                        <td class="top">Parameter Value</td>
                    </tr>
                    <form method="post" action="">
                    <tr>
                    	<td>Site Root URL</td>
                        <td><input type="text" name="site_root" value="<?php echo getParameter("site_root"); ?>" class="admin" /></td>
                    </tr>
                    <tr>
                    	<td>Site Title</td>
                        <td><input type="text" name="site_title" value="<?php echo getParameter("site_title"); ?>" class="admin" /></td>
                    </tr>
                    <tr>
                    	<td>Number of listings per page</td>
                        <td><input type="text" name="listing_limit" value="<?php echo getParameter("listing_limit"); ?>" class="admin" /></td>
                    </tr>  
                    <tr>
                    	<td>Number of messages per credit</td>
                        <td><input type="text" name="messages_limit" value="<?php echo getParameter("messages_limit"); ?>" class="admin" /></td>
                    </tr> 
                    <tr>
                    	<td colspan="2" class="top"><input type="submit" name="submit" value="Update parameters" /></td>
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