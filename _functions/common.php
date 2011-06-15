<?PHP
	
	// returns the query result to the caller
	function returnQueryResult($query) 
	{
		$dbc = new MySQL();
		$result = $dbc->executeQuery($query);
	
		return $result;
	}
	
	// inserts data into the database
	function insertDataIntoDatabase($databaseTable, $formInputData) 
	{
		$formattedStringFields = "";
		$formattedStringValues = "";
		
		while ($element = each($formInputData))
		{
			if(!is_array($element['value']))
			{
				if ($element['key'] != "submit")
				{
					$formattedStringFields .= " " . $element['key'] . ",";
					$formattedStringValues .= " '" . addslashes(trim($element['value'])) . "',";
				}
			}
		}
		$formattedStringFields = substr($formattedStringFields, 0, strlen($formattedStringFields) - 1);
		$formattedStringValues = substr($formattedStringValues, 0, strlen($formattedStringValues) - 1);
		$formattedStringValues = str_replace("\r\n","<br />",$formattedStringValues);
		
		$insertQuery = "INSERT INTO $databaseTable ($formattedStringFields) VALUES($formattedStringValues)";
		
		$dbc = new MySQL();
		$dbc->executeQuery($insertQuery) or die(mysql_error());		
		
		return $dbc->returnLastInsertID();
	}
	
	// updates information in the database
	function updateDataInsideDatabase($databaseTable, $keyField, $keyValue, $formInputData) 
	{
		$formattedString = "";
		
		while ($element = each($formInputData))
		{
			if(is_array($element['value']))
			{
				 // do nothing
			}
			else
			{
				if ($element['key'] != "submit")
				{
					$formattedString .= " " . $element['key'] . "='";
					$formattedString .= "" . addslashes(trim($element['value'])) . "',";
				}
			}
	
		}
		$formattedString = substr($formattedString, 0, strlen($formattedString) - 1);
		$formattedString = str_replace("\r\n","<br />",$formattedString);
		
		$updateQuery = "UPDATE $databaseTable SET $formattedString WHERE $keyField='$keyValue'";
		$queryResult = returnQueryResult($updateQuery);

		return $queryResult;
	}
	
	// checks whether a certain record exists in the database or not
	function checkExistance($table, $field, $target)
	{
		$query = "SELECT * FROM $table WHERE $field='$target'";
		$result = returnQueryResult($query);
		
		if(mysql_num_rows($result) > 0)
			return true;
		else
			return false;
	}
	
	// cleans up potentially malicious code in a given string	
	function cleanInput($string)
	{
		return htmlentities(trim(strip_tags($string)));
	}
	
	//removes html line breaks
	function cleanBR($string)
	{
		$string = str_replace("<br>", "
", $string);
		$string = str_replace("<br/>", "
", $string);
		$string = str_replace("<br />", "
", $string);
		return $string;
	}
	
	//change BB code quotes to HTML quotes
	function setupQuotes($string)
	{
		while( (strpos($string, "[quote]") !== false) && (strpos($string, "[/quote]") !== false) )
		{
			//replace opening quote tag
			//$string = preg_replace('/[quote]/', '<test>', $string, 1);
			//echo $string.'<br>';
						
			$pos1 = strpos($string, "[quote]");
			
			$first = substr($string, 0, $pos1);
			$last = substr($string, $pos1+7);
			
			$string = $first.'<div class="quote">'.$last;
			
			
			$pos = strrpos($string, "[/quote]");
			
			$first = substr($string, 0, $pos);
			$last = substr($string, $pos);
			
			$last = str_replace("[/quote]", "</div>", $last);
			
			$string = $first.$last;
		}
		
		return $string;
	}
		
	// takes a sting like "one, two, three" and returns an array: data[0]="one"; data[1]="two"; data[2]="three"; etc...
	function parseCommaList($string)
	{
		$data = array();
		
		while(strpos($string, ',') != false)
		{
			$pos = strpos($string, ',');
			
			$data[] = substr($string, 0, $pos);
	
			$string = substr($string, $pos+1);
		}
		
		$data[] = $string;
		
		return $data;
	}
	
	// takes a string like [test1][test2][test3] and returns an array: data[0]="test1"; data[1]="test2"; data[2]="test3"; etc...
	function parseDataList($string)
	{
		$data = array();
		
		while(strpos($string, '[') !== false && strpos($string, ']') !== false)
		{
			$string = trim($string);
			
			$start = strpos($string, '[') + 1;
			$end = strpos($string, ']') - 1;			
			
			$data[] = substr($string, $start, $end);
			
			$string = substr($string, $end + 2);
		}

		return $data;
	}
	
	// takes an array like: data[0]="test1"; data[1]="test2"; data[2]="test3"; and returns a string like [test1][test2][test3]
	function unparseDataList($array)
	{
		$dates_string = "";
		
		foreach($array as $date)
		{
			$dates_string .= '['.$date.']';
		}
		
		return $dates_string;
	}

	// returns the value of the specified parameter
	function getParameter($parameter)
	{
		$query = "SELECT value FROM parameters WHERE name='$parameter'";
		
		$data = mysql_fetch_assoc(returnQueryResult($query));
		
		return $data['value'];
	}
	
	// updates the parameters
	function updateParameters($_POST)
	{
		while ($element = each($_POST))
		{
			if(is_array($element['value']))
			{
				 // do nothing
			}
			else
			{
				if ($element['key'] != "submit")
				{
					$key = $element['key'];
					$value = $element['value'];
					
					$query = "UPDATE parameters SET value='$value' WHERE name='$key'";
					returnQueryResult($query);
				}
			}
	
		}
	}
		
	// accepts a MySQL formatted date, returns a properly formatted date
	function formatDate($date)
	{		
		if($date != "" )
		{
			$formatted = strtotime($date);
			
			$formatted = date('m / d / Y', $formatted); 
			
			return $formatted;
		}
		else
		{
			return "";
		}
	}
	
	
	
	//a perfectly functional function for NORMAL web-servers, such as APACHE
	//deletes a directory and all files/folders within
	
	function deleteDirectory($dirname)  
	{
        if (is_dir($dirname))
	       	$dir_handle = opendir($dirname);
		
        if (!$dir_handle)
	       	return false;
		
        while ($file = readdir($dir_handle))
		{
			if ($file != "." && $file != "..")
			{
				if (!is_dir($dirname."/".$file))
					unlink($dirname."/".$file);
					//unlink($dirname."/".$file);
				else
					delete_directory($dirname.'/'.$file);                       
			}
        }
        closedir($dir_handle);
        rmdir($dirname);
        return  true;
	} 
	
	
	//since M$'s IIS server refuses to unlink(), use FTP to delete
	/*
	function deleteDirectory($dirname)  
	{
        if(is_dir($dirname))
	    {	
			$conn_id = ftp_connect("208.109.177.8");
			$login_result = ftp_login($conn_id, "JackS", "Bri#4dge@1E");
			
			if(ftp_delete($conn_id, "httpdocs/".$dirname))
			{
				ftp_close($conn_id);
				return true;
			}
			else
			{
				ftp_close($conn_id);
				return false;
			}
		}
		else
			return false;	
	} 
	*/
?>