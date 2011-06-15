<?php
	require_once('_functions/php_data.php');
	require_once('HOP.php');
	
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

	if(!isset($_SESSION[$s_prefix.'reg_first_name']) && !isset($_SESSION[$s_prefix.'reg_last_name']) && !isset($_SESSION[$s_prefix.'reg_username']) && !isset($_SESSION[$s_prefix.'reg_email']) && !isset($_SESSION[$s_prefix.'reg_password']) && !isset($_SESSION[$s_prefix.'reg_credits']) && !isset($_SESSION[$s_prefix.'reg_messages']) && !isset($_SESSION[$s_prefix.'reg_street']) && !isset($_SESSION[$s_prefix.'reg_city']) && !isset($_SESSION[$s_prefix.'reg_state']) && !isset($_SESSION[$s_prefix.'reg_postal_code']) && !isset($_SESSION[$s_prefix.'reg_country']))
	{
		header('Location: '.$siteRoot.'/register.php');
		exit();
	}

	require_once('_includes/pre_header.php'); 
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content" style="padding-top: 0;">
				<div class="min_height"></div>    
                     
                <div id="register_form">
                    <h1>Confirmation</h1>
                    <form method="post" action="https://orderpage.ic3.com/hop/orderform.jsp">
                    <?php InsertSignature($_SESSION[$s_prefix.'reg_credits']*94.99, "usd"); ?>
                    <input type="hidden" name="orderPage_transactionType" value="authorization" />
                    <input type="hidden" name="billTo_firstName" value="<?php echo $_SESSION[$s_prefix.'reg_first_name']; ?>" />
                    <input type="hidden" name="billTo_lastName" value="<?php echo $_SESSION[$s_prefix.'reg_last_name']; ?>" />
                    <input type="hidden" name="billTo_email" value="<?php echo $_SESSION[$s_prefix.'reg_email']; ?>" />
                    <input type="hidden" name="billTo_customerID" value="<?php echo $_SESSION[$s_prefix.'reg_username']; ?>" />
                    <input type="hidden" name="password" value="<?php echo $_SESSION[$s_prefix.'reg_password']; ?>" />
                    <input type="hidden" name="credits" value="<?php echo $_SESSION[$s_prefix.'reg_credits']; ?>" />
                    <input type="hidden" name="messages" value="<?php echo $_SESSION[$s_prefix.'reg_messages']; ?>" />
                    
                    <input type="hidden" name="billTo_street1" value="<?php echo $_SESSION[$s_prefix.'reg_street']; ?>" />
                    <input type="hidden" name="billTo_city" value="<?php echo $_SESSION[$s_prefix.'reg_city']; ?>" />
                    <input type="hidden" name="billTo_state" value="<?php echo $_SESSION[$s_prefix.'reg_state']; ?>" />
                    <input type="hidden" name="billTo_postalCode" value="<?php echo $_SESSION[$s_prefix.'reg_postal_code']; ?>" />
                    <input type="hidden" name="billTo_country" value="<?php echo $_SESSION[$s_prefix.'reg_country']; ?>" />
                                        
                    <table class="listings" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="width: 150px;">First Name:</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_first_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Last Name:</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_last_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Street Address:</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_street']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">City:</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_city']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">State:</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_state']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Postal Code:</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_postal_code']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Country:</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_country']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Username:</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_username']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Email</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_email']; ?></td>
                        </tr>                      
                        <tr>
                            <td style="width: 100px;">How many listings will you be placing?</td>
                            <td><?php echo $_SESSION[$s_prefix.'reg_credits']; ?> ( <b>$<?php echo $_SESSION[$s_prefix.'reg_credits']*94.99; ?> USD Total</b> )</td>
                        </tr>                   
                        <tr>
                        	<td colspan="2" style="text-align: center;"><input type="submit" value="Proceed" /></td>
                        </tr>
                    </table>
                    </form>                    
             	</div>
			</div>
			<?php require_once('_includes/right_column.php'); ?>
	
			<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>