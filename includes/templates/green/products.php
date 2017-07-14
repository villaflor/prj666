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
    </nav>
</div>
<div class="container mb-5">
    <nav class="nav nav-pills nav-fill">
        <?php
        $alldata = $category->getAllAvaliable();
        $active="";
        if(!isset($_GET['cid'])){
            $active = 'active';
        }
        echo "<a class='nav-item nav-link text-white $active' href='products.php'>All categpries</a>";
        while ($row = mysqli_fetch_assoc($alldata)) {
            if (isset($_GET['cid']) && $row['category_id'] == $_GET['cid']){
                $active = 'active';
            }else{
                $active = '';
            }
            echo "<a class='nav-item nav-link text-white $active' href='?cid=$row[category_id]'>$row[category_name]</a>";
        }
        ?>
    </nav>
</div>
<div class="container mb-5">
    <div class="input-group mb-5">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
        <button class="btn btn-secondary" type="button">Search!</button>
      </span>
    </div>

    <div class="row text-center">
        <section class="col-md-3">
            <p>WHOLE COW</p>
            <a href="detail.php"><img class="img-thumbnail" src="images/cow.jpg" alt="cow"> </a>
            <p>Price: $10 / lb</p>
        </section>
        <section class="col-md-3">
            <p>MEAT</p>
            <a href="detail.php"><img class="img-thumbnail" src="images/cow.jpg" alt="cow"> </a>
            <p>Price: $10 / lb</p>
        </section>
        <section class="col-md-3">
            <p>HEAD</p>
            <a href="detail.php"><img class="img-thumbnail" src="images/cow.jpg" alt="cow"> </a>
            <p>Price: $10 / lb</p>
        </section>
        <section class="col-md-3">
            <p>FOOT</p>
            <a href="detail.php"><img class="img-thumbnail" src="images/cow.jpg" alt="cow"> </a>
            <p>Price: $10 / lb</p>
        </section>

    </div>
    <div class="row text-center">
        <section class="col-md-3">
            <p class="text-center">MILK</p>
            <a href="detail.php"><img class="img-thumbnail" src="images/cow.jpg" alt="cow"> </a>
            <p class="text-center">Price: $10 / lb</p>
        </section>
        <section class="col-md-3">
            <p>NOSE</p>
            <a href="detail.php"><img class="img-thumbnail" src="images/cow.jpg" alt="cow"> </a>
            <p>Price: $10 / lb</p>
        </section>
        <section class="col-md-3">
            <p>RIBS</p>
            <a href="detail.php"><img class="img-thumbnail" src="images/cow.jpg" alt="cow"> </a>
            <p>Price: $10 / lb</p>
        </section>
        <section class="col-md-3">
            <p>ORGANS</p>
            <a href="detail.php"><img class="img-thumbnail" src="images/cow.jpg" alt="cow"> </a>
            <p>Price: $10 / lb</p>
        </section>
    </div>


</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
