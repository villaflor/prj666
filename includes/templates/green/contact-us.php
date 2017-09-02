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
	
	<!--<h2 style="margin:auto; width:30%; font-style:italic;">CONTACT VIA PHONE: <span style="font-size:25px; font-weight: 400px;"><?php //echo $client->getClientPhone();?></span></h2>
	
	<h2 style="margin:auto; width:30%; font-style:italic; padding-top:40px;">CONTACT VIA EMAIL: <span style="font-size:25px; font-weight: 400px;"><a href="mailto:<?php //echo $client->getClientEmail();?>"><?php //echo $client->getClientEmail();?></a></span></h2>
	-->
	<table style="width:50%; margin:auto;table-layout:fixed;border-style: groove;">
		<tr>
			<th style="background-color: orangered;">INFORMATION</th>
			<th style="padding-left:20px;background-color: orangered;">CONTACT</th>
		</tr>
		<tr>
			<td rowspan="2" style="word-wrap:break-word; overflow-wrap: break-word; padding-top:30px;"><?php echo $client->getClientInfo();?></td>
			<td style="padding-top:30px; padding-left:20px;"><span style="font-style: italic; font-weight:600;">VIA PHONE:</span> <?php echo "(" . substr($client->getClientPhone(),0, 3) . ") " . substr($client->getClientPhone(),3, 3) . "-" . substr($client->getClientPhone(),6, 10);?></td>
		</tr>
		<tr>
			<td style="padding-left:20px; padding-top:25px"><span style="font-style: italic; font-weight:600;">VIA EMAIL:</span> <a href="mailto:<?php echo $client->getClientEmail();?>">Mail to the seller</a></td>
		</tr>
	</table>
	
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>