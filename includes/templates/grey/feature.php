<!DOCTYPE html>
 <!-- Grey-Template- Promotion section. 
    Contains promotions for current and upcoming sales that 
    feature an image of a random good a sale applies to
    and include links to cart, good detail pages
    Edit August 21 - adding sale dates to sale entries and link to future cart by Olga 
  -->
<html class="no-js">
  <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Tangerine">
  <link rel="stylesheet" href="css/main.good.css">
  <link rel="stylesheet" href="css/promotion.css">
  <link rel="stylesheet" href="css/table.css">

  <style>
   .container-m {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: 10px;
        margin-left: 10px;
    }

  </style>
  </head>
  <body>
      <?php
        //getting list of applicable sales
        include_once '/data/www/default/wecreu/tools/sql.php';
        $clientid = file_get_contents('conf.ini');
        $db = Database::getInstance();

        $query="SELECT sale.* FROM client JOIN category ON category.client_id = client.client_id JOIN good ON good.category_id = category.category_id JOIN sale ON sale.sale_id = good.sale_id WHERE client.client_id = ".$clientid." GROUP BY sale.sale_id";
       // echo $query;
        $conn = $db->getConnection();
        $allsale = $conn->query($query);
        $rowcount = mysqli_num_rows($allsale);

      ?>

  <div class="container-m bg-faded pt-5 goodlist cf col-md-9 col-sm-12 col-xs-12">
    <h1> Promotions </h1>
    <hr/>
    <?php
        //if sales exist display a promo for each on the promo section
        if($rowcount > 0){

            for($i = 0; $i < $rowcount; $i++ ){

                //get info of one good on a sale and display it
                $row = mysqli_fetch_assoc($allsale);
                $goodquery="SELECT good_id, good_image FROM good WHERE sale_id = ".$row['sale_id']." LIMIT 1";
                $goodinfo = $conn->query($goodquery);
                $goodrow = mysqli_fetch_assoc($goodinfo);
                $imagepath = "/wecreu/images/".$goodrow['good_image'];
                $startdate = date("Y-m-d", strtotime($row['start_date']));
                $enddate = date("Y-m-d", strtotime($row['end_date']));
      ?>
    <div class="row pro-container">
        <?php
            //alternating format
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
        <p class="desc"><?php echo $row['sale_description']."<br/>from ".$startdate." until ".$enddate; ?></p>
        <p class="pro-off"><?php echo $row['discount']."% OFF"; ?></p>
        <a href="addProducToCart.php?productId=<?php echo $goodrow['good_id']; ?>&qty=1" class="btn pro-btn-color btn-lg">Add To Cart</a>
        <a href="detail.php?id=<?php echo $goodrow['good_id']; ?>" class="btn pro-btn-color btn-lg pro-btn-right">See Full Details</a>

      </div>
        <?php
            //alternating format
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
  </body>
</html>
