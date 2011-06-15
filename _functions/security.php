<?PHP
	//checks login credentials
	function verifyLogin($username, $password) 
	{	
		$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		$result = returnQueryResult($query);
		if (mysql_num_rows($result) != 1)
		{
			return false;
		}
		
		return true;
	}	

	$admin = false;
	
	if(loggedIn())
	{	
		$user = mysql_fetch_assoc(getUser($_SESSION[$s_prefix.'username']));
	
		if($user['type'] == "admin")
			$admin = true;
	}
?>