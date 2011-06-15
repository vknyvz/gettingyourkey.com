<script type="text/javascript">
			<!--
			
			var rotate_delay = 3500;
			current = -1;
			var stop = "false";
			
			var pictures = new Array();	
			
			<?php
				if(strpos($url, "preview.php") == false)
				{
					$d = 'photos/'.$id.'/';
							
					//blank array to hold file names
					$files = array();
				
					//open the directory
					$dir = opendir($d);
				
					//while directory is being read
					while($f = readdir($dir))
					{
						//check for right extensions
						if( ( eregi("\.jpg",$f) || eregi("\.gif",$f) || eregi("\.png",$f) || eregi("\.bmp",$f) ) && (strpos($f, "thumb") === false) )
						{
							//add file name to the array if it's not the thumbnail
							array_push($files, $f);							
						}
					}
				
					// the thumb file will always be last, so don't include it
					for($a = 0; $a < sizeof($files); $a++)
					{
						echo 'pictures['.$a.'] = new Image();
			pictures['.$a.'].src = \''.$d.$files[$a].'\';
			';					
					}
				}
				else
				{
					$images = array();
					
					$no_image = true;
					
					$folder = "photos/temp/";
					
					if(isset($_SESSION[$s_prefix.'image1']) && file_exists($folder.$_SESSION[$s_prefix.'image1']))
					{
						$images[] = $folder.$_SESSION[$s_prefix.'image1'];
						$no_image = false;
					}
				
					if(isset($_SESSION[$s_prefix.'image2']) && file_exists($folder.$_SESSION[$s_prefix.'image2']))
					{
						$images[] = $folder.$_SESSION[$s_prefix.'image2'];
						$no_image = false;
					}
						
					if(isset($_SESSION[$s_prefix.'image3']) && file_exists($folder.$_SESSION[$s_prefix.'image3']))
					{
						$images[] = $folder.$_SESSION[$s_prefix.'image3'];
						$no_image = false;
					}
						
					if(isset($_SESSION[$s_prefix.'image4']) && file_exists($folder.$_SESSION[$s_prefix.'image4']))
					{
						$images[] = $folder.$_SESSION[$s_prefix.'image4'];
						$no_image = false;
					}
					
					if($no_image)
					{
						$images[] = "photos/nia.jpg";
					}
					
					for($i = 0; $i < sizeof($images); $i++)
					{
						echo	'pictures['.$i.'] = new Image();
			pictures['.$i.'].src = \''.$images[$i].'\';
			';
					}
					
				}	
			?>							
			//   -->
		</script>
	
		<script type="text/javascript" src="<?php echo $siteRoot; ?>/_js/slideShow.js"></script>	
			