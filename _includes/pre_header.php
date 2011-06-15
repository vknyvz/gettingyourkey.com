<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="<?php echo $siteRoot; ?>/_css/global.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $siteRoot; ?>/_css/listings.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $siteRoot; ?>/_css/niftyCorners.css" type="text/css" rel="stylesheet" />

		<!--[if IE]>
		<link href="_css/ie_fixes.css" type="text/css" rel="stylesheet" />
		<![endif]-->
        
        <!--[if gte IE 7]>
        <link href="_css/ie7_fixes.css" type="text/css" rel="stylesheet" />            	
		<![endif]-->
		<script type="text/javascript" src="<?php echo $siteRoot; ?>/_js/common.js"></script>
		<script type="text/javascript" src="<?php echo $siteRoot; ?>/_js/niftyCube.js"></script>

		<script type="text/javascript">
			window.onload=function()
			{
				Nifty("div#search","normal transparent");
				Nifty("div#rightColumn","normal transparent");
				Nifty("div#user_menu","normal transparent");

				<?php
					if(strpos($url, "detail.php") != false)
					{
						echo 'Nifty("div.information","normal transparent");
				';
						echo 'resume();
';
					}
					elseif(strpos($url, "submit.php") != false)
					{
						echo 'Nifty("div#submit_form","normal transparent");
				';

					}
					elseif(strpos($url, "preview.php") != false)
					{
						echo 'Nifty("div.information","normal transparent");
				';
						echo 'resume();
';
					}
					elseif((strpos($url, "register.php") != false ) || (strpos($url, "register2.php") != false ))
					{
						echo 'Nifty("div#register_form","normal transparent");
				';

					}
				?>
			}	
		</script>
		
		<?php
			if(strpos($url, "detail.php") != false || strpos($url, "preview.php") != false)
			{
				require_once('_includes/slide_show.php');
			}
		?>

		<title><?php echo $siteTitle; ?></title>
	</head>
	
	<body>