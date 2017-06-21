<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="shopping cart" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Checkout</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
		?>
		
		<div class="middle">
		
			<div class="content">
				<h3 style="margin:1px 300px 20px 300px;">Checkout</h3>
				
				<form action="/checkout_action.php" method="post">
					Please fill out form:<br /><br />
					Full Name <input type="text" name="fullname" /><br /><br />
					
					Email Address <input type="text" name="email" /><br /><br />
						
					Street Address <input type="text" name="streetaddress" /><br /><br />
					
					City <input type="text" name="city" /><br /><br />
					
					Postal Code <input type="text" name="postalcode" />  State <input type="text" name="state" /><br /><br />
					
					Country <input type="text" name="country" /><br /><br />
					
					Final order [Number] of items for [total price]    Plus Tax(%)  [tax amount]  <br />
					
					Final Total = [total price with tax]<br /><br />
					
					Select Payment Method<br />
					<input type="radio" name="paymentmethod" value="paymentmethod1">Payment Method 1
					<input type="radio" name="paymentmethod" value="paymentmethod1">Payment Method 2
					<input type="radio" name="paymentmethod" value="paymentmethod1">Payment Method 3<br /><br />
					
					Select Shipping Method<br />
					<input type="radio" name="shipmentmethod" value="shipmentmethod1">Shipment Method 1
					<input type="radio" name="shipmentmethod" value="shipmentmethod1">Shipment Method 2	
					<input type="radio" name="shipmentmethod" value="shipmentmethod1">Shipment Method 3<br /><br />
				
					<input type="submit" value="Pay" class="submit" />
				</form>
			</div>
			
			<?php
				include 'Categories.php';
			?>
		
		</div>
		
		<?php
			include 'Menu.php';
		?>
		
		<?php
			include 'Footer.php';
		?>
	</body>
</html>