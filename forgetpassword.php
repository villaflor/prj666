<?php
require_once  'core/init.php';
require 'classes/email/send.php';

$user = new User();
$validate = new Validate();

if($user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = $validate->check($_POST, array(
            'email' => array(
                'name' => 'email',
                'required' => true,
            ),
        ));

        if($validation->passed()){
            if($user->emailExist(Input::get('email'))){


                $identifier = Hash::string(255);

                try{
                    $user->update(array(
                        'recovery_hash' => $identifier,
                    ), $user->data()->client_id);

                } catch (Exception $e){
                    die($e->getMessage());
                }
                // Send an email

                ob_start();
                include('includes/templates/email_resetpassword.inc');
                $emailBody = ob_get_contents();
                ob_end_clean();

                sendEmail(escape(Input::get('email')), 'Wecreu', 'Change password instruction', $emailBody, escape($user->data()->client_name));
                Session::flash('forgetP', 'Instruction to reset password has been sent to your email.');
            } else{
                Session::flash('forgetP', 'Instruction to reset password has been sent to your email.');
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
    <title>Wecrue - Forget Password</title>
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
<div class="container bg-faded py-5" style="min-height: 65vh">
    <h2 class="mb-4">Find your account</h2>
    <?php
    if(Session::exists('forgetP')) {
        echo '<p class="text-success">' . Session::flash('forgetP') . '</p>';
    }

    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>

    <form action="" method="post" autocomplete="off">
        <fieldset class="form-group">
            <div class="form-group col-md-4">
                <label  class="form-control-label" for="email">Email address: </label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Enter email address">
            </div>
            <div class="form-group">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </fieldset>
    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>




