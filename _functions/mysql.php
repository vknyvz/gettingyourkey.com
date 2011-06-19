<?php
class MySQL
{
	var $query;
	var $result;
	var $db_connection;  

    function MySQL()  //connects to the database with specified information
    {
		$db_name = "";
		$db_host = "localhost";	
		$db_user = "";
		$db_pass = "";		
		
		$this->db_connection = mysql_connect($db_host, $db_user, $db_pass) or die('Could not connect to database server.');
		
		mysql_select_db($db_name, $this->db_connection) or die('Could not connect to the database.');
		
		register_shutdown_function(array(&$this, 'Disconnect'));
    }
    
    function Disconnect()
    {
        mysql_close($this->db_connection);
    }
	
	function executeQuery($outsideQuery) 
	{
		$this->result = mysql_query($outsideQuery);
		
		return $this->result;
	}
	
	function returnAssocArray($outsideResult) 
	{
		return mysql_fetch_assoc($outsideResult);
	}

	function returnLastInsertID()
	{
		return mysql_insert_id($this->db_connection);
	}
}
?>
