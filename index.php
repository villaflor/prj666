<?php
require_once 'core/init.php';

$user = new User();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollto/1.4.6/jquery-scrollto.min.js"></script>
    <title>Wecrue</title>
    <style>
    .rTop{
        width:100px; height:25px;
        background: white;
        text-align:center; font-size:small;
        line-height:25px; border:1px solid #999;
        position:fixed; left:1%; top: 80%;
        border-bottom-color:#333;
        border-right-color:#333; margin:5px;
        cursor:pointer; display:none;
        z-index:99999;
    }
    </style>
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
                <a class="nav-item nav-link active" href="index.php">Home</a>
                <?php

                if($user->isLoggedIn()) {
                ?>
                <a class="nav-item nav-link" href="generateTemplate.php">Generate site</a>
                <a class="nav-item nav-link" href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="profileDropdown"
                    >Account</a>

                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="edit-com.php">Update account</a>
                        <a class="dropdown-item" href="changepassword.php">Change password</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        id="pageDropdown"
                    >Page</a>
                    <div class="dropdown-menu" aria-labelledby="pageDropdown">
                        <a class="dropdown-item" href="editCover.php">Edit cover</a>
                        <a class="dropdown-item" href="editFooter.php">Edit footer</a>
                        <a class="dropdown-item" href="editAboutUs.php">Edit about us</a>
                        <a class="dropdown-item" href="pageList.php">View pages</a>
                        <a class="dropdown-item" href="addPage.php">Create page</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="categoryDropdown"
                    >Category</a>

                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <a class="dropdown-item" href="category.php">View categories</a>
                        <a class="dropdown-item" href="addCategoryForm.php">Create category</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="goodDropdown"
                    >Good</a>

                    <div class="dropdown-menu" aria-labelledby="goodDropdown">
                        <a class="dropdown-item" href="good.php">View goods</a>
                        <a class="dropdown-item" href="create-good.php">Create good</a>
                        <a class="dropdown-item" href="edit-good.php">Edit good</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="saleDropdown"
                    >Sale</a>

                    <div class="dropdown-menu" aria-labelledby="saleDropdown">
                        <a class="dropdown-item" href="sale.php">View sales</a>
                        <a class="dropdown-item" href="onsale.php">Goods on sale</a>
                        <a class="dropdown-item" href="createsale.php">Create Sale</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="saleDropdown"
                    >Orders</a>

                    <div class="dropdown-menu" aria-labelledby="saleDropdown">
                        <a class="dropdown-item" href="orderList.php">View orders</a>
                    </div>
                </div>

                <a class="nav-item nav-link" href="logout.php">Log out</a>
            </div>
        </div>

        <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>

        <?php
        } else{
        ?>
        <a class="nav-item nav-link" href="aboutus.php">About us</a>
        <a class="nav-item nav-link" href="login.php">Log in</a>
        <a class="nav-item nav-link" href="register.php">Register</a>
    </div>
    </div>

    <h1 class="navbar-brand mb-0 mr-3">Hi there!</h1>

    <?php
    }
    ?>

    </div>
</nav>
<div class="rTop" id="rTop" onClick="toTop()">Back To Top</div>

<div class="container bg-faded py-5" style="min-height: 65vh">
    <h2 class="mb-4 text-center">Templates</h2>
    <div class="row">
        <div class="col-sm-12 col-md-6 pb-3">
            <a href="includes/templates/green/index.php">
                <img src="images/t-green.png" alt="Green Template" class="img-thumbnail">
                <h5 class="pt-1 mb-4 text-center">Green</h5>
            </a>
            <p>A very simple site to display all your products. It has responsive display feature. It is green.</p>
        </div>
        <div class="col-sm-12 col-md-6 pb-3">
            <a href="includes/templates/red/index.php">
                <img src="images/t-red.png" alt="Red Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Red</h5>
            </a>
            <p>A standard site for unlimited categories or goods. It shows the all sales items on the index page. It's red.</p>
        </div>
        <div class="col-sm-12 col-md-6 pb-3">
            <a href="includes/templates/blue/index.php">
                <img src="images/t-blue.png" alt="Blue Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Blue</h5>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 pb-3">
            <a href="includes/templates/grey/index.php">
                <img src="images/t-grey.png" alt="Grey Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Grey</h5>
            </a>
            <p>This template is designed for limited goods and categories. It doesn't support search function. When customers move to another page( from good list to good detail), it will not refresh the whole page. At the bottom of the template, it allows customers connect quickly with client. It is good for selling services.</p>
        </div>
    </div>
    <hr/>
    <div id="feature" class="col-md-12">
        <h1 style="color:#186bd6" class="text-center pb-3"><b><i>Features</i></b></h1>
        <hr/>
        <div style="border: 1px solid silver; padding:10px; margin: 20px 0;">
            <h2 class="pl-1" style="color:#186bd6"><i>Create your site</i></h2>
            <p class="pb-3 pl-3">Generate with two clicks.</p>
            <img class="col-md-12" src="images/generate.jpg" />
        </div>
        <div style="border: 1px solid silver; padding:10px; margin: 20px 0;">
            <h2 class="pr-1 text-right" style="color:#186bd6"><i>Templates change</i></h2>
            <p class="pb-3 pr-3 text-right">Change your site's style.</p>
            <img class="col-md-12" src="images/template.jpg" />
        </div>
            <div style="border: 1px solid silver; padding:10px; margin: 20px 0;">
            <h2 class="pl-1" style="color:#186bd6"><i>Inventory control</i></h2>
            <p class="pb-3 pl-3">Manage your products and sell them.</p>
            <img class="col-md-12" src="images/inventory.jpg" />
        </div>
        <div style="border: 1px solid silver; padding:10px; margin: 20px 0;">
            <h2 class="pr-1 text-right" style="color:#186bd6"><i>Promotion sales</i></h2>
            <p class="pb-3 pr-3 text-right">Recomand products to your customers.</p>
            <img class="col-md-12" src="images/promotion.jpg" />
        </div>
        <div style="border: 1px solid silver; padding:10px; margin: 20px 0;">
            <h2 class="pl-1" style="color:#186bd6"><i>Dynamic page</i></h2>
            <p class="pb-3 pl-3">Custom your site in a easy way.</p>
            <img class="col-md-12" src="images/page.jpg" />
        </div>
    </div>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script>
   window.onscroll=function(){
     if(document.body.scrollTop||document.documentElement.scrollTop>0){
       document.getElementById('rTop').style.display="block"
     }else{
       document.getElementById('rTop').style.display="none"
     }
   }
   function toTop(){
     $('html, body').animate({
       scrollTop: 0
     }, 500);
     document.getElementById('rTop').style.display="none"
   }
 </script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
