<?php

include_once('category.php');
include_once("sql.php");


    $db = Database::getInstance();
        


	//create an object
    $category = new Category($db,3);
	
    // add one
    if ($category->add("testing name", "tesing description")){
    	echo "add #1 success<br>";
    }else{
    	echo "add #1 fail<br>";
    }

    //edit 
    if ($category->edit(12, "testing name after editing", "tesing description after editing")){
    	echo "edit success<br>";
    }else{
    	echo "edit fail<br>";
    }
    
    if ($category->hide(13)){
    	echo "hide sucess<br>";
    }else{
    	echo "hide fail<br>";
    }
    
    if ($category->show(13)){
    	echo "show success<br>";
    }else{
    	echo "show fail<br>";
    }

    $category->hide(14);

    // call get all
	echo '<br/>Get all<br/>';
    $alldata = $category->getAll();
    while ($row = mysqli_fetch_assoc($alldata)) {
        echo "$row[category_id] $row[category_name] $row[category_description] $row[category_display]  $row[client_id]<br/>";
    }
	
	// call get all non hidden categories
	echo '<br/>Get all avaliable<br/>';
    $alldata = $category->getAllAvaliable();
    while ($row = mysqli_fetch_assoc($alldata)) {
        echo "$row[category_id] $row[category_name] $row[category_description] $row[category_display]  $row[client_id]<br/>";
    }

	echo '<br/>Get one<br/>';
    $alldata = $category->getOne(134);
    while ($row = mysqli_fetch_assoc($alldata)) {
        echo "$row[category_id] $row[category_name] $row[category_description] $row[category_display]  $row[client_id]<br/>";
    }
?>
