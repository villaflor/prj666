<?php
require_once 'core/init.php';

$user = new Admin();
$client = new Client();

if(!$user->isLoggedIn()){
    Redirect::to("indexAdmin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue - Monitor</title>
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

<div class="container bg-faded py-5" style="min-height: 65vh">
    <?php
    if(Session::exists('monitor')) {
        echo '<p class="text-success">' . Session::flash('monitor') . '</p>';
    }
    ?>
    <h2 class="mb-4">List of clients</h2>
    <h3 class="mb-4">Payment due</h3>
    <table class="table table-striped">
        <tr>
            <th>Client Name</th>
            <th>Client Site Title</th>
            <th>Last payment</th>
            <th>Number of days due</th>
            <th>Actions</th>
        </tr>
        <?php
        $date = new DateTime("-1 months");
        $client->getClient(array('last_payment', '<', $date->format('Y-m-d H:i:s')));
        if($client->exists()) {
            $allClients = $client->data();

            foreach ($allClients as $item) {

                echo '<tr>';
                echo '<th>' . $item->client_name . '</th>';
                echo '<td>' . $item->client_site_title . '</td>';
                echo '<td>' . $item->last_payment . '</td>';
                echo '<td>' . $date->diff(new DateTime($item->last_payment))->format("%a") .'</td>';
                echo '<td><a href="clientDetail.php?clientId='.$item->client_id.'">details</a> | <a href="sendEmailToClient.php?email=' . $item->client_admin_email . '&name=' . $item->client_name .'">send email</a></td>';
                echo '</tr>';



            }
        }

        ?>
    </table>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
