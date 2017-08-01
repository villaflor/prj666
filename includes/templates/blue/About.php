<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="company page" />
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
				<?php
				/*$clientId = file_get_contents("conf.ini");
				$url = "/data/www/default/wecreu/companyInfo/aboutUs/".$clientId.".txt";
				if (file_exists($url)) {
					$content = file_get_contents($url);
				echo $content;
				}*/
				?>
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
