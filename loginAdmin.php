<?php
require_once 'core/init.php';

$user = new Admin();
$validate = new Validate();

if($user->isLoggedIn()){
    Redirect::to('indexAdmin.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validation = $validate->check($_POST, array(
            'admin_username' => array('name' => 'Username', 'required' => true),
            'admin_password' => array('name' => 'Password', 'required' => true)
        ));

        if ($validation->passed()) {
            $user = new Admin();
            //$remember = (Input::get('remember') === 'on') ? true : false;


            if ($login = $user->login(Input::get('admin_username'), Input::get('admin_password')) && $user->data()->validated) {
                if ($login) {
                    Redirect::to('indexAdmin.php');
                } else {
                    $validate->addError('Sorry, you entered wrong admin password.');
                }
            } else{
                $user->logout();
                $validate->addError('Sorry, you cannot login unless you verified your email address');
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
    <title>Wecrue - Admin Login</title>
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
                <a class="nav-item nav-link" href="indexAdmin.php">Home</a>
                <a class="nav-item nav-link active" href="loginAdmin.php">Admin log in</a>
                <a class="nav-item nav-link" href="registerAdmin.php">Admin register</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hi there!</h1>
    </div>
</nav>

<div class="container bg-faded py-5" style="min-height: 65vh">
    <h2 class="mb-4">Admin Log in</h2>
    <?php
    if(Session::exists('loginAdmin')) {
        echo '<p class="text-success">' . Session::flash('loginAdmin') . '</p>';
    }

    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>

    <form action="" method="post">
        <fieldset class="form-group">
            <div class="form-group col-md-4">
                <label class="form-control-label" for="admin_username">Username</label>
                <input class="form-control" type="text" name="admin_username" id="admin_username" placeholder="Enter username" autocomplete="off" value="<?php echo escape(Input::get('admin_username'))?>">
            </div>
            <div class="form-group col-md-4">
                <label for="admin_password" >Password</label>
                <input class="form-control" type="password" name="admin_password" id="admin_password" placeholder="Enter password" autocomplete="off">
            </div>
<!--            <div class="form-group">-->
<!--                <label class="form-control-label" for="remember">-->
<!--                    <input type="checkbox" name="remember" id="remember"> Remember me-->
<!--                </label>-->
<!--            </div>-->
            <div class="form-group">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input class="btn btn-primary" type="submit" value="Log in">

            </div>
<!--            <a href="forgetpassword.php"><small class="text-info">Forgot Password?</small></a>-->
        </fieldset>
    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
