<!DOCTYPE html>
<!--
Red template - good detail page, 
retrieves and provides information about a selected good 
and sale if the good is on sale, 
formatted for RED template

update: August 21 by Olga
Adding sales info and sale adjusted prices
August 31 disable add to cart button when stock 0
-->
<html lang="en">
<?php include_once("headmeta.php");?>
<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->
  <?php include_once("category.php");
  if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
  }
    include_once '/data/www/default/wecreu/tools/discountCalculator.php';

  // getting items
  $alldata = $good->getGoodDetail($_GET['id']);

  if(mysqli_num_rows($alldata) == 0){//if nothing found output error message
    echo "<p class='text-center'>Product not found</p>";
  } else{
    $row = mysqli_fetch_assoc($alldata);
    $calcprice = discountCalculate($_GET['id']);

    $priceentry = "$ ".$row['good_price']; //get database price
    $saleentry = "Not on sale"; //prepare sale info

    if(isset($row['sale_id'])){

        //get sale information if applicable
        $query="SELECT * FROM `sale` WHERE `sale_id` = ".$row['sale_id'];
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
            $priceentry ='<span style="color:#990000;">$ '.$calcprice.'</span> [old <span style="text-decoration:line-through;">$ '.$row['good_price'].'</span>]';

        }else{//if sale not yet started display future sale info and database price
            $saleentry = "Future Sale ".$salerow['sale_name'].", <br/>".$salerow['discount']."% off  starts ".$startdate." ends ".$enddate; 
            $priceentry ="$ ".$row['good_price'];
        }
    }
?>

<div class="col-md-9 col-sm-9 col-xs-9">
  <div class="row">
    <div class="col-xs-4"></div>
    <div class="nnn col-lg-3 col-md-4 col-sm-4 col-xs-3 img-circle float-right clearfix">
      <img src="<?php echo "/wecreu/images/".$row['good_image'];?>" class="img-responsive" alt="<?php echo $row['good_name'];?>" />
      </div>
  </div>
  <br>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix ">
        <table class="table-bordered" width="100%" height="100px">
            <tr>
              <th class="col-md-4">Product Name</th>
              <th class="col-md-4">Category</th>
              <th class="col-md-4">Quantity</th>
            </tr>
          <tbody>
            <tr height="50px">
              <td class="text-center"><?php echo $row['good_name'];?></td>
              <td class="text-center"><?php echo $row['category_name'];?></td>
              <td class="text-center"><?php echo $row['good_in_stock'];?></td>
            </tr>
            <tr>
              <th  class="col-md-4">Description</th>
              <th  class="col-md-4">Weight</th>
              <th  class="col-md-4">Price</th>
            </tr>
            <tr height="50px">
              <td class="text-center"><?php echo $row['good_description'];?></td>
              <td class="text-center"><?php echo $row['good_weight'];?> lbs</td>
              <td class="text-center"><?php echo $priceentry."<br/>".$saleentry; ?></td>
            </tr>
          </tbody>
        </table>
      <br>
      <div class="clearfix centeredImage">
        <?php
        if($row['good_in_stock'] > 0){
        ?>
          <a href="addProducToCart.php?productId=<?php echo $_GET['id']; ?>&qty=1" class="btn btn-danger btn-lg btn-block">Add To Cart</a>
        <?php
        } else {
        ?>
            <span style="color:#990000">Out of stock</span>
        <?php
        }
        ?>
        </div>
        <a class="pull-left" href="good.php" >Back</a>
        </div>
      </div>
<?php
  }
  ?>

  </div>
</div>
  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>
