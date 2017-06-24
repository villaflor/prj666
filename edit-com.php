<?php
require_once 'core/init.php';

$user = new User();
$validate = new Validate();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = $validate->check($_POST, array(
            'client_site_title' => array(
                'name' => 'Site title',
                'required' => true,
                'max' => 100,
                'unique' => 'client'
            ),
            'client_info' => array(
                'name' => 'Client information',
                'max' => 256
            )
        ));

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
    <title>Wecrue</title>
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
                <a class="nav-item nav-link" href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>
                <a class="nav-item nav-link" href="generateTemplate.php">Generate site</a>
                <a class="nav-item nav-link" href="edit-com.php">Update info</a>
                <a class="nav-item nav-link" href="changepassword.php">Change password</a>
                <a class="nav-item nav-link" href="create-good.php">Create good</a>
                <a class="nav-item nav-link" href="edit-good.php">Edit good</a>
                <a class="nav-item nav-link" href="createsale.php">Create Sale</a>
                <a class="nav-item nav-link" href="logout.php">Log out</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>
    </div>
</nav>
<div class="container bg-faded py-5">
    <h2 class="mb-4">Edit form</h2>
    <?php
    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post">
        <fieldset class="form-group">
            <legend>Edit Information</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_name"><span class="text-danger">*</span> Client name</label>
                <input class="form-control" type="text" name="client_name" id="client_name" placeholder="" value="<?php echo escape($user->data()->client_name);?>" disabled="disabled"/>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_site_title"><span class="text-danger">*</span> Site title</label>
                <input class="form-control" type="text" name="client_site_title" id="client_site_title" placeholder="Edit site title" value="<?php echo escape($user->data()->client_site_title);?>" />
            </div>
            <!--            <div class="form-group col-md-6">-->
            <!--                <label class="form-control-label" for="fileToUpload">Site logo</label>-->
            <!--                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" placeholder="Upload your logo">-->
            <!--            </div>-->
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_info">Client information</label>
                <textarea class="form-control" rows="3" name="client_info" id="client_info" placeholder=""><?php echo escape($user->data()->client_info);?></textarea>
            </div>
        </fieldset>
        <fieldset class="form-group">
            <legend>Edit Payment Method</legend>
            <div class="form-group form-inline">
                <label class="form-control-label mr-2" for="client_tax">client tax</label>
                <input type="hidden" name="client_tax" value=0>
                <input class="form-control" type="number" min="0.01" step="0.01" name="client_tax" id="client_tax" style="width: 90px;" value="<?php echo escape($user->data()->client_tax);?>" />
                <span class="input-group-addon">%</span>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="paypal">
                    <input  type="hidden" name="paypal" value=0>
                    <input class="form-check-input" type="checkbox" name="paypal" id="paypal" value=1 />
                    Paypal</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="visa">
                    <input type="hidden" name="visa" value=0>
                    <input class="form-check-input" type="checkbox" name="visa" id="visa" value=1 />
                    Visa</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="master">
                    <input type="hidden" name="master" value=0>
                    <input class="form-check-input" type="checkbox" name="master" id="master" value=1 />
                    Mastercard</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="ae">
                    <input type="hidden" name="ae" value=0>
                    <input class="form-check-input" type="checkbox" name="ae" id="ae" value=1 />
                    American Express</label>
            </div>
        </fieldset>
        <div class="form-group">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary" type="submit" value="Edit" />
        </div>

    </form>
</div>
<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
