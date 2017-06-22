<?php
require_once 'core/init.php';

$user = new User();
$validate = new Validate();

if ($user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = $validate->check($_POST, array(
            'client_name' => array(
                'name' => 'Client name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'client_site_title' => array(
                'name' => 'Site title',
                'required' => true,
                'max' => 100,
                'unique' => 'client'
            ),
            'client_info' => array(
                'name' => 'Client information',
                'max' => 256
            ),
            'username' => array(
                'name' => 'Username',
                'required' => true,
                'min' => 6,
                'max' => 15,
                'unique' => 'client'
            ),
            'password' => array(
                'name' => 'Password',
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'name' => 'Password again',
                'required' => true,
                'matches' => 'password',
                'matchesTo' => 'Password'
            ),
            'client_admin_email' => array(
                'name' => 'Admin email',
                'required' => true,
                'unique' => 'client',
                'max' => 150
            )
        ));

        if ($validation->passed()) {
            $user = new User();
            $salt = Hash::salt(32);

            try{
                $user->create(array(
                    'client_name' => Input::get('client_name'),
                    'client_site_title' => Input::get('client_site_title'),
                    'client_logo' => Input::get('client_logo'),
                    'client_information' => Input::get('client_info'),
                    'client_tax' => (Input::get('client_tax') ?: 0.0),
                    'payment_option_paypal' => (Input::get('paypal') ?: 0),
                    'payment_option_visa' => (Input::get('visa') ?: 0),
                    'payment_option_mastercard' => (Input::get('master') ?: 0),
                    'payment_option_ae' => (Input::get('ae') ?: 0),
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'client_admin_email' => Input::get('client_admin_email')
                ));

                Session::flash('login', 'You have been registered and can now log in!');
                Redirect::to('login.php');

            } catch (Exception $e){
                die($e->getMessage()); //or you can redirect to other page.
            }
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
    <title>Wecrue - Register</title>
</head>
<body>
<header class="clearfix " style="height: 30vh; background: url(images/cover.jpg) no-repeat center center; background-size: cover;">
    <div class="container pt-3">
        <img src="images/logo.png" alt="Wecreu Logo" class="rounded-circle" style="width: 100px; display: block;">
    </div>
</header>

<nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuContent">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link" href="aboutus.php">About us</a>
                <a class="nav-item nav-link" href="login.php">Log in</a>
                <a class="nav-item nav-link active" href="register.php">Register</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hi there!</h1>
    </div>
</nav>

<div class="container bg-faded py-5">
    <h2 class="mb-4">Registration form</h2>
    <?php
    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post">
        <fieldset class="form-group">
            <legend>Client Information</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_name"><span class="text-danger">*</span> Client name</label>
                <input class="form-control" type="text" name="client_name" id="client_name" placeholder="Enter client's name" value="<?php echo escape(Input::get('client_name'))?>" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_site_title"><span class="text-danger">*</span> Site title</label>
                <input class="form-control" type="text" name="client_site_title" id="client_site_title" placeholder="What will be your site name?" value="<?php echo escape(Input::get('client_site_title'))?>" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_info">Client information</label>
                <textarea class="form-control" rows="3" name="client_info" id="client_info" placeholder="Tell me about your company"><?php echo escape(Input::get('client_info'))?></textarea>
            </div>
        </fieldset>
        <fieldset class="form-group">
            <legend>Client Payment Method</legend>
            <div class="form-group form-inline">
                <label class="form-control-label mr-2" for="client_tax">client tax</label>
                <input type="hidden" name="client_tax" value=0>
                <input class="form-control" type="number" min="0.01" step="0.01" name="client_tax" id="client_tax" style="width: 90px;" value="<?php echo escape(Input::get('client_tax'))?>" />
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
        <fieldset class="form-group">
            <legend>Administrator Registration</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="username"><span class="text-danger">*</span> Username</label>
                <input class="form-control" type="text" name="username" id="username" placeholder="Enter username" value="<?php echo escape(Input::get('username'))?>" autocomplete="off" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="password"><span class="text-danger">*</span> Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Enter password" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="password_again"><span class="text-danger">*</span> Re-enter Password</label>
                <input class="form-control" type="password" name="password_again" id="password_again" placeholder="Re-enter password" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_admin_email"><span class="text-danger">*</span> Admin email</label>
                <input class="form-control" type="email" name="client_admin_email" id="client_admin_email" value="<?php echo escape(Input::get('client_admin_email'))?>" placeholder="Enter email" />
                <small class="form-text text-muted">We will never share your email</small>
            </div>
        </fieldset>

        <div class="form-group">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary" type="submit" value="Register" />
        </div>

    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
