<?php
require_once 'core/init.php';

$user = new Admin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue Admin</title>
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
                <a class="nav-item nav-link active" href="indexAdmin.php">Home</a>
                <?php

                if($user->isLoggedIn()) {
                ?>
                <a class="nav-item nav-link" href="logoutAdmin.php">Log out</a>
            </div>
        </div>

        <h1 class="navbar-brand mb-0 mr-3">Hello Admin <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->admin_username); ?>"><?php echo escape($user->data()->admin_name); ?></a>!</h1>

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

</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
