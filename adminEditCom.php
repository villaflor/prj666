<?php
require_once 'core/init.php';
$clientId = Input::get('clientId');
$admin = new Admin();

if (!$admin->isLoggedIn()){
    Redirect::to('indexAdmin.php');
}

if (!$clientId){
    Redirect::to('indexAdmin.php');
}


$user = new User($clientId);
$validate = new Validate();

if(Input::exists()){
    if(Token::check(Input::get('token'))){
		if  (strcmp($_POST['client_admin_email'],$user->data()->client_admin_email) == 0){
			$validation = $validate->check($_POST, array(

				'client_information' => array(
					'name' => 'Client information',
					'max' => 256
				)
			));
		}
		else {
			$validation = $validate->check($_POST, array(

				'client_information' => array(
					'name' => 'Client information',
					'max' => 256
				),
				'client_admin_email' => array(
					'name' => 'Admin email',
					'required' => true,
					'unique' => 'client',
					'max' => 150
				)
			));
		}
		if($validation->passed()){

			try{

					$user->update(array(
						'client_information' => Input::get('client_information'),
						'client_tax' => (Input::get('client_tax') ?: 0.0),
						'payment_option_paypal' => (Input::get('paypal') ?: 0),
						'payment_option_visa' => (Input::get('visa') ?: 0),
						'payment_option_mastercard' => (Input::get('master') ?: 0),
						'payment_option_ae' => (Input::get('ae') ?: 0),
						'client_admin_email' => Input::get('client_admin_email')
					), $clientId);


                Session::flash('clientD', 'Client information has been updated.');
                Redirect::to('clientDetail.php?clientId=' . $clientId);

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
                <a class="nav-item nav-link" href="indexAdmin.php">Home</a>
                <a class="nav-item nav-link" href="monitor.php">Monitor Client</a>
                <a class="nav-item nav-link" href="logoutAdmin.php">Log out</a>
            </div>
        </div>

        <h1 class="navbar-brand mb-0 mr-3">Hello Admin <a class="text-white" href="profileAdmin.php?user=<?php echo escape($admin->data()->admin_username); ?>"><?php echo escape($admin->data()->admin_name); ?></a>!</h1>
    </div>
</nav>
<div class="container bg-faded py-5">
    <h2 class="mb-4">Update company information</h2>
    <?php
    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post">
        <fieldset class="form-group">
            <legend>Update Information</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_name">Client name</label>
                <input class="form-control" type="text" name="client_name" id="client_name" placeholder="" value="<?php echo escape($user->data()->client_name);?>" disabled="disabled"/>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_site_title">Site title</label>
                <input class="form-control" type="text" name="client_site_title" id="client_site_title" placeholder="Edit site title" value="<?php echo escape($user->data()->client_site_title);?>" disabled = "disabled" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_information">Client information</label>
                <textarea class="form-control" rows="3" name="client_information" id="client_information" placeholder=""><?php echo escape($user->data()->client_information);?></textarea>
            </div>
        </fieldset>
        <fieldset class="form-group">
            <legend>Update Payment Method</legend>
            <div class="form-group form-inline">
                <label class="form-control-label mr-2" for="client_tax">Total tax</label>
                <input type="hidden" name="client_tax" value=0>
                <input class="form-control" type="number" min="0.01" step="0.01" name="client_tax" id="client_tax" style="width: 90px;" value="<?php echo escape($user->data()->client_tax);?>" />
                <span class="input-group-addon">%</span>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="paypal">
                    <input  type="hidden" name="paypal" value=0>
                    <input class="form-check-input" type="checkbox" name="paypal" id="paypal" value=1 <?php echo ($user->data()->payment_option_paypal==1 ? 'checked' : '');?> />
                    Paypal</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="visa">
                    <input type="hidden" name="visa" value=0>
                    <input class="form-check-input" type="checkbox" name="visa" id="visa" value=1 <?php echo ($user->data()->payment_option_visa==1 ? 'checked' : '');?> />
                    Visa</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="master">
                    <input type="hidden" name="master" value=0>
                    <input class="form-check-input" type="checkbox" name="master" id="master" value=1 <?php echo ($user->data()->payment_option_mastercard==1 ? 'checked' : ''); ?> />
                    Mastercard</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="ae">
                    <input type="hidden" name="ae" value=0>
                    <input class="form-check-input" type="checkbox" name="ae" id="ae" value=1 <?php echo ($user->data()->payment_option_ae==1 ? 'checked' : ''); ?> />
                    American Express</label>
            </div>
			<div class="form-group col-md-6">
                <label class="form-control-label" for="client_admin_email">Admin email</label>
                <input class="form-control" type="email" name="client_admin_email" id="client_admin_email" value="<?php echo escape($user->data()->client_admin_email)?>"  />
                <small class="form-text text-muted">We will never share your email</small>
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
