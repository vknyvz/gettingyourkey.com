<?php
	function getUser($username)
	{
		$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		return returnQueryResult($query);
	}
	
	function getUserByID($id)
	{
		$query = "SELECT * FROM users WHERE user_id='$id' LIMIT 1";
		return returnQueryResult($query);
	}
	
	function getUsers()
	{
		$query = "SELECT * FROM users ORDER BY user_id DESC";
		return returnQueryResult($query);
	}
	
	function decreaseCredits()
	{
		global $s_prefix;
		$user = $_SESSION[$s_prefix.'username'];
		
		$query = "SELECT credits FROM users WHERE username='$user'";
		$result = mysql_fetch_assoc(returnQueryResult($query));
		
		$credits = $result['credits'];
		$credits = $credits - 1;
		
		$query = "UPDATE users SET credits='$credits' WHERE username='$user'";
		returnQueryResult($query);
	}
	
	function deleteUsers($_POST)
	{
		global $admin;
		
		if($admin)
		{
			while(list ($key, $id) = @each ($_POST['ids'])) 
			{
				$query = "DELETE FROM users WHERE user_id='$id'LIMIT 1";
				returnQueryResult($query);		
			} 
		}
	}
?>