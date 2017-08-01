<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="company page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Contact us</title>
		<link rel="stylesheet" href="css/stylesheet.css" />

	</head>
	<body>

		<?php
			include 'Header.php';
		?>

		<div class="middle">
			<div class="content">
				<?php
				/*$clientId = file_get_contents("conf.ini");
				$url = "/data/www/default/wecreu/companyInfo/aboutUs/".$clientId.".txt";
				if (file_exists($url)) {
					$content = file_get_contents($url);
				echo $content;
				}*/
				?>
				<table style="margin:auto; width:100%; border-style:solid;" >
					<tr>
						<td>Phone number</td>
						<td>Email</td>
					</tr>
					<tr>
						<td><?php echo $client->getClientPhone();?></td>
						<td><?php echo $client->getClientEmail();?></td>
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
