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
    <title>Wecrue</title>
</head>
<body>
<header class="clearfix " style="height: 30vh; background: url(images/cover.jpg) no-repeat center center; background-size: cover;">
    <div class="container pt-3">
        <img src="images/logo.png" alt="Wecreu Logo" class="rounded-circle" style="width: 100px; display: block;">
    </div>
</header>
<?php
include("narbar.php");
?>
<div class="container bg-faded py-5" style="min-height: 65vh">
    <h2 class="mb-4 text-center">Templates</h2>
    <div class="row">
        <div class="col-sm-12 col-md-4 pb-3">
            <a href="includes/templates/green/index.php">
                <img src="images/t-green.png" alt="Green Template" class="img-thumbnail">
                <h5 class="pt-1 mb-4 text-center">Green</h5>
            </a>
        </div>
        <div class="col-sm-12 col-md-4 pb-3">
            <a href="includes/templates/red/index.php">
                <img src="images/t-red.png" alt="Red Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Red</h5>
            </a>
            <p>A standar site for unlimited categories or goods. It shows the top sales items on the index page.</p>
        </div>
        <div class="col-sm-12 col-md-4 pb-3">
            <a href="includes/templates/blue/index.php">
                <img src="images/t-blue.png" alt="Blue Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Blue</h5>
            </a>
        </div>
        <div class="col-sm-12 col-md-4 pb-3">
            <a href="includes/templates/grey/index.php">
                <img src="images/t-grey.png" alt="Grey Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Grey</h5>
            </a>
            <p>This template is designed for limited goods and categories. It doesn't support search function. When customers move to another page( from good list to good detail), it will not refresh the whole page. At the buttom of the template, it allows customers connect quickly with client. It is good for selling serveices.</p>
        </div>
    </div>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



