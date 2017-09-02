<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">

<?php
if (file_exists ("../template.php")){
  $color="#429c76";
  include_once("../template.php");
}
$clientId = file_get_contents('conf.ini');
$contact = file_get_contents('contact.ini');
include_once('/data/www/default/wecreu/tools/category.php');
include_once("/data/www/default/wecreu/tools/sql.php");
include_once("/data/www/default/wecreu/tools/client.php");
include_once("/data/www/default/wecreu/tools/search.php");
include_once("/data/www/default/wecreu/tools/page.php");
$db = Database::getInstance();
$client = new Client($db, $clientId);
$category = new Category($db, $clientId);
$search = new Search($db, $clientId);
$page = new Page($db,$clientId);
?>
