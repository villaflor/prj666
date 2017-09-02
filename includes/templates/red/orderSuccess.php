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
<?php include_once("headmeta.php");?>
<body>
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->
  <?php include_once("category.php");?>

    <div class="container">
        <h1>Order Status</h1>
        <p>Your order has submitted successfully. Order ID is #<?php echo $_GET['id']; ?>. Please check your mail for your receipt.</p>
        
        <div class="col-md-6">
            <a class="btn btn-success" href="index.php">Back</a>
        </div>
        
    </div>
</div>
<!-- footer -->
<?php include_once("footer.php");?>
</body>
</html>