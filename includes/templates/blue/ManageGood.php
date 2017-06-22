<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="list of goods in a category" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Manage Goods</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
		?>
		
		<div class="middle">
		
			<div class="content">
				<a href="CreateGood.php"class="button">Add new good</a>
				
				<table>
					<tr><th>Image</th><th>Name</th><th>Price</th><th style="width:150px">Action</th></tr>
					<tr>
						<td><img src="images/fish.png" alt="Good Image" height="70" width="70" /></td><!--style="padding:20px 40px;"-->
						<td>Good Name</td>
						<td>$Good Price</td>
						<td style="width:200px"><a href="GoodDetail.html" class="button" style="width:60px; float:left;">Edit</a><a href="GoodDetail.html" class="button" style="width:60px;float:right;">Delete</a></td>
					</tr>
				</table>
			
				
			
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