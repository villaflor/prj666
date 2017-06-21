<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="list of goods in a category" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Goods List</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
		?>
		
		<div class="middle">
		
			<div class="content">
				<h3>Goods in Category:[Category Name] </h3>
				
                <?php
                    include '../../tools/sql.php';
                    echo "Found file";
                    $db = Database::getInstance();
                    echo "got database ";
                    $mysqli = $db->getConnection();
                    echo "getting connection";
                    echo "error connecting " . $mysqli->connect_error;
                    /* echo "error connecting" . $mysqli->connect_errno;
                   $sql_query = "SELECT * FROM good";
                    $result = $mysqli->query($sql_query);

                  while ($row = mysqli_fetch_assoc($result)){
                        echo "$row[good_name]<br/>";
                    }*/
                ?>
				<div class="gooditem">
					<a href="GoodDetail.php">
					Good Name
					<img src="images/fish.png" alt="Good Image" height="120" width="120" style="padding:20px 40px;"/>
					<br />
					$Good Price
					</a>
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