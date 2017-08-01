<?php $contact = file_get_contents('contact.ini');?>
<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		<!--<li><a href="index.php">Help</a></li>-->
		<li><a href="viewCart.php">Shopping Cart</a></li>
		<li><a href="About.php">About</a></li>
		<?php if ($contact == 1 ){ ?>
		<li><a href="contact-us.php">Contact us</a></li>
		<?php }?>
	</ul>
</nav>