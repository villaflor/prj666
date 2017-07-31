<?php
require_once 'core/init.php';

$admin = new Admin();
$user = new User(Input::get('clientId'));
$good = new Good();
$category = new Category();
$lowStocks = array();
$numLowStocks = 0;
$categories_list = array();
$numCategories = 0;
$goods_list = array();
$numGoods = 0;
$sale_list = array();
$numSale = 0;

if(!$admin->isLoggedIn()){
    Redirect::to('indexAdmin.php');
}

$client_name = $user->data()->username;
$check = 0;


    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Wecrue - Client Details</title>
    </head>
    <body>

    <nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuContent">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link" href="indexAdmin.php">Home</a>
                    <a class="nav-item nav-link" href="monitor.php">Monitor Client</a>
                    <a class="nav-item nav-link" href="logoutAdmin.php">Log out</a>
                </div>
            </div>

            <h1 class="navbar-brand mb-0 mr-3">Hello Admin <a class="text-white" href="profileAdmin.php?user=<?php echo escape($admin->data()->admin_username); ?>"><?php echo escape($admin->data()->admin_name); ?></a>!</h1>
        </div>
    </nav>

    <div class="container bg-faded py-5" style="min-height: 100vh">
        <h1 class="mb-4">Client profile</h1>

        <div class="container mb-4">
            <section class="container py-5 bg-primary rounded mb-4">
                <div class="row mb-5">
                    <div class="col-2"><img src="<?php
                        if ($logo = $user->data()->client_logo){
                            echo $logo;
                        } else {
                            echo 'images/defaultlogo.jpg';
                        }
                        ?>" alt="logo" class="img-thumbnail" width="250px" height="250px"></div>
                    <div class="container col-5">
                        <div class="col mb-5">
                            <p>Client name</p><hr>
                            <h3 class="text-white">
                                <?php
                                echo $user->data()->client_name;
                                ?>
                            </h3>
                        </div>
                        <div class="col">
                            <p>Client link</p><hr>
                            <h3 class="text-white"><?php
                                if (file_exists('/data/www/default/' . $user->data()->username)){
                                    ?><a class="text-white" href="<?php
                                    echo "/" . $user->data()->username;
                                    ?>">
                                        Go to my site
                                    </a>
                                    <?php
                                } else {
                                    echo "Site not generated.";
                                }
                                ?>

                            </h3>
                        </div>
                    </div>
                    <div class="container col-5">
                        <div class="col mb-5">
                            <p>Site title</p><hr>
                            <h3 class="text-white">
                                <?php
                                echo $user->data()->client_site_title;
                                ?>
                            </h3>
                        </div>
                        <div class="col">
                            <p>Acceptable payment</p><hr>
                            <?php
                            if($user->data()->payment_option_visa) echo "<h3 class=\"text-white\">Visa card</h3>";
                            if($user->data()->payment_option_mastercard) echo "<h3 class=\"text-white\">Master card</h3>";
                            if($user->data()->payment_option_ae) echo "<h3 class=\"text-white\">American Express</h3>";
                            if($user->data()->payment_option_paypal) echo "<h3 class=\"text-white\">Paypal</h3>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container col-6">
                        <p>This year total sale</p>
                    </div>
                    <div class="container col-6">
                        <p>Last year total sale</p>
                    </div>
                </div>
            </section>
        </div>
        <div class="container mb-4">


            <section class="col bg-danger rounded py-5">
                <?php
                $category->getCategory($user->data()->client_id);
                if($category->exists()) {
                    $categoryItems = $category->data();

                    foreach ($categoryItems as $categoryItem) {
                        $categories_list[] = $categoryItem->category_name . '<br>';
                        $numCategories++;

                        $good->getGood(array('category_id', '=', $categoryItem->category_id));
                        if($good->exists()){
                            $goodItems = $good->data();

                            foreach ($goodItems as $goodItem){
                                if($goodItem->good_in_stock < 6) {
                                    $lowStocks[] = $goodItem->good_name .' <span class="badge badge-warning">'. $goodItem->good_in_stock .'</span><br>';
                                    $goods_list[] = $goodItem->good_name .' <span class="badge badge-warning">'. $goodItem->good_in_stock .'</span><br>';

                                    $numLowStocks++;
                                }else{
                                    $goods_list[] = $goodItem->good_name .' <span class="badge badge-success">'. $goodItem->good_in_stock .'</span><br>';
                                }

                                if($goodItem->sale_id){
                                    $sale_list[] = $goodItem->good_name . '<br>';
                                    $numSale++;
                                }
                                $numGoods++;
                            }
                        }
                    }
                }
                ?>
                <h4>Number of low in stock <span class="badge badge-warning"><?php echo $numLowStocks; ?></span></h4>
                <hr>
                <div class="container row">
                    <div class="col-md-4">
                        <?php
                        for ($i = 0; $i < $numLowStocks; $i += 3){
                            echo $lowStocks[$i];
                        }
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        for ($i = 1; $i < $numLowStocks; $i += 3){
                            echo $lowStocks[$i];
                        }
                        ?>
                    </div>
                    <div class="col-md-4"><?php
                        for ($i = 2; $i < $numLowStocks; $i += 3){
                            echo $lowStocks[$i];
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
        <div class="container mb-4">
            <section class="col bg-info rounded py-5">
                <h4><a class="text-gray-dark" href="createsale.php">Number of on sale</a> <span class="badge badge-success"><?php echo $numSale; ?></span></h4>
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
        <div class="container mb-4">
            <section class="col bg-info rounded py-5">
                <h4><a class="text-gray-dark" href="category.php">Number of categories</a> <span class="badge badge-success"><?php echo $numCategories; ?></span></h4>
                <hr>
                <div class="container row">
                    <div class="col-md-4">
                        <?php
                        for ($i = 0; $i < $numCategories; $i += 3){
                            echo $categories_list[$i];
                        }
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        for ($i = 1; $i < $numCategories; $i += 3){
                            echo $categories_list[$i];
                        }
                        ?>
                    </div>
                    <div class="col-md-4"><?php
                        for ($i = 2; $i < $numCategories; $i += 3){
                            echo $categories_list[$i];
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>

        <div class="container mb-4">
            <section class="container bg-info rounded py-5">
                <h4><a class="text-gray-dark" href="good.php">Number of products</a> <span class="badge badge-success"><?php echo $numGoods; ?></span></h4>
                <hr>
                <div class="container row">
                    <div class="col-md-4">
                        <?php
                        for ($i = 0; $i < $numGoods; $i += 3){
                            echo $goods_list[$i];
                        }
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        for ($i = 1; $i < $numGoods; $i += 3){
                            echo $goods_list[$i];
                        }
                        ?>
                    </div>
                    <div class="col-md-4"><?php
                        for ($i = 2; $i < $numGoods; $i += 3){
                            echo $goods_list[$i];
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>



    <?php include('includes/footer.inc'); ?>

    <script src="js/jquery-3.1.1.slim.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>



