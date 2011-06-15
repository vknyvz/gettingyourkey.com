<?php 
	require_once('_functions/php_data.php'); 

/*
	if(isset($_GET['alter']))
	{
		$query = "ALTER TABLE `users` ADD `street` VARCHAR( 100 ) NOT NULL , ADD `city` VARCHAR( 100 ) NOT NULL , ADD `postal_code` VARCHAR( 100 ) NOT NULL , ADD `country` VARCHAR( 100 ) NOT NULL ,ADD `state` VARCHAR( 100 ) NOT NULL";
		returnQueryResult($query);
	}
*/
/*
	if(isset($_GET['new']))
	{
		$_POST['username'] = "andrew";
		$_POST['password'] = "202cb962ac59075b964b07152d234b70";
		$_POST['email'] = "test@test.com";
		$_POST['first_name'] = "test";
		$_POST['last_name'] = "test";
		$_POST['type'] = "normal";
		$_POST['credits'] = "9999";
		$_POST['messages'] = "99999";
		
		insertDataIntoDatabase("users", $_POST);
	}
*/
	
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
					“GettingYourKey” website is dedicated equally to all the individuals who are willing to buy, lease, rent or sell their properties, regardless whether they may represent a real-estate agency, or righteous owners. (See “About Us” tab, please.)
					<br /><br />
					Our goal is to provide both sides – person(s) that submit(s) an offer up for buying, leasing, renting or selling a property, and customers interested in these offers – with an equal opportunity to go for the best deal that matches their needs.
					<br /><br />
					<strong>Registration</strong>
                    <br /><br />
					The registration is a necessary step in order to post a listing, then follow that procedure carefully, please. You need to fill out the form with your name, address, etc. to create your account. If you experience some difficulties to complete that process, use “Contact Us” tab to get in touch with us. 
					<br /><br />
                    <strong>Payment</strong>
                    <br /><br />
					“GettingYourKey” does <strong>not</strong> participate in any financial operation – including commission, percentage, etc. - between interested parties, regardless of the value a property stands for. We charge a fixed fee of $94.99 a month, instead. We accept “Visa” and “MasterCard” as a method of payment. Payments are handled by “CyberSource” in order to secure all the financial operations.
					<br /><br />
                    <strong>Listing/Posting</strong>
                    <br /><br />
                    After completing the registration and payment procedures, you can post your listing(s). Check all the boxes properly, so a listing matches your offer. You can edit a listing any time, to correct it. You can support a listing by submitting some photos, floorplan, additional information, etc. However, the detailed address for any listing is being dimmed for security reason. It serves as a protection.
					<br /><br />
					It may happen that a listing does not match a real offer, then “GettingYourKey” will alter and edit a listing. In some drastic cases a listing may be even removed. Provide the most accurate information with concern to a listing, please, in order to avoid any unpleasant outcomes.
					<br /><br />
                    <strong>Account and Settings</strong>
					<br /><br />
                    Your account serves as a source of communication with other members. Adjust it properly, by submitting a correct data for all communication devices your want to use (like : e-mail, ICQ, etc.) so others can get in touch with you easily.
					<br /><br />
                    <strong>Additional information</strong>
                    <br /><br />
					The icon “A” stands for “Agency – Listing/Offer”.
                    <br />
					The Icon “D” stands for “Direct – Listing/Offer”.
                    <br />
                    <br />
					“GettingYourKey” can provide customers with a legal assistance and a contact with an attorney at law will be arranged upon a customer’s request.
                    <br /><br />
                    Customers with more than 5 offers will get a discount, instead of paying a fixed fee of $94.99 a month. It also applies to all customers who consider their offers to be posted for longer than 5 months. Use “Contact Us” feature please, since every single case will be handled individually.
			</div>
	
			<?php require_once('_includes/right_column.php'); ?>
	
			<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>