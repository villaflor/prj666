<?php
if(!isset($_GET['name']) || $_GET['name'] == ""){
  exit;
}

include_once("sql.php");
$db = Database::getInstance()->getConnection();

$query = "SELECT * FROM good WHERE `good_name` = '" . $_GET['name']."'  ";
$result = $db->query($query);

$total=mysqli_num_rows($result);
if($total == 0) {
  echo "";
}else{
  echo "* The product name is exist, try another name";
}
?>
