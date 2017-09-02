<?php
require_once  'core/init.php';

$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

// for delete category
if($_POST && isset($_GET['cid'])){
    include_once('tools/category.php');
    include_once("tools/sql.php");
    $db = Database::getInstance();
    $category = new Category($db,$user->data()->client_id);
    $category->delete($_GET['cid']);
}
Redirect::to('category.php');
// end of delete category
?>
