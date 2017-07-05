<?php

include('category.php');

	//create an object
    $category = new Category;

    // add one
    if ($category->add("testing name", "tesing description")){
    	echo "add #1 success<br>";
    }else{
    	echo "add #1 fail<br>";
    }

    if ($category->add("testing name", "tesing description")){
    	echo "add #2 success<br>";
    }else{
    	echo "add #2 fail<br>";
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
    $alldata = $category->getAll();
    while ($row = mysqli_fetch_assoc($alldata)) {
        echo "$row[category_id] $row[category_name] $row[category_description] $row[category_display]  <br/>";
    }

    $alldata = $category->getOne(3);
    while ($row = mysqli_fetch_assoc($alldata)) {
        echo "$row[category_id] $row[category_name] $row[category_description] $row[category_display]  <br/>";
    }




    
?>
