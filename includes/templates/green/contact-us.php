<?php
    /*$clientId = file_get_contents('conf.ini');
    include_once('/data/www/default/quangtest/wecreu/tools/category.php');
    include_once("/data/www/default/quangtest/wecreu/tools/sql.php");
    include_once("/data/www/default/quangtest/wecreu/tools/client.php");

	//create an object
    $db = Database::getInstance();
    $category = new Category($db,$clientId);
    $client = new Client($db,$clientId);*/
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("metadata.php"); ?>
    <title><?php echo $client->getClientSiteTitle(); ?></title>
</head>

<body style="background-color: seagreen">
<header class="mb-5 mt-3" style="height: 20vh; align-content: center;">
    <?php include("header.inc"); ?>
</header>
<div class="container mb-5">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link text-white " href="index.php">Home</a>
        <a class="nav-item nav-link text-white" href="products.php">Products</a>
        <a class="nav-item nav-link text-white" href="cart.php">Cart</a>
        <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
		<a class="nav-item nav-link active" href="about-us.php">Contact us</a>
		<?php
            $alldata = $page->getAll();
            while ($row = mysqli_fetch_assoc($alldata)) {
              echo '<a class="nav-item nav-link text-white" href="page.php?page='.$row['id'].'">'.$row['page_name'].'</a>';
            }
        ?>
    </nav>
</div>
<div class="container mb-5">
 <table style="margin:auto; width:100%; border-style:solid;" >
		<tr>
			<td>Phone number</td>
			<td>Email</td>
		</tr>
		<tr>
			<td><?php echo $client->getClientPhone();?></td>
			<td><?php echo $client->getClientEmail();?></td>
		</tr>
		
 </table>
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>