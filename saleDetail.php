<?php
require_once 'core/init.php';

$user = new User();
$sale = new Sale();
$good = new Good();

$saleId = Input::get('sale_id');

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(!$saleId){
    Redirect::to('index.php');
}

if(!$sale->isBelongToUser($saleId, $user->data()->client_id)){
    Redirect::to('index.php');
}

$sale->findSale(array('sale_id', '=', $saleId));

if (!$sale->exists()){
    Redirect::to('index.php');
}

$sale_list = array();
$numSale = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue - Sale Detail</title>
</head>
<body>

<nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuContent">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link" href="generateTemplate.php">Generate site</a>
                <a class="nav-item nav-link" href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="profileDropdown"
                    >Account</a>

                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="edit-com.php">Update account</a>
                        <a class="dropdown-item" href="changepassword.php">Change password</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="pageDropdown"
                    >Page</a>
                    <div class="dropdown-menu" aria-labelledby="pageDropdown">
                        <a class="dropdown-item" href="editCover.php">Edit cover</a>
                        <a class="dropdown-item" href="editFooter.php">Edit footer</a>
                        <a class="dropdown-item" href="editAboutUs.php">Edit about us</a>
                        <a class="dropdown-item" href="pageList.php">View pages</a>
                        <a class="dropdown-item" href="addPage.php">Create page</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="categoryDropdown"
                    >Category</a>

                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <a class="dropdown-item" href="category.php">View categories</a>
                        <a class="dropdown-item" href="addCategoryForm.php">Create category</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="goodDropdown"
                    >Good</a>

                    <div class="dropdown-menu" aria-labelledby="goodDropdown">
                        <a class="dropdown-item" href="good.php">View goods</a>
                        <a class="dropdown-item" href="create-good.php">Create good</a>
                        <a class="dropdown-item" href="edit-good.php">Edit good</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle active" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="saleDropdown"
                    >Sale</a>

                    <div class="dropdown-menu" aria-labelledby="saleDropdown">
                        <a class="dropdown-item" href="sale.php">View sales</a>
                        <a class="dropdown-item" href="onsale.php">Goods on sale</a>
                        <a class="dropdown-item" href="createsale.php">Create Sale</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="saleDropdown"
                    >Orders</a>

                    <div class="dropdown-menu" aria-labelledby="saleDropdown">
                        <a class="dropdown-item" href="orderList.php">View orders</a>
                    </div>
                </div>
                <a class="nav-item nav-link" href="logout.php">Log out</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>
    </div>
</nav>

<div class="container bg-faded py-5" style="min-height: 65vh">
    <h2 class="mb-4">Sale Information</h2>
    <?php
    if(Session::exists('saleD')) {
        echo '<p class="text-success">' . Session::flash('saleD') . '</p>';
    }

    ?>

    <div class="container mb-4">
        <section class="container py-5 bg-primary rounded mb-4">
            <h2 class="mb-4 text-white"><?php echo $sale->data()->sale_name?></h2><hr>
            <div class="row mb-5">
                <div class="container col-6">
                    <div class="col mb-5">
                        <p>Start date</p><hr>
                        <h3 class="text-white">
                            <?php
                                echo $sale->data()->start_date;
                            ?>
                        </h3>
                    </div>
                    <div class="col">
                        <p>Description</p><hr>
                        <h3 class="text-white">
                            <?php
                            echo $sale->data()->sale_description;
                            ?>
                        </h3>
                    </div>
                </div>
                <div class="container col-6">
                    <div class="col mb-5">
                        <p>End date</p><hr>
                        <h3 class="text-white">
                            <?php
                            echo $sale->data()->end_date;
                            ?>
                        </h3>
                    </div>
                    <div class="col">
                        <p>Discount in percent</p><hr>
                        <h3 class="text-white">
                            <?php
                            echo $sale->data()->discount .' %';
                            ?>
                        </h3>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <?php

    $sale->getGoodWithSale($user->data()->client_id);
    $goodsOnSale = $sale->data();
    foreach ($goodsOnSale as $goodItem){
        $sale_list[] =  '<p>' .$goodItem->good_name. ' <span class="badge badge-default">'. $goodItem->good_in_stock .' in stock</span></p>';
        $numSale++;
    }


    ?>

    <div class="container mb-4">
        <section class="col bg-info rounded py-5">
            <h4>Goods on this sale <span class="badge badge-success"><?php echo $numSale; ?></span></h4>
            <hr>
            <div class="container row">
                <div class="col-md-4">
                    <?php
                    for ($i = 0; $i < $numSale; $i += 3){
                        echo $sale_list[$i];
                    }
                    ?>
                </div>
                <div class="col-md-4">
                    <?php
                    for ($i = 1; $i < $numSale; $i += 3){
                        echo $sale_list[$i];
                    }
                    ?>
                </div>
                <div class="col-md-4"><?php
                    for ($i = 2; $i < $numSale; $i += 3){
                        echo $sale_list[$i];
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <h4><a href="editsale.php?sale_id=<?php echo $saleId; ?>">Edit</a> | <a href="sale.php">List</a></h4>


</div>
<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
