<!DOCTYPE html>
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
	
  // items
  $alldata = $good->getGoodDetail($_GET['id']);
  if(mysqli_num_rows($alldata) == 0){
    echo "<p class='text-center'>Product not found</p>";
  } else{
    $row = mysqli_fetch_assoc($alldata);
?>

<div class="col-md-9 col-sm-9 col-xs-9">
  <div class="row">
    <div class="col-xs-4"></div>
    <div class="nnn col-lg-3 col-md-4 col-sm-4 col-xs-3 img-circle float-right clearfix">
      <img src="<?php echo "../wecreu/images/".$row['good_image'];?>" class="img-responsive" alt="http://th25.st.depositphotos.com/5142301/7567/v/450/depositphotos_75677235-stock-illustration-lion-head-logo.jpg" />
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
              <td class="text-center">$<?php echo $row['good_price'];?></td>
            </tr>
          </tbody>
        </table>
      <br>
      <div class="clearfix centeredImage">
          <a href="cartAction.php?action=addToCart&id=<?php echo $_GET['id']; ?>" class="btn btn-danger btn-lg btn-block">Add To Cart</a>
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
