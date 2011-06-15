<?PHP
	$url = $_SERVER['PHP_SELF'];
	
	require_once('mysql.php');	
	require_once('session.php');
	require_once('common.php');
	require_once('user.php');
	require_once('security.php');
	require_once('listing.php');
	require_once('messages.php');	
	
	$siteRoot = getParameter("site_root");
	
	/*
	if(strpos($url, "yuba") != false)
	{
		$siteRoot = "http://www.yubastudios.com/clients/jack";
	}
	else
	{
		$siteRoot = "http://localhost/Get a Key/Version 2";
	}
	*/
	
	$siteTitle = getParameter("site_title");
?>