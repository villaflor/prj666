<?php
/*
Green template - good detail page, 
retrieves and provides information about a selected good 
and sale if the good is on sale, 
formatted for GREEN template

update: August 21 by Olga
Adding sales info and sale adjusted prices
update august 31:disable button when out of stock
*/

include_once '/data/www/default/wecreu/tools/sql.php';
include_once '/data/www/default/wecreu/tools/good.php';
include_once '/data/www/default/wecreu/tools/discountCalculator.php';

$db = Database::getInstance();
$good = new Good($db);
//    echo "getting good object";
$alldata = $good->getGoodDetail($_GET["gid"]);

$Grow = mysqli_fetch_assoc($alldata);
$imagepath = "/wecreu/images/".$Grow['good_image'];
$calcprice = discountCalculate($_GET["gid"]);

$priceentry = "$ ".$Grow['good_price']; //get database price
$saleentry = "Not on sale"; //prepare sale info

if(isset($Grow['sale_id'])){

    //get sale information if applicable
    $query="SELECT * FROM `sale` WHERE `sale_id` = ".$Grow['sale_id'];
 //   echo $query;
    $conn = $db->getConnection();  
    $datasale=$conn->query($query);
    $salerow=mysqli_fetch_assoc($datasale);

    $startdate = date("Y-m-d", strtotime($salerow['start_date']));
    $enddate = date("Y-m-d", strtotime($salerow['end_date']));
    $todaydate = date("Y-m-d");

    //check if sale started, prepare sale info and update price label
    if($todaydate >= $startdate && $todaydate <= $enddate){

        $saleentry = "Current Sale ".$salerow['sale_name'].", <br/>".$salerow['discount']."% off  from ".$startdate." to ".$enddate; 
        $priceentry ='<span style="color:#990000;">$ '.$calcprice.'</span> [old <span style="text-decoration:line-through;">$ '.$Grow['good_price'].'</span>]';

    }else{//if sale not yet started display future sale info and database price
        $saleentry = "Future Sale ".$salerow['sale_name'].", <br/>".$salerow['discount']."% off  starts ".$startdate." ends ".$enddate; 
        $priceentry ="$ ".$Grow['good_price'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("metadata.php") ?>
    <title></title>
</head>

<body style="background-color: seagreen">
<header class="mb-5 mt-3" style="height: 20vh; align-content: center;">
    <?php include("header.inc") ?>
</header>
<div class="container mb-2">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link text-white" href="index.php">Home</a>
        <a class="nav-item nav-link active" href="products.php">Products</a>
        <a class="nav-item nav-link text-white" href="cart.php">Cart</a>
        <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
    </nav>
</div>
<div class="container mb-5">
    <nav class="nav nav-pills nav-fill">
      <?php
          $alldata = $category->getAllAvaliable();
          echo "<a class='nav-item nav-link text-white' href='products.php'>All categories</a>";
          while ($row = mysqli_fetch_assoc($alldata)) {
              echo "<a class='nav-item nav-link text-white' href='products.php?cid=$row[category_id]'>$row[category_name]</a>";
          }
          ?>
    </nav>
</div>
<div class="container mb-5">
    <div class="text-center mb-5">
        <img src="<?php echo $imagepath;?>" alt="cow" class="rounded" width="300" height="300">
    </div>

    <div class="container text-center">
        <div class="container row">
            <section class="col-md-6"><p>Product Name: <?php echo "$Grow[good_name]";  ?></p></section>
            <section class="col-md-6"><p>Quantity: <?php echo "$Grow[good_in_stock]";  ?></p></section>
        </div>
        <div class="container row">
            <section class="col-md-6"><p>Category: <?php echo "$Grow[category_name]";  ?></p></section>
            <section class="col-md-6"><p>Weight: <?php echo "$Grow[good_weight]";  ?> lbs</p></section>
        </div>
        <div class="container row">
            <section class="col-md-6"><p>Description: <?php echo "$Grow[good_description]";  ?></p></section>
            <section class="col-md-6"><p>Price: <?php echo $priceentry."<br/>".$saleentry;  ?></p></section>
        </div>
    </div>

    <div class="container text-center mb-5">
        <div class="container row">
        <section class="col-sm-6">
            <?php
                if($Grow['good_in_stock'] > 0){
            ?>
                <a class="btn btn-warning" style="width:120px" href="addProducToCart.php?productId=<?php echo $_GET['gid']; ?>&qty=1">Add to cart</a>
            <?php
            } else {
            ?>
                <span style="color:#990000">Out of stock</span>
            <?php
            }
            ?>
            </section>
        <section class="col-sm-6">
            <a href="products.php" style="width:120px" class="btn btn-danger">Back</a></section>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
