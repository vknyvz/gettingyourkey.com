<?php 
	require_once('_functions/php_data.php'); 

	if(isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['recipient']) && loggedIn())
	{
		$subject = cleanInput($_POST['subject']);
		$message = cleanInput($_POST['message']);
		$recipient = cleanInput($_POST['recipient']);
		unset($_POST);
				
		if($subject == "" || $message == "" || $recipient == "")
		{
			$_SESSION['msg'] = '<div style="color: #FF0000; font-weight: bold;">You must fill out all fields</div>!';
			header('Location: '.$siteRoot.'/new_message.php');
			exit();
		}
		else
		{
			$_POST['subject'] = $subject;
			$_POST['message'] = $message;
			$_POST['recipient'] = $recipient;
		
			sendMessage($_POST);
			$_SESSION['msg'] = "Your message has been sent!";
		}	
		
		unset($_POST);
		header('Location: '.$siteRoot.'/new_message.php');
		exit();
	}
	
	require_once('_includes/pre_header.php');
	require_once('_includes/header.php');
?>
		
		<div id="main">
			<?php require_once('_includes/search_form.php'); ?>
	
			<div id="content_wide">
            	<div class="min_height"></div>
            	<?php require_once('_includes/user_menu.php'); ?>
                
                <?php
                	if(loggedIn())
                	{
				?>                
                        <div style="text-align: center; padding-bottom: 15px;">
                            <form method="post" action="?id">
                                <input type="hidden" name="id" value="" />
                                <input type="submit" value="New Message" />
                            </form>
                            
                             <?php
                                $user = mysql_fetch_assoc(getUser($_SESSION[$s_prefix.'username']));
                                
                                echo '<br />You can send <strong>'.$user['messages'].'</strong> more messages.';
                            ?>
                            
                            <?php
                                if(isset($_SESSION['msg']))
                                {
                                    $msg = cleanInput($_SESSION['msg']);
                                    unset($_SESSION['msg']);
                                    echo '<br /><br />'.$msg;
                                }
                            ?>
                        </div>
                
                        <table class="general" cellspacing="0" cellpadding="0">
                            <?php
                                
                                $listing_id = 0;
                                
                                if(isset($_GET['id']))
                                {
                                    $listing_id = cleanInput(intval($_GET['id']));
                                }						
                                
                                if($listing_id > 0)
                                {
                                    $listing = mysql_fetch_assoc(getListing($listing_id));
                                
                                    echo	'	
                                                <form method="post" action="'.$siteRoot.'/new_message.php">										
                                                <tr>
                                                    <td class="top" style="font-weight: bold; width: 60px;">Subject:</td>
                                                    <td style="text-align: left;">
                                                        <input type="text" value="Question about your listing (#'.$listing['listing_id'].')." style="width: 400px;" name="subject" />
                                                    </td>
                                                    <td class="top" style="width: 80px; font-weight: bold;">Recipient:</td>
                                                    <td style="width: 150px;">
                                                        <input type="text" value="'.$listing['owner'].'" name="recipient" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align: justify;">																											
                                                        <textarea name="message" id="message" style="width: 713px; height: 150px;"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="top" style="text-align: center;">
                                                        <input type="submit" value="Send message!" />													
                                                    </td>
                                                </tr>
                                                </form>
                                            ';
                                }
                                else
                                {
                                    if(isset($_POST['reply_id']))
                                        $id = cleanInput(intval($_POST['reply_id']));
                                    else
                                        $id = 0;
                                        
                                        $message = mysql_fetch_assoc(getMessage($id));
                                            
                                        
                                            echo	'	
                                                        <form method="post" action="'.$siteRoot.'/new_message.php">										
                                                        <tr>
                                                            <td class="top" style="font-weight: bold; width: 60px;">Subject:</td>
                                                            <td style="text-align: left;">
                                                                <input type="text" value="'; if($id){echo 'RE: '.$message['subject'];} echo '" style="width: 400px;" name="subject" />
                                                            </td>
                                                            <td class="top" style="width: 80px; font-weight: bold;">Recipient:</td>
                                                            <td style="width: 150px;">
                                                                <input type="text" value="'; if($id){echo $message['sender'];} echo '" name="recipient" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: justify;">																											
                                                                <textarea name="message" id="message" style="width: 713px; height: 150px;">'; if($id){echo '[quote]'.cleanBR($message['message']).'[/quote]'; } echo'</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="top" style="text-align: center;">
                                                                <input type="submit" value="Send message!" />													
                                                            </td>
                                                        </tr>
                                                        </form>
                                                    ';
                                }
                            ?>
                            
                        </table>
            	<?php
					}
					else
					{
				?>
                		<div style="text-align: center; padding-top: 50px;">You must be logged in to send messages.</div>
                <?php
					}
				?>
			</div>
		<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>