<?php
require_once 'core/init.php';
require_once 'classes/email/send.php';

$user = new Admin();
$validate = new Validate();

if ($user->isLoggedIn()){
    Redirect::to('indexAdmin.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = $validate->check($_POST, array(
            'client_name' => array(
                'name' => 'Admin name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'admin_username' => array(
                'name' => 'Username',
                'required' => true,
                'min' => 6,
                'max' => 15,
                'unique' => 'admin'
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
            'admin_email' => array(
                'name' => 'Admin email',
                'required' => true,
                'unique' => 'admin',
                'max' => 150
            )
        ));

        if ($validation->passed()) {
            $user = new Admin();
            $salt = Hash::salt(32);
            $validateHash = Hash::string(255);
            $date = new DateTime();
            $date->add(new DateInterval('PT24H'));

            try{
                $user->create(array(
                    'admin_name' => Input::get('client_name'),
                    'admin_username' => Input::get('admin_username'),
                    'admin_password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'admin_email' => Input::get('admin_email'),
                    'validate_hash' => $validateHash,
                    'validate_expire' => $date->format('Y-m-d H:i:s')
                ));

                ob_start();
                include('includes/templates/email_validateemailAdmin.inc');
                $emailBody = ob_get_contents();
                ob_end_clean();

                sendEmail(escape(Input::get('admin_email')), 'Wecreu', 'Validate email address', $emailBody, escape(Input::get('client_name')));

                Session::flash('loginAdmin', 'You have been registered! Please verify your email first before logging in.');
                Redirect::to('loginAdmin.php');

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
    <title>Wecrue - Admin Register</title>
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
                <a class="nav-item nav-link" href="loginAdmin.php">Admin log in</a>
                <a class="nav-item nav-link active" href="registerAdmin.php">Admin register</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hi there!</h1>
    </div>
</nav>

<div class="container bg-faded py-5">
    <h2 class="mb-4">Admin registration form</h2>
    <?php
    if(Session::exists('registerAdmin')) {
        echo '<p class="text-success">' . Session::flash('registerAdmin') . '</p>';
    }

    if(Session::exists('registerAdminError')) {
        echo '<p class="text-danger">' . Session::flash('registerAdminError') . '</p>';
    }

    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post">
        <fieldset class="form-group">
            <legend>Admin Information</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_name"><span class="text-danger">*</span> Admin name</label>
                <input class="form-control" type="text" name="client_name" id="client_name" placeholder="Enter client's name" value="<?php echo escape(Input::get('client_name'))?>" />
            </div>
        </fieldset>
        <fieldset class="form-group">
            <legend>Admin Registration</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="admin_username"><span class="text-danger">*</span> Username</label>
                <input class="form-control" type="text" name="admin_username" id="admin_username" placeholder="Enter username" value="<?php echo escape(Input::get('admin_username'))?>" autocomplete="off" />
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
                <label class="form-control-label" for="admin_email"><span class="text-danger">*</span> Admin email</label>
                <input class="form-control" type="email" name="admin_email" id="admin_email" value="<?php echo escape(Input::get('admin_email'))?>" placeholder="Enter email" />
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
