<!DOCTYPE html>
<?php include 'Header.php';?>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="home page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<title><?php echo $client->getClientSiteTitle();?></title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
		

	</head>
	<body>
		
		<?php
			
           
            include_once '/data/www/default/wecreu/tools/sql.php';
            $clientid = file_get_contents('conf.ini');

            $db = Database::getInstance();

            $query="SELECT good.*, sale.* FROM client JOIN category ON category.client_id = client.client_id JOIN good ON good.category_id = category.category_id JOIN sale ON sale.sale_id = good.sale_id WHERE client.client_id = ".$clientid;
           // echo $query;
            $conn = $db->getConnection();  
            $allsale = $conn->query($query);
            $productName = "";
            $saleName = "";
            $saleAmount = "";
		?>
		
		<div class="middle">
		
			<div class="content">
				
				<div class="slideshow" style="float:left">
                    <img class="slides" src="images/logo.jpg" alt="logo" height="536" width="559" />
                    <?php
                        if($allsale) {
                            while ($row = mysqli_fetch_assoc($allsale)){
                            $productName = "Click an image<br/>to check out<br/>our current<br/>Promos!";//$row['good_name'];
                            $imagepath = "/wecreu/images/".$row['good_image'];
                    ?>
                    <a href="GoodDetail.php?gid=<?php echo "$row[good_id]";?>">
					<img class="slides" src="<?php echo $imagepath; ?>" alt=<?php echo $row['good_name']; ?> height="536" width="559"/>
					</a>
                    <?php
                            }
                        } 
                    ?>
                    <!--<img class="slides" src="images/fish.png" alt="logo" height="536" width="559" />-->
                   
				</div>
			
				<div class="info">
				<!--	<p><?php echo $saleName.":"; ?></p>-->
					<p><?php echo $productName; ?></p>
                <!--    <p><?php echo $saleAmount." % off!"; ?></p>-->
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
		
		
		<script>
			var index = 0;
			carousel();

			function carousel() {
				var i;
				var x = document.getElementsByClassName("slides");
				for (i = 0; i < x.length; i++) {
				   x[i].style.display = "none";  
				}
				index++;
				if (index > x.length) {index = 1}    
				x[index-1].style.display = "block";  
				setTimeout(carousel, 2000); // Change image every 2 seconds
			}//used tutorial at https://www.w3schools.com/w3css/w3css_slideshow.asp
		</script>		
		
		
	</body>
</html>
