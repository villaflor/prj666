<?php
/*
This file edits an existing good. It provides a form, validates user input, 
calls validation and image upload scripts and displays success or fail messages
This file creates uploads a good image renamed to good id to file system 
and updates database record.
If an image already exists and a new file is provided, the old file is overwritten.
If an image exists and no file is provided, old file is kept
If no image exists and no file is provided, and error message is sent.

Wecreu HTML/CSS layout -Mark
Form - Quang
PHP backend processing- Olga
Javascript front end validation - Brian
*/

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
$allcategory = $category->getAllAvaliable();

$query="SELECT DISTINCT sale.* FROM client JOIN category ON category.client_id = client.client_id JOIN good ON good.category_id = category.category_id JOIN sale ON sale.sale_id = good.sale_id WHERE client.client_id = ".$clientid;

$conn = $db->getConnection();
$allsale=$conn->query($query);
$alertMessage="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<div class="container bg-faded py-5">
    <?php
    $id =  $_GET["gid"];
    $good = new Good($db);

    // getting info to display good
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
    $category = $categoryMark = $row['category_id'];
    $sale = $row['sale_id'];
    $goodIdMark = $row['good_id'];


    $saleMark = new Sale();
    if($sale) $saleMark->findSale(array('sale_id', '=', $sale));

    $taxable = $visible = 0;
    $nameVer = $imageVer = $descVer = $priceVer = $qtyVer = $weightVer = $catVer = false;
    $nameErr = $imageErr = $descriptionErr = $priceErr = $quantityErr = $weightErr = $taxableErr = $visibleErr = $categoryErr = "";


    if($_POST){//calling validation script
        include '/data/www/default/wecreu/tools/goodValidate.php';
        include '/data/www/default/wecreu/tools/uploadImage.php';
           

        if($imageVer == false && strlen($image) > 0){ //if no image uploaded but image exists preserve existing image
            $imageVer = true;
        }

        //if file is missing and a new one has nt been uploaded
        if(strlen($image) == 0 && empty($_FILES["good_image"]['name'])){
            $alertMessage = $alertMessage.'<span style="color:#990000;">This good is missing an image, please add one. </span>';
            $imageErr="Please upload an image file";
        }

        //preparing to edit db
        if($nameVer == true && $imageVer == true && $descVer == true &&
            $priceVer == true && $qtyVer == true && $weightVer == true &&
            $catVer == true){

            //preparing good image file name and put into image variable instead of existing name
            if(!empty($_FILES["good_image"]['name'])){
               $filextension = pathinfo($_FILES["good_image"]["name"], PATHINFO_EXTENSION);
                 $image = $id .".".$filextension;
                $alertMessage = uploadImageFunction($image, $alertMessage);
            }

            if(empty($alertMessage)){//if upload function did not give alerts
                if($good->editGood($id, $name, $image, $description, $price, $quantity, $weight, $taxable, $visible, $category, $sale)){

                    $alertMessage = '<span style="color:#009900;">Good has been updated successfully</span><br/>';

                } else {
                    $alertMessage = '<span style="color:#990000;">Failed to update existing good </span><br/>';
                }
            }

        } else {
            $alertMessage = $alertMessage.'<span style="color:#990000;">Invalid input provided.</span><br/>';
        }
    }
    ?>
    <h2 class="mb-4">Edit good information</h2>
            <p><?php echo $alertMessage; ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?gid=".$id;?>" style="" method="post" enctype="multipart/form-data" >
        <fieldset class="form-group">
            <legend></legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_name"><span class="text-danger">*</span> Name</label>
                <input required maxlength="40" class="form-control" type="text" name="good_name" id="good_name" placeholder="Enter name for good" value="<?php echo $name;?>" />
                <p style="color:#ff0000;"><?php echo $nameErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_image">Image</label>
                <input class="form-control" type="file" name="good_image" id="good_image" accept="image/x-png,image/jpeg" placeholder="Add an image" value="<?php echo $image;?>" />
                <p style="color:#ff0000;"><?php echo $imageErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="description"><span class="text-danger">*</span> Description</label>
                <textarea required maxlength="255" class="form-control" rows="3" name="description" id="description" placeholder="Enter description"><?php echo $description;/*echo escape(Input::get('client_info'))*/?></textarea>
                <p style="color:#ff0000;"><?php echo $descriptionErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_price"><span class="text-danger">*</span>&nbspPrice ($)</label>
                <input required class="form-control" type="number" max="999999.99" min="0.01" step="0.01" name="good_price" id="good_price" style="width: 90px;" value="<?php echo $price;?>" />
                <p id="priceErr" style="color:#ff0000;"><?php echo $priceErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_quantity"><span class="text-danger">*</span>&nbspQuantity </label>
                <input required class="form-control" type="number" max="999999" min="0" step="1" name="good_quantity" id="good_quantity" style="width: 90px;" value="<?php echo $quantity;?>" />
                <p id="qtyErr" style="color:#ff0000;"><?php echo $quantityErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_weight"><span class="text-danger">*</span>&nbspWeight (pounds)</label>
                <input required class="form-control" type="number" max="9999.99" min="0.01" step="0.01" name="good_weight" id="good_weight" style="width: 90px;" value="<?php echo $weight;?>" />
                <p id="weightErr" style="color:#ff0000;"><?php echo $weightErr;?></p>
            </div>

            <div class="form-group col-md-6">
                <label class="form-control-label" for="taxable">Taxable</label>
                <input style="margin-left: 10px;"type="checkbox" name="taxable" id="taxable" <?php if($row['good_taxable']) echo "checked";?>/>
                <p style="color:#ff0000;"><?php echo $taxableErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="visible">Visible</label>
                <input style="margin-left: 10px;"type="checkbox" name="visible" id="visible" <?php if($row['good_visible']) echo "checked";?>/>
                <p style="color:#ff0000;"><?php echo $visibleErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="category_id"><span class="text-danger">*</span>Category</label>
                <select class="form-control" name="category_id" id="category_id" >
                    <?php
                    mysqli_data_seek($allcategory, 0);
                    while($row = mysqli_fetch_assoc($allcategory)){
                        if($row['category_id'] == $categoryMark) echo "<option value='$row[category_id]' selected>$row[category_name]</option>";
                        else echo "<option value='$row[category_id]'>$row[category_name]</option>";
                    }
                    ?>
                </select>
                <p style="color:#ff0000;"><?php echo $categoryErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="sale_id"><span class="text-danger">*</span>Sale</label>
                <select class="form-control" name="sale_id" id="sale_id" >
                    <?php
                    
                    mysqli_data_seek($allsale, 0);
                        echo "<option value='null' selected></option>";
                        if($saleMark->data()) echo "<option value=". $saleMark->data()->sale_id ." selected>" . $saleMark->data()->sale_name . "</option>";

                    while($row = mysqli_fetch_assoc($allsale)){
                        if($row['sale_id'] != $saleMark->data()->sale_id)
                        echo "<option value='$row[sale_id]'>$row[sale_name]</option>";
                    }
                    ?>
                </select>

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
<script>
    var oweight = $("#good_weight").val();
    var oqty = $("#good_quantity").val();
    var oprice = $("#good_price").val();
    $("#good_price").blur(function(){
        var price = $("#good_price").val();
        if(price == ""){
            price = 0.01;
        }
        price = parseFloat(price).toFixed(2);
        if(price <= 0 || price >= 1000000){
            $("#priceErr").text("* Price must be between 0.01 ~ 999999.99");
            price = oprice;
            $("#good_price").val(price);
        }else{
            $("#priceErr").text("");
            $("#good_price").val(price);
        }
        var reg = /.*\..*/;
        if(!reg.test(price)){
            price += ".00";
            $("#good_price").val(price);
        }
    });

    $("#good_weight").blur(function(){
        var weight = $("#good_weight").val();
        if(weight == ""){
            weight = 0.00;
        }
        weight = parseFloat(weight).toFixed(2);
        if(weight <= 0 || weight >= 10000){
            $("#weightErr").text("* Weight must be between 0.01 ~ 9999.99");
            weight = oweight;
            $("#good_weight").val(weight);
        }else{
            $("#weightErr").text("");
            $("#good_weight").val(weight);
        }
        var reg = /.*\..*/;
        if(!reg.test(weight)){
            weight += ".00";
            $("#good_weight").val(weight);
        }
    });

    $("#good_quantity").blur(function(){
        var qty = $("#good_quantity").val();
        if(qty == ""){
            qty = 1;
        }
        qty = parseFloat(qty).toFixed(0);
        if(qty <= 0 || qty > 999999){
            $("#qtyErr").text("* Quantity must be between 1 ~ 999999");
            qty = oqty;
            $("#good_quantity").val(qty);
        }else{
            $("#good_quantity").val(qty);
            $("#qtyErr").text("");
        }
    });

</script>
</body>
</html>
