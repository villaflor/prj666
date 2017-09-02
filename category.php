<?php
require_once  'core/init.php';

$user = new User();
$validate = new Validate();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

$categories = new Category();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue - Category</title>
</head>
<body>

<nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuContent">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="index.php">Home</a>
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
                    <a class="nav-item nav-link dropdown-toggle active" href="#"
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
    </div>
</nav>

<div class="container bg-faded py-5" style="min-height: 100vh">
    <h2 class="mb-4">List of Categories</h2>
    <?php
    if(Session::exists('category')) {
    echo '<p class="text-success">' . Session::flash('category') . '</p>';
    }
    ?>


    <table class="table table-striped" style="table-layout: fixed; width: 100%">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Visible</th>
            <th>Actions</th>
        </tr>
        <?php
        $categories->getCategory($user->data()->client_id);
        foreach ($categories->data() as $category){
            echo '<tr>';
            echo '<th>'. $category->category_name .'</th>';
            echo '<td style="word-wrap: break-word">'. $category->category_description .'</td>';
            if ($category->category_display) {
                echo '<td>Yes</td>';
            } else{
                echo '<td>No</td>';
            }
            ?>
            <td>
              <form action="categoryDel.php?cid=<?php echo $category->category_id;?>" method="post">
                <a class="btn btn-warning" href="editcategory.php?user=<?php echo $user->data()->username .'&categoryNo='. $category->category_id;?>">Edit</a>
                <input type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Do you want to delete this category?');" value="Delete">
              </form>
            </td>
            <?php
            // echo '<td><a href="editcategory.php?user='. $user->data()->username .'&categoryNo='. $category->category_id .'">edit</a></td>';



            echo '</tr>';
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
