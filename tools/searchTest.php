<?php
    include_once('search.php');
    include_once("sql.php");

    $db = Database::getInstance();

	//create an object
    $search = new Search($db,1);

    // call get all
	echo '<br/>Get all<br/>';
    $alldata = $search->getAll();
    while ($row = mysqli_fetch_assoc($alldata)) {
        print_r($row);
        echo "<br/>";
    }

    //search
    $keyword = "checkbox";
    echo "<br/>search with keyword $keyword<br/>";
    $alldata = $search->searchGood($keyword);
    while ($row = mysqli_fetch_assoc($alldata)) {
        print_r($row);
        echo "<br/>";
    }
?>
