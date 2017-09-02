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
				<!--<table style="margin:auto; width:100%; border-style:solid;" >
					<tr>
						<td>Phone number</td>
						<td>Email</td>
					</tr>
					<tr>
						<td><?php //echo $client->getClientPhone();?></td>
						<td><?php //echo $client->getClientEmail();?></td>
					</tr>
				</table>-->
				<table style="width:75%; margin:auto;table-layout:fixed;border-style: groove;">
					<tr>
						<th style="background-color: gainsboro;">INFORMATION</th>
						<th style="padding-left:20px;background-color: gainsboro;">CONTACT</th>
					</tr>
					<tr>
						<td rowspan="2" style="word-wrap:break-word; overflow-wrap: break-word; padding-top:30px;"><?php echo $client->getClientInfo();?></td>
						<td style="padding-top:30px; padding-left:20px;"><span style="font-style: italic; font-weight:600;">VIA PHONE:</span> <?php echo "(" . substr($client->getClientPhone(),0, 3) . ") " . substr($client->getClientPhone(),3, 3) . "-" . substr($client->getClientPhone(),6, 10);?></td>
					</tr>
					<tr>
						<td style="padding-left:20px;"><span style="font-style: italic; font-weight:600;">VIA EMAIL:</span> <a href="mailto:<?php echo $client->getClientEmail();?>">Mail to the seller</a></td>
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
