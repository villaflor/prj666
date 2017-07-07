<?php
require_once 'core/init.php';

$user = new User();
$validate = new Validate();

if (!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()) {
    $validation = $validate->check($_POST, array(
        'category_name' => array(
            'name' => 'Name',
            'required' => true,
            'unique' => 'category',
            'min' => 2,
            'max' => 30
        ),
        'desc' => array(
            'name' => 'Description',
            'required' => true,
            'max' => 255
        )
    ));

    if ($validation->passed()) {

        try {
            include_once('tools/category.php');
            include_once("tools/sql.php");

            $db = Database::getInstance();
            $clientId = $user->data()->client_id;
            //create an object
            $category = new Category($db, $clientId);

            // add one
            if ($category->add($_POST['category_name'], $_POST['desc'])) {
                Session::flash('createC', 'New category has been added!');
                //Redirect::to('index.php');

            } else {
                $validate->addError('Sorry, adding new category failed. Please try again.');
                //echo "add #1 fail<br>";
            }
        } catch (Exception $e) {
            die($e->getMessage()); //or you can redirect to other page.
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue - Add Sale</title>
</head>
<body>

<?php
include("narbar.php");
?>

<div class="container bg-faded py-5">
    <h2 class="mb-4">Create category form</h2>
    <?php
    if(Session::exists('createC')) {
        echo '<p class="text-success">' . Session::flash('createC') . '</p>';
    }

    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>

    <form action="" method="post">
        <fieldset class="form-group">
            <legend></legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="category_name"><span class="text-danger">*</span> Name</label>
                <input class="form-control" type="text" id="category_name" name="category_name" value="">
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="desc"><span class="text-danger">*</span> Description</label>
                <textarea class="form-control" rows="3" name="desc" id="desc" placeholder="Enter description"><?php echo escape(Input::get('desc'))?></textarea>
                <input type="hidden" name="method" value="categoryAdd">
            </div>
        </fieldset>
        <div class="form-group">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary" type="submit" value="Add" />
        </div>
    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>




