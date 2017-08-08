<?php
include '/data/www/default/wecreu/tools/sql.php';
include '/data/www/default/wecreu/tools/good.php';
include '/data/www/default/wecreu/tools/csql.php';
include_once '/data/www/default/wecreu/tools/discountCalculator.php';

//get rows query
//$query = $dbc->query("SELECT * FROM good ORDER BY good_id");
//$cc = $query->fetch_assoc();

$db = Database::getInstance();
$good = new Good($db);
$alldata = $good->getGoodDetail($_GET["gid"]);

$goodrow = mysqli_fetch_assoc($alldata);
$calcprice = discountCalculate($_GET["gid"]);
$imagepath = "/wecreu/images/".$goodrow['good_image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("metadata.php") ?>
    <title>Green Template</title>
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
    <nav class="nav nav-pills nav-fill">
      <?php
          $alldata = $category->getAll();
          echo "<a class='nav-item nav-link text-white' href='products.php'>All categories</a>";
          while ($row = mysqli_fetch_assoc($alldata)) {
              echo "<a class='nav-item nav-link text-white' href='products.php?cid=$row[category_id]'>$row[category_name]</a>";
          }
          ?>
    </nav>
</div>
<div class="container mb-5">
    <div class="text-center mb-5">
        <img src="<?php echo $imagepath; ?>" alt="good image" class="rounded">
    </div>
    <div class="container text-center mb-5">
        <div class="container row">
        <section class="col-sm-6"><button type="button" class="btn btn-primary" style="width: 150px">
                <a class="text-white" href="cartAction.php?action=addToCart&id=<?php echo "$goodrow[good_id]"; ?>">Add to cart</a>
            </button></section>
        <section class="col-sm-6"><button type="button" class="btn btn-default" style="width: 150px">Back</button></section>
        </div>
    </div>
    <div class="container text-center">
        <div class="container row">
            <section class="col-md-6"><p>Product Name: <?php echo "$goodrow[good_name]";  ?></p></section>
            <section class="col-md-6"><p>Quantity: <?php echo "$goodrow[good_in_stock]";  ?></p></section>
        </div>
        <div class="container row">
            <section class="col-md-6"><p>Category: <?php echo "$goodrow[category_name]";  ?></p></section>
            <section class="col-md-6"><p>Weight: <?php echo "$goodrow[good_weight]";  ?> lbs</p></section>
        </div>
        <div class="container row">
            <section class="col-md-6"><p>Description: <?php echo "$goodrow[good_description]";  ?></p></section>
            <section class="col-md-6"><p>Price: $ <?php echo $calcprice;  ?></p></section>
 
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
