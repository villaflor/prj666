<?php
require_once  'core/init.php';
require_once 'classes/email/send.php';

$user = new Admin();
$validate = new Validate();

$clientEmail = Input::get('email');
$clientName = Input::get('name');

if(!$user->isLoggedIn()){
    Redirect::to('indexAdmin.php');
}

if(!$clientEmail && !$clientName){
    Redirect::to('indexAdmin.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = $validate->check($_POST, array(
            'message' => array(
                'name' => 'Message',
                'required' => true,
            )
        ));

        if($validation->passed()){

            sendEmail(escape($clientEmail), 'Message from Wecreu', 'Message from Wecreu Admin ' . escape(Input::get('sender')), Input::get('message'), escape($clientName));

            Session::flash('monitor', 'Your email to '.$clientName.' has been send.');
            Redirect::to('monitor.php');
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
    <title>Wecrue - Send Email</title>
</head>
<body>

<nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuContent">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="indexAdmin.php">Home</a>
                <?php

                if($user->isLoggedIn()) {
                ?>
                <a class="nav-item nav-link active" href="monitor.php">Monitor Client</a>
                <a class="nav-item nav-link" href="logoutAdmin.php">Log out</a>
            </div>
        </div>

        <h1 class="navbar-brand mb-0 mr-3">Hello Admin <a class="text-white" href="profileAdmin.php?user=<?php echo escape($user->data()->admin_username); ?>"><?php echo escape($user->data()->admin_name); ?></a>!</h1>

        <?php
        } else{
        ?>
        <a class="nav-item nav-link" href="loginAdmin.php">Admin log in</a>
        <a class="nav-item nav-link" href="registerAdmin.php">Admin register</a>
    </div>
    </div>

    <h1 class="navbar-brand mb-0 mr-3">Hi there!</h1>

    <?php
    }
    ?>

    </div>
</nav>

<div class="container bg-faded py-5" style="min-height: 100vh">
    <h2 class="mb-4">Change password</h2>
    <?php
    if(Session::exists('sendETC')) {
        echo '<p class="text-success">' . Session::flash('sendETC') . '</p>';
    }

    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post">
        <div class="form-group col-md-6">
            <label class="form-control-label" for="recipient">To</label>
            <input class="form-control" value="<?php echo $clientName?> (<?php echo $clientEmail?>)" type="text" name="recipient" id="recipient" disabled>
        </div>
        <div class="form-group col-md-12">
            <label class="form-control-label" for="message"><span class="text-danger">*</span> Message</label>
            <textarea class="form-control" rows="10" name="message" id="message" placeholder="Type your message here."><?php echo escape(Input::get('message'))?></textarea>
        </div>
        <div class="form-group col-md-6">
            <label class="form-control-label" for="sender">From</label>
            <input class="form-control" value="<?php echo $user->data()->admin_name?>" type="text" name="sender" id="sender" disabled>
        </div>

        <div class="form-group pt-5">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary" type="submit" value="Send">
        </div>
    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

