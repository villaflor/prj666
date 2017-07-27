<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="index.php">Help</a></li>
		<li><a href="cart.php">Shopping Cart</a></li>
		<li><a href="About.php">About</a></li>
		<?php
		$alldata = $page->getAll();
		while ($row = mysqli_fetch_assoc($alldata)) {
			echo '<li><a href="page.php?page='.$row['id'].'">'.$row['page_name'].'</a></li>';
		}
		?>
		<li><a href="manage-good.php">Settings</a></li>
	</ul>
</nav>
