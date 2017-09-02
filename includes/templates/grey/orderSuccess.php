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

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

 
<br>

<div class="row">
    <div class="col-md-8 col-sm-8 col-xs-8">
        <div class="container-fluid">
        <h1>Order Status</h1>
        <p>Your order has been submitted successfully. Order ID is #<?php echo $_GET['id']; ?>. Please check your mail for your receipt.</p>
        <div class="col-md-6">
            <a class="btn btn-success" href="feature.php">Back</a>
        </div>
        </div>
    </div>
</div>