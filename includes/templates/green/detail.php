<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Green Template</title>
</head>

<body style="background-color: seagreen">
<header class="mb-sm-5" style="height: 20vh; align-content: center;">
    <div class="container">
        <div class="row">
            <section class="col-1">
                <img src="images/logo.png" alt="Wecreu Logo" class="rounded-circle" style="width: 100px;">
            </section>
            <section class="col-11">
                <h1 class="text-right text-sm-center" style="font-size: 50px">Wecreu</h1>
            </section>
        </div>
    </div>
</header>
<div class="container mb-2">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link text-white" href="index.php">Home</a>
        <a class="nav-item nav-link active" href="products.php">Products</a>
        <a class="nav-item nav-link text-white" href="cart.php">Cart</a>
        <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
    </nav>
</div>
<div class="container mb-5">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link active" href="#">All categories</a>
        <a class="nav-item nav-link text-white" href="#">Category 1</a>
        <a class="nav-item nav-link text-white" href="#">Category 2</a>
    </nav>
</div>
<div class="container mb-5">
    <div class="text-center mb-5">
        <img src="images/cow.jpg" alt="cow" class="rounded">
    </div>
    <div class="container text-center mb-5">
        <div class="container row">
        <section class="col-sm-6"><button type="button" class="btn btn-primary" style="width: 150px">Add to cart</button></section>
        <section class="col-sm-6"><button type="button" class="btn btn-default" style="width: 150px">Back</button></section>
        </div>
    </div>
    <div class="container text-center">
        <div class="container row">
            <section class="col-md-6"><p>Product Name: Whole Cow</p></section>
            <section class="col-md-6"><p>Quantity: 100</p></section>
        </div>
        <div class="container row">
            <section class="col-md-6"><p>Category: Food</p></section>
            <section class="col-md-6"><p>Weight: 1000-2000 lbs</p></section>
        </div>
        <div class="container row">
            <section class="col-md-6"><p>Description: Whole sale cow</p></section>
            <section class="col-md-6"><p></p></section>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
