<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('/data/www/default/wecreu/core/init.php');
$ownerId = file_get_contents('conf.ini');
?>

<!doctype html>
<html lang="en">
<head>
    <?php include("metadata.php") ?>
    <title>Green Template</title>
</head>

<body style="background-color: seagreen">
<header class="mb-5 mt-3" style="height: 20vh; align-content: center;">
    <?php include("header.inc") ?>
</header>
<div class="container mb-5">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link text-white" href="index.php">Home</a>
        <a class="nav-item nav-link text-white" href="products.php">Products</a>
        <a class="nav-item nav-link active" href="cart.php">Cart</a>
        <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
        <?php
        if ($contact == 1 ){
            ?>
            <a class="nav-item nav-link text-white" href="contact-us.php">Contact us</a>
            <?php
        }
        $alldata = $page->getAll();
        while ($row = mysqli_fetch_assoc($alldata)) {
            echo '<a class="nav-item nav-link text-white" href="page.php?page='.$row['id'].'">'.$row['page_name'].'</a>';
        }
        ?>
    </nav>
</div>

<table width="250" height="50" border="0" style="margin:auto;">
    <tbody>
    <tr>
        <td style="font-size: 30px; font-weight: bold;">Shopping Cart</td>
        <td><img src="images/28468-200.png" width="35" height="35" alt="cart"/></td>
    </tr>
    </tbody>
</table>

<?php
//$testing = Cookie::getCart($ownerId);
//echo "<pre>";
//print_r($testing);
//echo "</pre>";
require_once "viewCart.php";
?>
<?php include_once("footer.php");?>
</body>
</html>
