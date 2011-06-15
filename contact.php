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

	require_once('_includes/pre_header.php'); 
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content">
            	<div class="min_height"></div>
					Whether you experience some problems with a reference to a registration procedure, submitting your offer, incorrect information posted within an offer, etc. use this e-mail as a form of contact, please.
                    <br /><br />
					Since your feedback is very important to us, we will reply to your e-mail as quickly as possible.<br />
                    <div style="text-align: center;">
                    	<a href="mailto:customerservices@gettingyourkey.com">customerservices@gettingyourkey.com</a>
                    </div>
			</div>
	
			<?php require_once('_includes/right_column.php'); ?>
	
			<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>