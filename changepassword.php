<?php
require_once  'core/init.php';

$user = new User();
$validate = new Validate();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = $validate->check($_POST, array(
            'current_password' => array(
                'name' => 'Current password',
                'required' => true,
            ),
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
            if(Hash::make(Input::get('current_password'), $user->data()->salt) !== $user->data()->password){
                $validate->addError('Current password is incorrect.');
            } else{
                $salt = Hash::salt(32);
                try{
                    $user->update(array(
                        'password' => Hash::make(Input::get('new_password'), $salt),
                        'salt' => $salt
                    ));
                    Session::flash('changeP', 'Your password have been change.');
                } catch (Exception $e){
                    die($e->getMessage());
                }
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
    <title>Wecrue - Change Password</title>
</head>
<body>

<?php
include("narbar.php");
?>

<div class="container bg-faded py-5" style="min-height: 100vh">
    <h2 class="mb-4">Change password</h2>
    <?php
    if(Session::exists('changeP')) {
        echo '<p class="text-success">' . Session::flash('changeP') . '</p>';
    }

    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post">
        <div class="form-group col-md-6">
            <label class="form-control-label" for="current_password"><span class="text-danger">*</span> Current password</label>
            <input class="form-control" type="password" name="current_password" id="current_password">
        </div>
        <div class="form-group col-md-6">
            <label class="form-control-label" for="new_password"><span class="text-danger">*</span> New password</label>
            <input class="form-control" type="password" name="new_password" id="new_password">
        </div>
        <div class="form-group col-md-6">
            <label class="form-control-label" for="new_password_again"><span class="text-danger">*</span> Re-enter password</label>
            <input class="form-control" type="password" name="new_password_again" id="new_password_again">
        </div>

        <div class="form-group pt-5">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary" type="submit" value="Change">
        </div>
    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
