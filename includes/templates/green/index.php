<?php
    /*include_once('/data/www/default/wecreu/tools/category.php');
    include_once("/data/www/default/wecreu/tools/client.php");
	//create an object
    $category = new Category($db,$clientId);
    $client = new Client($db,$clientId);*/

    include_once("/data/www/default/wecreu/tools/sql.php");
    $clientId = file_get_contents('conf.ini');
    $db = Database::getInstance();

    $query="SELECT sale.* FROM client JOIN category ON category.client_id = client.client_id JOIN good ON good.category_id = category.category_id JOIN sale ON sale.sale_id = good.sale_id WHERE client.client_id = ".$clientId." GROUP BY sale.sale_id LIMIT 4";
  //  echo $query;
    $conn = $db->getConnection();  
    $allsale = $conn->query($query);
    $rowcount = mysqli_num_rows($allsale);
   // echo "rowcount ".$rowcount;

    $saleHeading = array(" ", " ", " ", " ");
   // print_r($saleHeading);

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("metadata.php") ?>
    <title><?php echo $client->getClientSiteTitle(); ?></title>
</head>

<body style="background-color: seagreen">
<header class="mb-5 mt-3" style="height: 20vh; align-content: center;">
    <?php include("header.inc") ?>
</header>
<div class="container mb-5">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link active" href="index.php">Home</a>
        <a class="nav-item nav-link text-white" href="products.php">Products</a>
        <a class="nav-item nav-link text-white" href="cart.php">Cart</a>
        <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
		<?php if ($contact == 1 ){?>
		<a class="nav-item nav-link text-white" href="contact-us.php">Contact us</a>
		<?php } ?>
        <?php
        $alldata = $page->getAll();
        while ($row = mysqli_fetch_assoc($alldata)) {
          echo '<a class="nav-item nav-link text-white" href="page.php?page='.$row['id'].'">'.$row['page_name'].'</a>';
        }
        ?>
    </nav>
</div>
<div class="container mb-5">
    <div class="row">
    <?php
        
        if($rowcount == 0){
           
    ?>
           <h2 class="text-center mb-5"> 
                Welcome! Enjoy your shopping!
           </h2>
 
    <?php
        } else if($rowcount >= 1){
    ?>
        <section class="col-md-6">
    <?php
            for($i = 0; $i < $rowcount; $i++ ){
                $salerow = mysqli_fetch_assoc($allsale);
                $goodquery="SELECT good_id, good_image FROM good WHERE sale_id = ".$salerow['sale_id']." LIMIT 1";
                $goodinfo = $conn->query($goodquery);
                $goodrow = mysqli_fetch_assoc($goodinfo);

                $saleHeading[$i] = $salerow['sale_name']."! "./*substr(*/$salerow['discount']/*, 0, -3)*/."% OFF ".$salerow['sale_description'];

                if($i%2 == 0){
                    echo '<div class="row">';
                }
        ?>
                <section class="col-6 mb-5"  >
                    <a href="detail.php?gid=<?php echo $goodrow['good_id']; ?>" >
                        <img class="img-thumbnail" src=<?php echo "/wecreu/images/".$goodrow['good_image']; ?> alt="cow" />
                    </a>
                </section>
        <?php
                if($i%2 != 0){
                    echo "</div>";
                }
            }
    ?>
        </section>

       <section class="col-md-6 pt-5" >
    <?php
        foreach($saleHeading as $s){
    ?>
             <h2 class="text-center mb-5"> 
                <?php echo $s; ?>
           </h2>
    <?php
        }
    ?>
        </section>
    <?php            
    }
    ?>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
