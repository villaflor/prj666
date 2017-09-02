<?php
/*
This file creates a new good. It provides a form, validates user input, 
calls validation and image upload scripts and displays success or fail messages
This file creates  new record for goods in database, 
then renames the image to the id of new good in database,
uploads renamed good image to file system and updates database record

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
$num = mysqli_num_rows($allcategory);
$alertMessage="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecreu</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
$(document).ready(function(){

    var checkPrice = function(){
        var price = $("#good_price").val();
        if(price == ""){
            price = 0.01;
        }
        price = parseFloat(price).toFixed(2);
        if(price <= 0 || price >= 1000000){
            $("#priceErr").text("* Price must be between 0.01 ~ 999999.99");
            price = 0.01;
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
    }

    $("#good_price").blur(checkPrice);


    var checkWeight = function(){
        var weight = $("#good_weight").val();
        if(weight == ""){
            weight = 0.00;
        }
        weight = parseFloat(weight).toFixed(2);

        if(weight <= 0 || weight >= 10000){
            $("#weightErr").text("* Weight must be between 0.01 ~ 9999.99");
            weight = 0.01;
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
    };

    $("#good_weight").blur(checkWeight);

    var checkQTY = function(){
        var qty = $("#good_quantity").val();
        if(qty == ""){
            qty = 1;
        }
        qty = parseFloat(qty).toFixed(0);
        if(qty <= 0 || qty > 999999){
            $("#qtyErr").text("* Quantity must be between 1 ~ 999999");
            qty = 1;
            $("#good_quantity").val(qty);
        }else{
            $("#qtyErr").text("");
            $("#good_quantity").val(qty);
        }
    };

    $("#good_quantity").blur(checkQTY);

    var chcekName = function(){
        var name = $("#good_name").val();
        $.ajax({
          url: "tools/checkGood.php",
          data: {
            name: name
          },
          dataType: "text",
          method: "GET",
          success: function(data) {
            $("#nameErr").text(data);
            if( data == "" ){
                $("#subm").removeAttr("disabled");
            }else {
                $("#subm").attr("disabled","disabled");
            }
          }
        });
    };

    $("#good_name").blur(chcekName);
    $("#subm").mouseover(function(){
        chcekName();
        checkQTY();
        checkWeight();
        checkPrice();
    });
});
</script>
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
<div class="container bg-faded py-5" style="min-height: 100vh">
    <?php

            $taxable = $visible = 0;

            $name = $description = $price = $quantity = $weight = $category = "";
            $nameVer = $imageVer = $descVer = $priceVer = $qtyVer = $weightVer = $catVer = false;
            $nameErr = $imageErr = $descriptionErr = $priceErr = $quantityErr = $weightErr = $taxableErr = $visibleErr = $categoryErr = "";

            if($_POST){ //calls input validation script
                include '/data/www/default/wecreu/tools/goodValidate.php';
                include '/data/www/default/wecreu/tools/uploadImage.php';

                //if input valid update database and upload image
                if($nameVer == true && $imageVer == true && $descVer == true &&
                   $priceVer == true && $qtyVer == true && $weightVer == true &&
                   $catVer == true){

                    $good = new Good($db);


                    if($good->addGood($name, "", $description, $price, $quantity, $weight, $taxable, $visible, $category)){

                        $newGoodInfo = $good->getGoodId($name, "", $description, $price, $quantity, $weight, $taxable, $visible, $category, $clientid);

                        $row = mysqli_fetch_assoc($newGoodInfo);
                        $newGoodId = $row['good_id'];

                        if(!empty($newGoodId)){

                             //prepare file name
                             $filextension = pathinfo($_FILES["good_image"]["name"], PATHINFO_EXTENSION);
                             $imageIdFileName = $newGoodId .".".$filextension;

                            //attempt to upload file
                            $alertMessage = uploadImageFunction($imageIdFileName, $alertMessage);

                            if(empty($alertMessage)){//if upload function did not give alerts
                                $sale ="null";
                                if($good->editGood($newGoodId, $name, $imageIdFileName, $description, $price, $quantity, $weight, $taxable, $visible, $category, $sale)){
                                    $alertMessage = '<span style="color:#009900;">New good has been created Successfully!</span><br/>';
                                } else {
                                    $good->deleteGood($newGoodId);
                                    $alertMessage = '<span style="color:#999900;">Failed to create a new good  record removed</span><br/>';
                                }
                            } else {
                                    $good->deleteGood($newGoodId);
                                    $alertMessage = '<span class="text-danger" ">Invalid image file</span><br/>';
                            }
                        } 
                    } else {
                        $alertMessage = '<span style="color:#990000;">Failed to create a new good </span><br/>';
                    }
                } else {
                    $alertMessage = '<span style="color:#990000;">Invalid input provided.</span><br/>';
                }
            }
		
			if($num != 0){
    ?>
    <h2 class="mb-4">Fill out form to add a new good to inventory</h2>
        <p><?php echo $alertMessage; ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="" method="post" enctype="multipart/form-data" >
        <fieldset class="form-group">
            <legend></legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_name"><span class="text-danger">*</span> Name</label>
                <input required maxlength="40" class="form-control" type="text" name="good_name" id="good_name" placeholder="Enter name for good" value="<?php echo $name;?>" />
                <p id="nameErr" style="color:#ff0000;"><?php echo $nameErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_image"><span class="text-danger">*</span> Image</label>
                <input required class="form-control" type="file" name="good_image" id="good_image" accept="image/x-png,image/jpeg" placeholder="Add an image" />
                <p style="color:#ff0000;"><?php echo $imageErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="description"><span class="text-danger">*</span> Description</label>
                <textarea required maxlength="255" class="form-control" rows="3" name="description" id="description" placeholder="Enter description"><?php echo $description;/*echo escape(Input::get('client_info'))*/?></textarea>
                <p style="color:#ff0000;"><?php echo $descriptionErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_price"><span class="text-danger">*</span>&nbspPrice ($)</label>
                <input required class="form-control" max="999999.99" type="number" min="0.01" step="0.01" name="good_price" value="0.01" id="good_price" style="width: 90px;" value="<?php echo $price;?>" />
                <p id="priceErr" style="color:#ff0000;"><?php echo $priceErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_quantity"><span class="text-danger">*</span>&nbspQuantity </label>
                <input required class="form-control" type="number" max="999999" min="1" step="1" name="good_quantity" id="good_quantity" value="1" style="width: 90px;" value="<?php echo $quantity;?>" />
                <p id="qtyErr" style="color:#ff0000;"><?php echo $quantityErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_weight"><span class="text-danger">*</span>&nbspWeight (pounds)</label>
                <input required class="form-control" type="number" max="9999.99" min="0.01" step="0.01" name="good_weight" id="good_weight" value="0.01" style="width: 90px;" value="<?php echo $weight;?>" />
                <p id="weightErr" style="color:#ff0000;"><?php echo $weightErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="taxable">Taxable</label>
                <input style="margin-left: 10px;"type="checkbox" name="taxable" id="taxable" <?php if(isset($taxable) && $taxable==true) echo "checked";?>/>
                 <p style="color:#ff0000;"><?php echo $taxableErr;?></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="visible">Visible</label>
                <input style="margin-left: 10px;"type="checkbox" name="visible" id="visible" <?php if(isset($visible) && $visible==true) echo "checked";?>/>
                <p style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;Note: If you don't check, the new product will not be displayed on your site.</p>
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


        </fieldset>
        <div class="form-group">
            <input type="hidden" name="token" value="">
            <input id="subm" class="btn btn-primary" type="submit" value="Submit" />
        </div>
    </form>
			<?php } else{?>
			<p style="font-size:25px; font-weight:500;">You don't have any product's category yet, you need at least one before creating a good</p>
			<a style="display:block; padding-top:20px;" href="http://myvmlab.senecacollege.ca:5726/wecreu/addCategoryForm.php">Add category</a></br>
			<?php }?>
			
</div>
<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
