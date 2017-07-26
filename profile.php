<?php
require_once 'core/init.php';

$user = new User();
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

if($user->data()->username !== Input::get('user')){
    Redirect::to(404);
}

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

$client_name = $user->data()->username;
$check = 0;

if(!$username = Input::get('user')){
    Redirect::to('index.php');
} else{
    $user = new User($username);
    if(!$user->exists()){
        Redirect::to(404);
    } else{
        $data = $user->data();
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Wecrue - Profile</title>
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
                    <a class="nav-item nav-link active" href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>

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
                        <a class="nav-item nav-link dropdown-toggle" href="#"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           id="saleDropdown"
                        >Sale</a>

                        <div class="dropdown-menu" aria-labelledby="saleDropdown">
                            <a class="dropdown-item" href="sale.php">View sales</a>
                            <a class="dropdown-item" href="onsale.php">Goods on sale</a>
                            <a class="dropdown-item" href="createsale.php">Create Sale</a>
                        </div>
                    </div>

                    <a class="nav-item nav-link" href="logout.php">Log out</a>
                </div>
            </div>
            <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>
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
                                    ?><a class="text-white" href="generateTemplate.php">
                                        Generate my site
                                    </a>
                                    <?
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
        <form action="" method="post">
            <input class="btn btn-primary float-right" type="submit" name="submitBtn" onclick="return confirm('Do you really want to delete your site?');" value="Delete your website">
        </form>

    </div>



    <?php include('includes/footer.inc'); ?>

    <script src="js/jquery-3.1.1.slim.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>



    <?php
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitBtn'])) {
        $deletedDir = '/data/www/default/' . $client_name;
        $deletedDir2 = '/data/www/default/' . $client_name . '/images';
        $deletedDir3 = '/data/www/default/' . $client_name . '/css';
        $deletedDir4 = '/data/www/default/' . $client_name . '/js';
        $deletedDir5 = '/data/www/default/' . $client_name . '/good';
        $deletedDir6 = '/data/www/default/' . $client_name . '/backup';
        if(file_exists($deletedDir)){
            rrmdir($deletedDir2);
            rrmdir($deletedDir3);
            if (file_exists($deletedDir4)){
                rrmdir($deletedDir4);
            }
            if(file_exists($deletedDir5)){
                rrmdir($deletedDir5);
            }
            if(file_exists($deletedDir6)){
                rrmdir($deletedDir6);
            }
            rrmdir($deletedDir);
            $check == 1;
        }
    }
    if ($check == 1){
        echo "Your site has been deleted.";
    }

}

function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir."/".$object))
                    rrmdir($dir."/".$object);
                else
                    unlink($dir."/".$object);
            }
        }
        rmdir($dir);
    }
}
?>
