<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="good detail page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>About</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
		?>
		
		<div class="middle">
		
			<div class="content">
				
				<div class="goodimage" >
					<img src="images/fish.png" alt="logo" height="200" width="200" />
				</div>
				<div class="goodinfo">
					<p>
					Product Name:  [Name]                            Quantity:  [Quantity]
					<br />
					Category: [Category Name]                        Weight:  [Weight]
					<br />
					Price: [Product Price]                           Color:  [Color] 
					<br />
					Customer Ratings: [Rating]                       Taxable: [Y/N]
					<br />
					Description: [This is a product by FishLand.]
                    <br />
                    <input type="button" class="button" value="Add to Cart" />
					</p>

                    
				</div>
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