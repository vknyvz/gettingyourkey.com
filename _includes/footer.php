<div id="footer">
	<div class="wrap">
    	<br />
		<ul id="footer">
        	<li><a href="<?php echo $siteRoot; ?>/index.php">home</a></li>
            <li><a href="<?php echo $siteRoot; ?>/listings.php?show=apartment">apartment</a></li>
            <li><a href="<?php echo $siteRoot; ?>/listings.php?show=house">house</a></li>
            <li><a href="<?php echo $siteRoot; ?>/listings.php?show=loft">loft</a></li>
            <li><a href="<?php echo $siteRoot; ?>/contact.php">contact</a></li>
            <li><a href="<?php echo $siteRoot; ?>/about.php">about</a></li>
            
            <?php
				if($admin)
					echo '<br /><br /><br /><li><strong><a href="'.$siteRoot.'/admin/">admin panel</a></strong></li>';
			?>
        </ul>

		<div id="copyright">
			All content &copy; Copyright 2007 E-Real Services, Inc.
		</div>
	</div>
</div>