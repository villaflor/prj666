<?php
require_once  'core/init.php';

$user = new User();
$validate = new Validate();
$email = Input::get('email');
$identifier = Input::get('identifier');

if($user->isLoggedIn()){
    Redirect::to('index.php');
}

if(!$user->emailExist($email)){
    Redirect::to('index.php');
}

if(!$user->data()->recovery_hash){
    Redirect::to('index.php');
}

if($identifier !== $user->data()->recovery_hash){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = $validate->check($_POST, array(
            'new_password' => array(
                'name' => 'New password',
                'required' => true,
                'min' => 6,
            ),
            'new_password_again' => array(
                'name' => 'New password again',
                'required' => true,
                'matches' => 'new_password',
                'matchesTo' => 'New Password'
            ),
        ));

        if($validation->passed()){
            $salt = Hash::salt(32);
            try{
                $user->update(array(
                    'password' => Hash::make(Input::get('new_password'), $salt),
                    'salt' => $salt,
                    'recovery_hash' => NULL
                ), $user->data()->client_id);
                Session::flash('login', 'Your password have been change.');
                Redirect::to('login.php');
            } catch (Exception $e){
                die($e->getMessage());
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
    <title>Wecrue - Reset Password</title>
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
                <a class="nav-item nav-link" href="register.php">Register</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hi there!</h1>
    </div>
</nav>
<div class="container bg-faded py-5" style="min-height: 100vh">
    <h2 class="mb-4">Reset password</h2>
    <?php
    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post">
        <div class="form-group col-md-6">
            <label class="form-control-label" for="new_password">New password</label>
            <input class="form-control" type="password" name="new_password" id="new_password">
        </div>
        <div class="form-group col-md-6">
            <label class="form-control-label" for="new_password_again">Re-enter password</label>
            <input class="form-control" type="password" name="new_password_again" id="new_password_again">
        </div>
        <div class="form-group pt-5">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary"  type="submit" value="Change">
        </div>
    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
