<?php
/*
* This file is called after order has been successfully added to the database,
* it notifies the customer of successful order
* and deletes cookie containing customer information
*/

require_once('/data/www/default/wecreu/core/init.php');

 $ownerId = file_get_contents('conf.ini');
 Cookie::delete($ownerId);
            

if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="description" content="shopping cart" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Cart</title>
    <link rel="stylesheet" href="css/stylesheet.css" />
    <style>
    .container{width: 100%;padding: 50px;}
    p{color: #000000;font-size: 18px;}
    </style>
</head>
<body >
    <?php
        include 'Header.php';
    ?>
    
    <div class="middle">
    
        <div class="content"> 
            <div class="container">

                <h1>Order Status</h1>
                <p>Your order has submitted successfully. Order ID is #<?php echo $_GET['id']; ?>. Please check your mail for your receipt.</p>
                <div class="col-md-6">
                    <a class="button" href="index.php">Back</a>
                </div>
                
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