<?php
	function getMessages()
	{
		global $s_prefix;		
		$user = $_SESSION[$s_prefix.'username'];
		
		$query = "SELECT * FROM messages WHERE recipient='$user' ORDER BY message_id DESC";
		return returnQueryResult($query);
	}
	
	function getMessage($id)
	{
		global $s_prefix;		
		$user = $_SESSION[$s_prefix.'username'];
		
		$query = "SELECT * FROM messages WHERE recipient='$user' AND message_id='$id'";
		return returnQueryResult($query);
	}
	
	function sendMessage($_POST)
	{
		global $s_prefix;
		
		$recipient = cleanInput($_POST['recipient']);
		$subject = cleanInput($_POST['subject']);
		$message = cleanInput($_POST['message']);		
		$sender = $_SESSION[$s_prefix.'username'];
		$ip = realIP();
		
		unset($_POST);
		
		$_POST['recipient'] = $recipient;
		$_POST['sender'] = $sender;
		$_POST['subject'] = $subject;
		$_POST['message'] = $message;
		$_POST['sender_ip'] = $ip;
		$_POST['status'] = "unread";
		$_POST['date'] = date("Y-m-d H:i:s");
		
		insertDataIntoDatabase("messages", $_POST);
		
		/* decrease message limit */
		
		$query = "SELECT messages FROM users WHERE username='$sender'";
		$result = mysql_fetch_assoc(returnQueryResult($query));
		
		$messages = $result['messages'];
		$messages = $messages - 1;
		
		$query = "UPDATE users SET messages='$messages' WHERE username='$sender' LIMIT 1";
		returnQueryResult($query);		
	}
	
	function countUnreadMessages()
	{
		global $s_prefix;		
		$user = $_SESSION[$s_prefix.'username'];
		
		$query = "SELECT * FROM messages WHERE recipient='$user' AND status='unread'";
		$result = returnQueryResult($query);
		
		return mysql_num_rows($result);
	}
	
	function deleteMessages($_POST)
	{
		global $s_prefix;
		
		$user = $_SESSION[$s_prefix.'username'];
		
		while(list ($key, $id) = @each ($_POST['ids'])) 
		{			
			$query = "DELETE FROM messages WHERE message_id='$id' AND recipient='$user'";
			returnQueryResult($query);				
		} 
	}
?>