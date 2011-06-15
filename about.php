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
					“GettingYourKey” is neither a real-estate agency nor affiliated in any form with any real-estate agency. “GettingYourKey” is a new concept for buying, leasing, renting and selling properties, instead.
                    <br /><br />
					GettingYourKey” gives all the interested parties an opportunity to buy, lease, rent or sell their properties. Whether transactions are being made by professional agencies or direct owners “GettingYourKey” neither participates in any form of financial operations between interested parties – that includes commission,  percentage, etc. - nor collects any profits due to that activity.
                    <br /><br />
					“GettingYourKey” provides a place and space to all the interested parties, and charges a fixed fee of $94.99 monthly only, instead.				
			</div>
	
			<?php require_once('_includes/right_column.php'); ?>
	
			<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>