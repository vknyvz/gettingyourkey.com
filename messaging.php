<?php 
	require_once('_functions/php_data.php'); 
			
	if(!loggedIn())
	{
		header('Location: '.$siteRoot.'/index.php');
		exit();
	}
	
	if(isset($_POST['del']))
	{
		deleteMessages($_POST);
		unset($_POST);
		header('Location: '.$siteRoot.'/messaging.php');
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
                
                <div style="text-align: center; padding-bottom: 15px;">
                	<form method="post" action="<?php echo $siteRoot; ?>/new_message.php">
                    	<input type="hidden" name="id" value="" />
                    	<input type="submit" value="New Message" />
                    </form>
                    
                    <?php
						$user = mysql_fetch_assoc(getUser($_SESSION[$s_prefix.'username']));
						
						echo '<br />You can send <strong>'.$user['messages'].'</strong> more messages.';
					?>
                </div>
                                
				<table class="general" cellspacing="0" cellpadding="0">
                	<?php
					
						//load all messages
						if(!isset($_GET['id']))
						{
							$data = getMessages();
							
							if(mysql_num_rows($data) > 0)
							{
								echo	'
											<form method="post" action="?" onSubmit="return checkDel(this);">
               								<input type="hidden" name="del" />
											<tr>
												<td class="top" style="width: 50px;">&nbsp;</td>
												<td class="top">Subject</td>
												<td class="top" style="width: 120px;">From</td>
												<td class="top" style="width: 100px;">Date</td>
											</tr>
										';
										
								while($message = mysql_fetch_assoc($data))
								{
									echo	'
												<tr>
													<td class="odd"><input type="checkbox" name="ids[]" value="'.$message['message_id'].'" /></td>
													<td class="even" style="text-align: left;'; if($message['status'] == "unread"){echo ' font-weight: bold; ';} echo '">
													<a href="'.$siteRoot.'/messaging.php?id='.$message['message_id'].'">'.$message['subject'].'</a>
													</td>
													<td class="odd">'.$message['sender'].'</td>
													<td class="even">'.formatDate($message['date']).'</td>
												</tr>
											';
								}
								
								echo	'
											<tr>
												<td class="top" colspan="4" style="text-align: left;"><input type="submit" value="Delete Checked!" /></td>
											</tr>
											</form>
										';
							}
							else
							{
								echo	'
											<tr>
												<td class="top" colspan="4">You have no messages.</td>
											</tr>
										';
							}
						}
						//load individual message
						else
						{
							$id = cleanInput(intval($_GET['id']));
							
							$message = mysql_fetch_assoc(getMessage($id));						
																
							echo	'
										<tr>
											<td class="top" style="width: 60px; font-weight: bold;">Subject:</td>
											<td style="text-align: left;" colspan="3">'.$message['subject'].'</td>
										</tr>
										<tr>
											<td class="top" style="font-weight: bold;">From:</td>
											<td style="text-align: left;">'.$message['sender'].'</td>
											<td class="top" style="width: 60px; font-weight: bold;">Date:</td>
											<td style="width: 100px;">'.formatDate($message['date']).'</td>
										</tr>
										<tr>
											<td colspan="4" style="text-align: justify; padding: 10px;">
												'.setupQuotes($message['message']).'
											</td>
										</tr>
										<tr>
											<td colspan="4" class="top" style="text-align: center;">
												<form method="post" action="'.$siteRoot.'/new_message.php">
													<input type="hidden" name="reply_id" value="'.$message['message_id'].'" />
													<input type="submit" value="Reply" />
												</form>	
											</td>
										</tr>
									';
	
							if($message['status'] == "unread")
							{
								unset($_POST);
								$_POST['status'] = "read";
								updateDataInsideDatabase("messages", "message_id", $id, $_POST);
							}
						}
					?>
                    
                </table>                
			</div>
			<div class="clearer"></div>			
		</div>					
		
<?php 
	require_once('_includes/footer.php');
	require_once('_includes/post_footer.php');	
?>