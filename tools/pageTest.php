<?php
    include_once('page.php');
    include_once("sql.php");

    $db = Database::getInstance();

	  //create an object
    $page = new Page($db,57);

    // add one
    if ($page->add("testing name")){
    	echo "add #1 success<br>";
    }else{
    	echo "add #1 fail<br>";
    }

    //edit
    if ($page->edit(1, "testing name after editing")){
    	echo "edit success<br>";
    }else{
    	echo "edit fail<br>";
    }

    //delete
    if ($page->delete(4)){
    	echo "edit success<br>";
    }else{
    	echo "edit fail<br>";
    }

    // call get all
	  echo '<br/>Get all<br/>';
    $alldata = $page->getAll();
    while ($row = mysqli_fetch_assoc($alldata)) {
      print_r($alldata);
    }

?>
