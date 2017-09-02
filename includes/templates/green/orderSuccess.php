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
    <?php include("metadata.php") ?>
    <title>Order Success</title>
    <meta charset="utf-8">
    <style>
    .container{width: 100%;padding: 50px;}
    p{color: #34a853;font-size: 18px;}
    </style>
</head>
<body style="background-color: seagreen">
    <header class="mb-5 mt-3" style="height: 20vh; align-content: center;">
        <?php include("header.inc") ?>
    </header>
    <div class="container mb-5">
        <nav class="nav nav-pills nav-fill">
            <a class="nav-item nav-link text-white" href="index.php">Home</a>
            <a class="nav-item nav-link text-white" href="products.php">Products</a>
            <a class="nav-item nav-link active" href="cart.php">Cart</a>
            <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
            <?php
            if ($contact == 1 ){
                ?>
                <a class="nav-item nav-link text-white" href="contact-us.php">Contact us</a>
                <?php
            }
            $alldata = $page->getAll();
            while ($row = mysqli_fetch_assoc($alldata)) {
                echo '<a class="nav-item nav-link text-white" href="page.php?page='.$row['id'].'">'.$row['page_name'].'</a>';
            }
            ?>
        </nav>
    </div>
  
    <div class="container">

        <h1>Order Status</h1>
        <p>Your order has submitted successfully. Order ID is #<?php echo $_GET['id']; ?>. Please check your mail for your receipt.</p>
        <div class="col-md-6">
            <a class="btn btn-success" href="index.php">Back</a>
        </div>
        
    </div>
</body>
</html>