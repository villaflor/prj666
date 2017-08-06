<?php
require_once  'core/init.php';
include '/data/www/default/wecreu/tools/good.php';
include '/data/www/default/wecreu/tools/category.php';
include_once '/data/www/default/wecreu/tools/sql.php';

$user = new User();
$validate = new Validate();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

//$good = new Good();
//$category = new Category();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue - Good Detail</title>
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
                        <a class="dropdown-item" href="editCover.php">Edit cover</a>
                        <a class="dropdown-item" href="editFooter.php">Edit footer</a>
                        <a class="dropdown-item" href="editAboutUs.php">Edit about us</a>
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
                    <a class="nav-item nav-link dropdown-toggle active" href="#"
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

<div class="container bg-faded py-5" style="min-height: 100vh">
    <h2 class="mb-4">Good Detail</h2>
    <?php
    if(Session::exists('good')) {
        echo '<p class="text-success">' . Session::flash('good') . '</p>';
    }


    $db = Database::getInstance();
    $good = new Good($db);
//    echo "getting good object";
    $alldata = $good->getGoodDetail($_GET["gid"]);

    $row = mysqli_fetch_assoc($alldata);
    $imagepath = "images/".$row['good_image'];

    ?>


	<img src='<?php echo $imagepath;  ?>' alt="good image" height="200" width="200" />

    <table class="table table-striped">
        <tr>
            <td>Product Name: <?php echo "$row[good_name]";  ?></td>
            <td>Quantity: <?php echo "$row[good_in_stock]";  ?></td>
        </tr>
        <tr>
            <td>Category: <?php echo "$row[category_name]";  ?></td>
            <td>Weight: <?php echo "$row[good_weight]";  ?> lbs</td>
        </tr>
        <tr>
            <td>Price: $ <?php echo "$row[good_price]";  ?></td>
            <td>Taxable: <?php if(isset($row['good_taxable'])){
                                    if($row['good_taxable']==1){
                                        echo "Taxable";
                                    }else {
                                        echo "Not Taxable";
                                    }
                                }else{
                                    echo "No information";
                                }  ?></td>
        </tr>
        <tr>
            <td>Sales Applicable: <?php if(isset($row['sale_id'])){
                                        $query="SELECT `sale_name` FROM `sale` WHERE `sale_id` = ".$row['sale_id'];
                                     //   echo $query;
                                        $conn = $db->getConnection();
                                        $datasale=$conn->query($query);
                                        $salerow=mysqli_fetch_assoc($datasale);
                                        echo "$salerow[sale_name]";
                                    }else{
                                        echo "No Sale";
                                    }?></td>
            <td></td>
        </tr>

        <tr >
            <td> Description:<?php echo "$row[good_description]";  ?></td>
            <td></td>
        </tr>

    </table>

</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
