<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="shopping cart" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Cart</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
		?>
		
		<div class="middle">
		
			<div class="content">
				<h3 style="margin:1px 300px 40px 300px;">Shopping Cart</h3>
				
				<p>The current contents of your shopping cart are displayed below.</p>
			
					<table>
						<th>
							<td>Name</td> <td>Quantity</td> <td>Price</td> <td> Delete Item</td>
						</th>
						
						<tr>
						<td><img src="images/fish.png" alt="good" height="60" width="60" /></td> 
						<td>[Product Name]</td> 
						<td><select name="quantity">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							</select>
						</td> 
						<td>$[Price] </td> 
						<td><input type="button" class="button" value="Remove" /></td>
						</tr>
						
						<tr>
						<td><img src="images/fish.png" alt="good" height="60" width="60" /></td> 
						<td>[Product Name]</td> 
						<td><select name="quantity">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							</select>
						</td> 
						<td>$[Price] </td> 
						<td><input type="button" class="button" value="Remove" /></td>
						</tr>
						
					</table>
			
				
				<p style="margin: 20px 80px 20px 50px;">Total of [X] items, your total before tax is $[Total price]</p>
				
				<!--<input type="submit" value="To Checkout" class="submit" onclick="Checkout.php"/>-->
                <a href="Checkout.php" class="submit">To Checkout!</a>
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