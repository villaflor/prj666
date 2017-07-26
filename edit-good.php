<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

include '/data/www/default/wecreu/tools/good.php';
include '/data/www/default/wecreu/tools/category.php';
include_once '/data/www/default/wecreu/tools/sql.php';
$clientid = $user->data()->client_id;

$db = Database::getInstance();
$category = new Category($db,$clientid);
$allcategory = $category->getAll();

$sale = new Sale();
$allsale=$sale->getSale($user->data()->client_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecreu</title>
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

                <a class="nav-item nav-link" href="logout.php">Log out</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>
    </div>
</nav>
<div class="container bg-faded py-5">
    <?php
            $id =  $_GET["gid"];
            $good = new Good($db);
            echo "getting info for good ".$id;
            $alldata = $good->getGoodDetail($id);
            $row = mysqli_fetch_assoc($alldata);     
                                        
            $name = $row['good_name'];
            $image = $row['good_image'];
            $description = $row['good_description'];
            $price = $row['good_price'];
            $quantity = $row['good_in_stock'];
            $weight = $row['good_weight'];
            $taxable = $row['good_taxable'];
            $visible = $row['good_visible'];
            $category = $row['category_id'];
            $sale = $row['sale_id'];
            
            $nameErr = $imageErr = $descriptionErr = $priceErr = $quantityErr = $weightErr = $taxableErr = $visibleErr = $categoryErr = "";
            $taxable = $visible = 0;
            $nameVer = $imageVer = $descVer = $priceVer = $qtyVer = $weightVer = $catVer = false; 

            if($_POST){
                include '/data/www/default/wecreu/tools/goodValidate.php';

           //     echo "<br/>edit-good.php is getting ready to edit good ".$id." in db<br/>";
             //   echo "$nameVer, $imageVer, $descVer, $priceVer, $qtyVer, $weightVer, $catVer Calling DB<br/>";
                if($nameVer == true && $imageVer == true && $descVer == true && 
                   $priceVer == true && $qtyVer == true && $weightVer == true && 
                   $catVer == true){
                      
                    echo "editing new good ".$name.",".$image.",".$description.",".$price.",".$quantity.",".$weight.",".$taxable.",".$visible.",".$category."<br/>";

                    if($good->editGood($id, $name, $image, $description, $price, $quantity, $weight, $taxable, $visible, $category, $sale)){
                        
                        echo "<script type='text/javascript'>alert('Good has been updated') </script>";                             
                      //  echo "updated successfully good ".$id.",".$name.",".$image.",".$description.",".$price.",".$quantity.",".$weight.",".$taxable.",".$visible.",".$category.",".$sale."<br/>";
                    } else {
                        echo "<script type='text/javascript'>alert('Database error received while updating good') </script>";
                      //  echo "error received updating good ".$id.",".$name.",".$image.",".$description.",".$price.",".$quantity.",".$weight.",".$taxable.",".$visible.",".$category.",".$sale."<br/>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Failed to update good') </script>";
                }
            }
    ?>
    <h2 class="mb-4">Edit good information</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?gid=".$id;?>" style="" method="post" enctype="multipart/form-data" >
        <fieldset class="form-group">
            <legend></legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_name"><span class="text-danger">*</span> Name</label>
                <input class="form-control" type="text" name="good_name" id="good_name" placeholder="Enter name for good" value="<?php echo $name;?>" />
                <p style="color:#ff0000;"><?php echo $nameErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_image"><span class="text-danger">*</span> Image (Name must be unique for each image)</label>
                <input class="form-control" type="file" name="good_image" id="good_image" accept="image/x-png,image/jpeg" placeholder="Add an image" value="<?php echo $image;?>" />
                <p style="color:#ff0000;"><?php echo $imageErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="description"><span class="text-danger">*</span> Description</label>
                <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter description"><?php echo $description;/*echo escape(Input::get('client_info'))*/?></textarea>
                <p style="color:#ff0000;"><?php echo $descriptionErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_price"><span class="text-danger">*</span>&nbspPrice ($)</label>
                <input class="form-control" type="number" min="0.01" step="0.01" name="good_price" id="good_price" style="width: 90px;" value="<?php echo $price;?>" />
                <p style="color:#ff0000;"><?php echo $priceErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_quantity"><span class="text-danger">*</span>&nbspQuantity </label>
                <input class="form-control" type="number" min="0" step="1" name="good_quantity" id="good_quantity" style="width: 90px;" value="<?php echo $quantity;?>" />
                <p style="color:#ff0000;"><?php echo $quantityErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_weight"><span class="text-danger">*</span>&nbspWeight (pounds)</label>
                <input class="form-control" type="number" min="0.01" step="0.01" name="good_weight" id="good_weight" style="width: 90px;" value="<?php echo $weight;?>" />
                <p style="color:#ff0000;"><?php echo $weightErr;?></p>
            </div>

            <div class="form-group col-md-6">
                <label class="form-control-label" for="taxable">Taxable</label>
                <input style="margin-left: 10px;"type="checkbox" name="taxable" id="taxable" <?php if(isset($taxable) && $taxable==true) echo "checked";?>/>
                <p style="color:#ff0000;"><?php echo $taxableErr;?></p>             
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="visible">Visible</label>
                <input style="margin-left: 10px;"type="checkbox" name="visible" id="visible" <?php if(isset($visible) && $visible==true) echo "checked";?>/>
                <p style="color:#ff0000;"><?php echo $visibleErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="category_id"><span class="text-danger">*</span>Category</label>
                <select name="category_id" id="category_id" >
                                        <?php 
                                        mysqli_data_seek($allcategory, 0);
                                        while($row = mysqli_fetch_assoc($allcategory)){
                                            echo "<option value='$row[category_id]'>$row[category_name]</option>";
                                        }
                                        ?>
                </select>
                <p style="color:#ff0000;"><?php echo $categoryErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="sale_id"><span class="text-danger">*</span>Sale</label>
                <select name="sale_id" id="sale_id" >
                                        <?php 
                                        mysqli_data_seek($allsale, 0);
                                        while($row = mysqli_fetch_assoc($allsale)){
                                            echo "<option value='$row[sale_id]'>$row[sale_name]</option>";
                                        }
                                        ?>
                <option>BBB</option>
                </select>
              <!--  <p style="color:#ff0000;"><?php /*echo $categoryErr;*/?></p>-->
            </div>


        </fieldset>
        <div class="form-group">
            <input type="hidden" name="token" value="">
            <input class="btn btn-primary" type="submit" value="Submit" />
        </div>
    </form>

</div>
<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>