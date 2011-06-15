<?php 
	function getListings($type, $id, $limit, $direction)
	{
		if($direction == "forward")
		{	
			if($id != 0)
				$query = "SELECT * FROM listings WHERE type='$type' AND listing_id < $id ORDER BY listing_id DESC LIMIT $limit";
			else
				$query = "SELECT * FROM listings WHERE type='$type' ORDER BY listing_id DESC LIMIT $limit";
		}
		else
		{
			if($id != 0)
				$query = "SELECT listing_id FROM listings WHERE type='$type' AND listing_id > $id ORDER BY listing_id ASC LIMIT $limit";
			else
				$query = "SELECT listing_id FROM listings WHERE type='$type' ORDER BY listing_id ASC LIMIT $limit";
				
			$data = returnQueryResult($query);
			
			$first = -1;
			$last = -1;
			
			while($row = mysql_fetch_assoc($data))
			{
				if($first != -1)
					$first = $row['listing_id'];
				
				$last = $row['listing_id'];
			}
			
			$query = "SELECT * FROM listings WHERE type='$type' AND listing_id >= $first AND listing_id <= $last ORDER BY listing_id DESC LIMIT $limit";
		}
			
		return returnQueryResult($query);
	}
	
	function getListing($id)
	{
		$query = "SELECT * FROM listings WHERE listing_id='$id' LIMIT 1";
		return returnQueryResult($query);
	}
	
	function countListings($type)
	{
		$query = "SELECT listing_id FROM listings";
		return returnQueryResult($query);
	}
	
	function getCornerID($type, $direction)
	{
		$query = "SELECT * FROM listings WHERE type='$type' ORDER BY listing_id $direction LIMIT 1";
		$result = mysql_fetch_assoc(returnQueryResult($query));
		
		return $result['listing_id'];
	}
	
	function cleanRoom($string)
	{
		$string = str_replace("&nbsp;", "", $string);
		$string = str_replace(" ", "", $string);
		$string = str_replace("+", "", $string);
		
		return $string;
	}
	
	function search($_POST)
	{
		$state = cleanInput($_POST['state']);
		$city = cleanInput($_POST['city']);
		$zip = cleanInput($_POST['zip']);
		$price_min = cleanInput($_POST['price_min']);
		$price_max = cleanInput($_POST['price_max']);
		$bedroom = cleanRoom(cleanInput($_POST['bedroom']));
		$livingroom = cleanRoom(cleanInput($_POST['livingroom']));
		$kitchen = cleanRoom(cleanInput($_POST['kitchen']));
		$bathroom = cleanRoom(cleanInput($_POST['bathroom']));
		$keywords = cleanInput($_POST['keywords']);
		
		if($state != "Please select")
			$query = "SELECT * FROM listings WHERE state='$state' ";
		else
			$query = "SELECT * FROM listings WHERE 1=1 ";
		
		if($city != "")
			$query .= "AND city LIKE '%$city%' ";
			
		if($zip != "")
			$query .= "AND zip='$zip' ";
			
		if($price_min != "")
			$query .= "AND price>='$price_min' ";
			
		if($price_max != "")
			$query .= "AND price<='$price_max' ";
			
		if($bedroom != "")
			$query .= "AND bedroom>='$bedroom' ";
			
		if($livingroom != "")
			$query .= "AND livingroom>='$livingroom' ";
			
		if($kitchen != "")
			$query .= "AND kitchen>='$kitchen' ";
			
		if($bathroom != "")
			$query .= "AND bathroom>='$bathroom' ";
			
		if($keywords != "")
		{
			$keywords = parseCommaList($keywords);
			
			if(sizeof($keywords) > 0)
			{
				$query .= " AND ( ";
				
				foreach($keywords as $key)
				{
					$query .= " description LIKE '%$key%' OR  ";
				}
				
				$query .= " 1=-1 ) ";
			}			
		}
		
		$query .= " ORDER BY listing_id DESC";
		
		return returnQueryResult($query);
	}
	
	function getMyListings()
	{
		global $s_prefix;		
		$user = $_SESSION[$s_prefix.'username'];
		
		$query = "SELECT * FROM listings WHERE owner='$user' ORDER BY listing_id DESC";
		return returnQueryResult($query);
	}
	
	function deleteListings($_POST)
	{
		global $s_prefix;
		$user = $_SESSION[$s_prefix.'username'];
	
		while(list ($key, $id) = @each ($_POST['ids'])) 
		{
			$query = "DELETE FROM listings WHERE listing_id='$id' AND owner='$user' LIMIT 1";
			
			if(deleteDirectory('photos/'.$id))
				returnQueryResult($query);			
		} 
	}
?>