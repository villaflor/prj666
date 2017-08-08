<!DOCTYPE html>
<html class="no-js">
  <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Tangerine">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/table.css">

  <style>
   .container-m {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: 10px;
        margin-left: 10px;
    }

    .addToCart {
      color: #fff;
      background-color: #5f6d7e;
      border-color: #5f6d7e;
    }

    .addToCart:hover {
      color: #fff;
      background-color: #495461;
      border-color: #495461;
    }

  </style>
  </head>
  <body>


  <div class="container-m bg-faded pt-5 goodlist cf col-md-9 col-sm-12 col-xs-12">


    <?php
    if(!isset($_GET['id'])){
      header("Location: index.php");
      exit;
    }

    $clientId = file_get_contents('conf.ini');
    include_once("/data/www/default/wecreu/tools/sql.php");
    include_once('/data/www/default/wecreu/tools/good.php');
    include_once '/data/www/default/wecreu/tools/discountCalculator.php';

    $db = Database::getInstance();
   // $good = new Good($db,$clientId);
    $good = new Good($db);

    // items
    $alldata = $good->getGoodDetail($_GET['id']);
    if(mysqli_num_rows($alldata) == 0){
      echo "<p class='text-center'>Product not found</p>";
    } else{
      $row = mysqli_fetch_assoc($alldata);
        $imagepath = "/wecreu/images/".$row['good_image'];
    ?>

    <div class="col-md-9 col-sm-9 col-xs-9">
      <div class="row">
        <div class="col-xs-4"></div>
        <div class="nnn col-lg-3 col-md-4 col-sm-4 col-xs-3 img-circle float-right clearfix">
          <img src="<?php echo $imagepath;?>" class="img-responsive" alt="<?php echo $row['good_name']; ?>" >
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
                  <td class="text-center">$<?php echo discountCalculate($row['good_id']);?></td>
                </tr>
              </tbody>
            </table>
          <br>
          <div class="clearfix centeredImage">
           <!-- <button class="btn addToCart btn-lg btn-block">Add To Cart</button>-->
          <a href="cartAction.php?action=addToCart&id=<?php echo $row['good_id']; ?>" class="btn addToCart btn-lg btn-block">Add To Cart</a>

          </div>
          <a class="pull-left" href="good.php" >Back</a>
          </div>
<?php
}
 ?>

  </div>
    </div>
  </div>
  </body>
</html>
