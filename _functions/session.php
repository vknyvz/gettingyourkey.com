<?PHP
	session_start();
	
	//returns the user's IP	
	function realIP()
    {
        if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
        {
	        return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		 // if access direct to Internet, without Proxy
   			return $_SERVER['REMOTE_ADDR'];
		}
    }
	
	//the prefix applied to the name of all session variables        
	$s_prefix = md5( md5( substr(realIP(), 1, 3) ) . "Get a Key" );
		
	//check if the user is logged in or not	
	function loggedIn()
	{
		//register the global variable
		global $s_prefix;

		if( isset($_SESSION[$s_prefix.'username']) )
			return true;
		else
			return false;		
	}    
?>