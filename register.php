<?php
require_once 'core/init.php';
require_once 'classes/email/send.php';

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
            $validateHash = Hash::string(255);
            $date = new DateTime();
            $date->add(new DateInterval('PT24H'));

            try{
                $user->create(array(
                    'client_name' => Input::get('client_name'),
                    'client_site_title' => Input::get('client_site_title'),
                    'client_logo' => Input::get('client_logo'),
                    'client_information' => Input::get('client_info'),
					'phone_number' => Input::get('phone_number'),
                    'client_tax' => (Input::get('client_tax') ?: 0.0),
                    'payment_option_paypal' => (Input::get('paypal') ?: 0),
                    'payment_option_visa' => (Input::get('visa') ?: 0),
                    'payment_option_mastercard' => (Input::get('master') ?: 0),
                    'payment_option_ae' => (Input::get('ae') ?: 0),
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'client_admin_email' => Input::get('client_admin_email'),
                    'validate_hash' => $validateHash,
                    'validate_email_expire' => $date->format('Y-m-d H:i:s')
                ));

                ob_start();
                include('includes/templates/email_validateemail.inc');
                $emailBody = ob_get_contents();
                ob_end_clean();

                sendEmail(escape(Input::get('client_admin_email')), 'Wecreu', 'Validate email address', $emailBody, escape(Input::get('client_name')));

                Session::flash('login', 'You have been registered! Please verify your email first before logging in.');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    if(Session::exists('register')) {
        echo '<p class="text-success">' . Session::flash('register') . '</p>';
    }

    if(Session::exists('registerError')) {
        echo '<p class="text-danger">' . Session::flash('registerError') . '</p>';
    }

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
                <input required class="form-control" type="text" maxlength="30" name="client_name" id="client_name" placeholder="Enter client's name" value="<?php echo escape(Input::get('client_name'))?>" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_site_title"><span class="text-danger">*</span> Site title</label>
                <input required class="form-control" type="text" maxlength="30" name="client_site_title" id="client_site_title" placeholder="What will be your site name?" value="<?php echo escape(Input::get('client_site_title'))?>" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_info">Client information</label>
                <textarea class="form-control" maxlength="256" rows="3" name="client_info" id="client_info" placeholder="Tell me about your company"><?php echo escape(Input::get('client_info'))?></textarea>
            </div>
			<div class="form-group col-md-6">
                <label class="form-control-label" for="phone_number"><span class="text-danger">*</span> Client phone number</label>
                <input class="form-control" type="text" maxlength="10"  name="phone_number" id="phone_number" required placeholder="Format: ##########" value="<?php echo escape(Input::get('phone_number'))?>" />
                <p style="color:red;" id="phoneErr"></p>
            </div>
        </fieldset>
        <fieldset class="form-group">
            <legend>Client Payment Method</legend>
            <div class="form-group form-inline">
                <label class="form-control-label mr-2" for="client_tax">client tax</label>
                <input type="hidden" name="client_tax" value=0>
                <input class="form-control" type="number" min="0.00" step="0.01" name="client_tax" id="client_tax" style="width: 90px;" value="13" />
                <span class="input-group-addon">%</span>
                <p style="color:red;" id="taxErrMsg"></p>
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
            <legend>Client Registration</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="username"><span class="text-danger">*</span> Username</label>
                <input required class="form-control" type="text" maxlength="15" name="username" id="username" placeholder="Enter username" value="<?php echo escape(Input::get('username'))?>" autocomplete="off" />
                <p style="color:red;" id="nameErr"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="password"><span class="text-danger">*</span> Password</label>
                <input required class="form-control" type="password" maxlength="64" name="password" id="password" placeholder="Enter password" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="password_again"><span class="text-danger">*</span> Re-enter Password</label>
                <input required class="form-control" type="password" maxlength="64" name="password_again" id="password_again" placeholder="Re-enter password" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_admin_email"><span class="text-danger">*</span> Admin email</label>
                <input class="form-control" type="email" maxlength="150" name="client_admin_email" id="client_admin_email" required value="<?php echo escape(Input::get('client_admin_email'))?>" placeholder="Enter email" />
                <small class="form-text text-muted">We will never share your email</small>
            </div>
        </fieldset>

        <div class="form-group">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input id="subm" class="btn btn-primary" type="submit" value="Register" />
        </div>

    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    var originalTax = $("#client_tax").val();

    var cheSub = function(){
      if($("#taxErrMsg").text() == "" && $("#nameErr").text() == "" && $("#phoneErr").text() == ""){
          $("#subm").removeAttr("disabled");
      } else {
          $("#subm").attr("disabled","disabled");
      }
    };
    $("#client_tax").blur(function(){
        var tax = this.value;
        if(tax < 0 || tax >= 100){
            $("#client_tax").val(originalTax);
            $("#taxErrMsg").text("* Your tax must be between 0 ~ 99.99%");
        }else{
            $("#taxErrMsg").text("");
        }
    });

    var specialChars = "\ <>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
    var check = function(string){
        for(i = 0; i < specialChars.length;i++){
            if(string.indexOf(specialChars[i]) > -1){
                return true
            }
        }
        return false;
    }

    $("#username").blur(function(){
        var name = $("#username").val();
        if(!check(name)){
            $("#nameErr").text("");
            cheSub();

        }else{
            $("#nameErr").text("Please don't contain any special charactor or space");
            cheSub();
        }
    });

    var phoneVali = function(){
         var phone = $("#phone_number").val();
         return phone.match(/[0-9]{10}/);
    }

    $("#phone_number").blur(function(){
        var phone = $("#phone_number").val();
        if(phoneVali()){
            $("#phoneErr").text("");
            cheSub();
        }else{
            $("#phoneErr").text("Please follow the format: ##########");
            cheSub();
        }
    });
</script>
</body>
</html>
