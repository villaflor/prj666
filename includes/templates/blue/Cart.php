<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="shopping cart" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Cart</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body style="width:100%;background:linear-gradient(#CAE1FF,#ffffff);">
		
		<?php
			include 'Header.php';
			include 'Menu.php';
		?>
			<div style="padding:50px;">
				<?php require_once 'viewCart.php'; ?>
			</div>

	</body>
</html>