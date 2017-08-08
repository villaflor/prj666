  <?php
  //include_once("/data/www/default/wecreu/tools/sql.php");
  //$db = Database::getInstance();

    include_once '/data/www/default/wecreu/tools/sql.php';
    $clientid = file_get_contents('conf.ini');

    $db = Database::getInstance();

    $query="SELECT sale.* FROM client JOIN category ON category.client_id = client.client_id JOIN good ON good.category_id = category.category_id JOIN sale ON sale.sale_id = good.sale_id WHERE client.client_id = ".$clientid." GROUP BY sale.sale_id";
   // echo $query;
    $conn = $db->getConnection();  
    $allsale = $conn->query($query);
    $rowcount = mysqli_num_rows($allsale);
   
?>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <h1> Promotions </h1>
    <hr/>
<?php
    if($rowcount > 0){
        for($i = 0; $i < $rowcount; $i++ ){
            //echo "i = ".$i;
            $row = mysqli_fetch_assoc($allsale);
            $goodquery="SELECT good_id, good_image FROM good WHERE sale_id = ".$row['sale_id']." LIMIT 1";
            $goodinfo = $conn->query($goodquery);
            $goodrow = mysqli_fetch_assoc($goodinfo);
	    $imagepath = "/wecreu/images/".$goodrow['good_image'];	
  ?>
        <div class="row pro-container">
        <?php
            if($i%2 != 0){
        ?>
          <div class="col-md-6 pro-image">
            <img src="<?php echo $imagepath; ?>" height="300" width="400" />
          </div>
        <?php
            }
        ?>
          <div class="col-md-6 pro-txt">
            <h3><?php echo $row['sale_name']; ?></h3>
            <p class="desc"><?php echo $row['sale_description']; ?></p>
            <p class="pro-off"><?php echo /*substr(*/$row['discount']/*, 0, -3)*/."% OFF"; ?></p>
            <a href="cartAction.php?action=addToCart&id=<?php echo $goodrow['good_id']; ?>" class="btn btn-danger btn-lg">Add To Cart</a>
            <a href="detail.php?id=<?php echo $goodrow['good_id']; ?>" class="btn btn-danger btn-lg pro-btn-right">See Full Details</a>
            
          </div>
        <?php
            if($i%2 == 0){
        ?>
          <div class="col-md-6 pro-image">
            <img src="<?php echo $imagepath; ?>" height="300" width="400" />
          </div>
        <?php
            }
        ?>
        </div>
        <hr/>
<?php
        }
    } else {
?>
        <h3>No sales are currently available!</h3>
<?php
    }
?>
   
  </div>



  <?php
  ?>
