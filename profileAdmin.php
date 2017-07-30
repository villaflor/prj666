<?php
require_once 'core/init.php';

$user = new Admin();

if(!$user->isLoggedIn()){
    Redirect::to('indexAdmin.php');
}

$adminUsername = $user->data()->admin_username;

if($adminUsername !== Input::get('user')){
    Redirect::to(404);
} else{
    $user = new Admin($adminUsername);
    if(!$user->exists()){
        Redirect::to(404);
    } else{
        $data = $user->data();
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Wecrue - Admin Profile</title>
    </head>
    <body>

    <nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuContent">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link active" href="indexAdmin.php">Home</a>

                    <a class="nav-item nav-link" href="logoutAdmin.php">Log out</a>
                </div>
            </div>

            <h1 class="navbar-brand mb-0 mr-3">Hello Admin <a class="text-white" href="profileAdmin.php?user=<?php echo escape($user->data()->admin_username); ?>"><?php echo escape($user->data()->admin_name); ?></a>!</h1>
        </div>
    </nav>

    <div class="container bg-faded py-5" style="min-height: 100vh">
        <h1 class="mb-4">Admin profile</h1>
        <div class="container mb-4">
            <section class="container py-5 bg-primary rounded mb-4">
                <div class="row mb-5">
                    <div class="container col-6">
                        <div class="col mb-5">
                            <p>Client name</p><hr>
                            <h3 class="text-white">
                                <?php
                                echo $user->data()->admin_name;
                                ?>
                            </h3>
                        </div>

                    </div>
                    <div class="container col-6">
                        <div class="col mb-5">
                            <p>Username</p><hr>
                            <h3 class="text-white">
                                <?php
                                echo $user->data()->admin_username;
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php include('includes/footer.inc'); ?>

    <script src="js/jquery-3.1.1.slim.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>

    <?php
}
