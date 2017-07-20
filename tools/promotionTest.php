<?php

    include_once('promotion.php');
    include_once("sql.php");

    $db = Database::getInstance();

	//create an object
    $promotion = new Promotion($db,2);

    // call get all
	echo '<br/>Get all<br/>';
    $alldata = $promotion->getAll();
    while ($row = mysqli_fetch_assoc($alldata)) {
        print_r($row);
        echo "<br/>";
    }

    // call get all
	echo '<br/>Get all avaliable<br/>';
    $alldata = $promotion->getAllAvaliable();
    while ($row = mysqli_fetch_assoc($alldata)) {
        print_r($row);
        echo "<br/>";
    }
?>
