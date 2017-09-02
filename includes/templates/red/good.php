<!DOCTYPE html>
<!--
Red template - Good List page, 
retrieves and provides a list of goods for a selected category, 
formatted for RED template

updated August 21 by Olga
Fixing price displays
-->
<html lang="en">
<?php include_once("headmeta.php");?>
<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->
  <?php include_once("category.php");?>

<div class="col-md-9 col-sm-9 col-xs-9 goodlist cf">

<?php
require_once("/data/www/default/wecreu/tools/search.php");
include_once("/data/www/default/wecreu/tools/sql.php");
include_once '/data/www/default/wecreu/tools/discountCalculator.php';

$db = Database::getInstance();

//create an object
$search = new Search($db,$clientId);

// call get all
$limit=12;
if(isset($_GET['offSet'])){
  $offSet=$_GET['offSet'];
}else{
  $offSet=0;
}

if(!isset($_GET['cid'])){
  // header("Location: index.php");
  $alldata = $search->getAll($limit,$offSet);
  $num=$limit+$offSet;
  $last="?offSet=$num";
  $num=$offSet-$limit;
  $pre="?offSet=$num";

  // count number of items on next page
  $nextAlldata = $search->getAll($limit,$offSet+$limit);
  $nextTotal=mysqli_num_rows($nextAlldata);
} else{
  $cid=$_GET['cid'];
  $alldata = $good->getGoodRows($cid, $clientId, $limit, $offSet);
  $num=$limit+$offSet;
  $last="?cid=$cid&offSet=$num";
  $num=$offSet-$limit;
  $pre="?cid=$cid&offSet=$num";

  // count number of items on next page
  $nextAlldata = $good->getGoodRows($cid, $clientId, $limit, $offSet+$limit);
  $nextTotal=mysqli_num_rows($nextAlldata);
}
$total=mysqli_num_rows($alldata);
if($total == 0){
  echo "Sorry, we can't find any record.";
}
while ($row = mysqli_fetch_assoc($alldata)) {
  ?>
  <div class="item col-md-12 col-sm-4 col-xs-4">
    <a href='detail.php?id=<?php echo $row['good_id'];?>'>
       <img src="<?php echo "/wecreu/images/".$row['good_image'];?>" class="img-responsive" alt="<?php echo $row['good_name'];?>">
      <p>
        <?php
        $name = $row['good_name'];
        $length = strlen($name);
        if ($length > 16){
          $name = substr($name, 0 ,16)."...";
        }
        echo $name;
        ?>
      </p> <p><?php 
                    $calcprice=discountCalculate($row['good_id']);//display current price from database or with discount
                    if(isset($row['sale_id'])&& $calcprice != $row['good_price']){
                        echo '<span style="color:#990000;">$'.$calcprice.'</span> [<span style="text-decoration:line-through;">$'.$row['good_price'].'</span>]';
                    } else {
                        echo "$".$row['good_price'];
                    }
                ?></p>
    </a>
</div>
<?php
}

?>
</div>
</div>
  <div class="row">
    <div class="btn-group pull-right" role="group" aria-label="...">
      <?php
      if($offSet!=0){
        echo '<a href="'.$pre.'" class="btn" role="button">Previous page</a>';
      }
      if($total == $limit){
        if($nextTotal != 0) {
          echo '<a href="'.$last.'" class="btn" role="button">Next page</a>';
        }
      }
      ?>
    </div>
  </div>
</div>

</div>
<!-- footer -->
<?php include_once("footer.php");?>
</body>
</html>
