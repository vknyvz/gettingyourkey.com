<div id="rightColumn">
	<?php
		if(!loggedIn())
		{
	?>
			<div id="login">
				<h1>User login</h1>
				<form method="post" action="?login">
					Username<br />
					<input type="text" name="username" value="" /><br />
					Password<br />
					<input type="password" name="password" class="password" value="" />
					<input type="submit" value="Login" class="login" />
				</form>
				<br />
				<a href="<?php echo $siteRoot; ?>/register.php">Registration</a>
			</div>
	<?php
		}
		else
		{
			$unread = countUnreadMessages();
	?>
			<div id="rightContent">
	
    		<a href="<?php echo $siteRoot; ?>/my.php">My home</a><br /><br />	
			<a href="<?php echo $siteRoot; ?>/submit.php">Submit a listing</a><br /><br />	
            <a href="<?php echo $siteRoot; ?>/messaging.php">Private messaging<?php if($unread > 0){ echo ' <strong>('.$unread.')</strong>';} ?></a><br /><br />		
			<a href="<?php echo $siteRoot; ?>/account.php">My account</a><br /><br />
            <a href="<?php echo $siteRoot; ?>/index.php?logout">Logout</a>
	
			</div>
	<?php
		}
	?>
</div>