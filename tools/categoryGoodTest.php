<?php

include_once('category.php');
include_once("sql.php");
include_once('good.php');

	// create one db object
  	$db = Database::getInstance();

	//create an object
	// 3 means client id 3
    $category = new Category($db,3);
    $good = new Good($db);


    echo '<br/>Get all categories<br/>';
    $alldata = $category->getAll();
    while ($row = mysqli_fetch_assoc($alldata)) {
        echo "$row[category_id] $row[category_name] $row[category_description] $row[category_display]  $row[client_id]<br/>";
    }



    echo "<br>listing all goods<br>";
    $alldata = $good->getAllGoods();
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] <br />";
    } 


?>