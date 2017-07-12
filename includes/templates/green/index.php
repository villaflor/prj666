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
<div class="container mb-5">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link active" href="index.php">Home</a>
        <a class="nav-item nav-link text-white" href="products.php">Products</a>
        <a class="nav-item nav-link text-white" href="cart.php">Cart</a>
        <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
    </nav>
</div>
<div class="container mb-5">
    <div class="row">
        <section class="col-md-6">
            <div class="row">
                <section class="col-6 mb-5">
                    <img class="img-thumbnail" src="images/cow.jpg" alt="cow">
                </section>
                <section class="col-6">
                    <img class="img-thumbnail" src="images/cow.jpg" alt="Wecreu Logo">
                </section>
            </div>
            <div class="row">
                <section class="col-6">
                    <img class="img-thumbnail" src="images/cow.jpg" alt="Wecreu Logo">
                </section>
                <section class="col-6">
                    <img class="img-thumbnail" src="images/cow.jpg" alt="Wecreu Logo">
                </section>
            </div>
        </section>

        <section class="col-md-6 pt-5">
            <h2 class="text-center mb-5">
                Cheesy Promo! 50% off by tomorrow! Get your Cows now!
            </h2>
            <h2 class="text-center">
                New Cows in stock! Get it while they last! Also, Chickens coming for Canada Day!
            </h2>
        </section>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
