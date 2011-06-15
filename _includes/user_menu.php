<div id="user_menu">

	<?php
		if(!loggedIn())
		{
	?>	
            <ul>
            	<li><a href="<?php echo $siteRoot; ?>/index.php">Login</a></li>
				<li><a href="<?php echo $siteRoot; ?>/register.php">Register</a></li>                
			</ul>
	<?php
		}
		else
		{
			$unread = countUnreadMessages();
	?>	
			<ul>
            	<li><a href="<?php echo $siteRoot; ?>/my.php">My home</a></li>
				<li><a href="<?php echo $siteRoot; ?>/submit.php">Submit a listing</a></li>
                <li><a href="<?php echo $siteRoot; ?>/messaging.php">Private messaging<?php if($unread > 0){ echo ' <strong>('.$unread.')</strong>';} ?></a></li>
				<li><a href="<?php echo $siteRoot; ?>/account.php">My account</a></li>
                <li><a href="<?php echo $siteRoot; ?>/index.php?logout">Logout</a></li>
			</ul>
			
	<?php
		}
	?>
</div>