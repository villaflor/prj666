<?php
require_once  'core/init.php';
include '/data/www/default/wecreu/tools/good.php';
include '/data/www/default/wecreu/tools/category.php';
include_once '/data/www/default/wecreu/tools/sql.php';
include_once '/data/www/default/wecreu/tools/discountCalculator.php';

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
    $goodid = $_GET["gid"];
    $alldata = $good->getGoodDetail($goodid);

    if(mysqli_num_rows($alldata) == 0){
        echo "<p>Good not found</p>";
    } else{
        $row = mysqli_fetch_assoc($alldata);
        $imagepath = "images/".$row['good_image'];

        $oldprice = $row['good_price'];
        $calcprice = discountCalculate($goodid);
        $saleid = $row['sale_id'];
        $saledescription = "No sale";

        if(isset($saleid)){
          //  echo "sale exists";
            $query="SELECT * FROM sale WHERE sale_id = ".$saleid;
          //  echo $query;
            $conn = $db->getConnection();  
            $sale = $conn->query($query);
            $salerow = mysqli_fetch_assoc($sale);
            $startdate = date("Y-m-d", strtotime($salerow['start_date']));
            $enddate = date("Y-m-d", strtotime($salerow['end_date']));

            $saledescription = "'".$salerow['sale_name']."' at ".$salerow['discount']."%<br/>Starts ".$startdate." and ends ".$enddate;
        }
    ?>

				 
	<img src='<?php echo $imagepath;  ?>' alt=" " height="200" width="200" />
			
    <table class="table table-striped" style="table-layout: fixed; width: 100%">
        <tr>
            <td>Product Name: </td><td> <?php echo "$row[good_name]";  ?></td>    
        </tr>
        <tr>                        
            <td>Quantity: </td><td><?php echo "$row[good_in_stock]";  ?></td>
        </tr>
        <tr>
            <td>Category: </td><td><?php echo "$row[category_name]";  ?></td>  
         </tr>
        <tr>                      
            <td>Weight: </td><td><?php echo "$row[good_weight]";  ?> lbs</td>
        </tr>
        <tr>
            <?php
            if(isset($saleid)){
            ?>
            <td>Price: $ </td><td><?php echo $calcprice." (Current listed price, Regular price $".$oldprice.")";  ?></td> 
            <?php
            } else {
            ?>

            <td>Price: $ </td><td><?php echo $calcprice;  ?></td>     
            <?php
            }
            ?>
</tr>
        <tr>
            <td>Taxable: </td><td><?php if(isset($row['good_taxable'])){
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
            <td>Sales Applicable: </td><td><?php echo $saledescription; ?></td>     
        </tr>
					
        <tr >
            <td > Description:</td><td style="word-wrap: break-word"><?php echo "$row[good_description]";  ?></td>
        </tr>
					
    </table>
    <?php
    }
    ?>

</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
