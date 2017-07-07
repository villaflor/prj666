<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue</title>
</head>
<body>

<?php
include("narbar.php");
?>
<div class="container bg-faded py-5">
    <h2 class="mb-4">Create good form</h2>
    <form action="" style="" method="post">
        <fieldset class="form-group">
            <legend></legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_name"><span class="text-danger">*</span> Name</label>
                <input class="form-control" type="text" name="good_name" id="good_name" placeholder="Enter name for good" value="" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="description"><span class="text-danger">*</span> Description</label>
                <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter description"><?php echo escape(Input::get('client_info'))?></textarea>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_price"><span class="text-danger">*</span>&nbspPrice ($)</label>
                <p><input class="form-control" type="number" min="0.01" step="0.01" name="good_price" id="good_price" style="width: 90px;" value="" />

            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_quantity"><span class="text-danger">*</span>&nbspQuantity</label>
                <input class="form-control" type="number" min="0" step="1" name="good_quantity" id="good_quantity" style="width: 90px;" value="" />

            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good_weight"><span class="text-danger">*</span>&nbspWeight (pounds)</label>
                <input class="form-control" type="number" min="0.01" step="0.01" name="good_weight" id="good_weight" style="width: 90px;" value="" />

            </div>

            <div class="form-group col-md-6">
                <label class="form-control-label" for="color">Product color</label>
                <input class="form-control" type="text" name="good_color" id="good_color" value="" placeholder="Enter product color"/>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="taxable">Taxable</label>
                <input style="margin-left: 10px;"type="checkbox" name="taxable" id="taxable" value="tax"/>
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
