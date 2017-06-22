<?php

include('sql.php');

    $db = Database::getInstance();
    if($db->createNewDatabase("dbTableTest2")){
    	echo "success";
    } 

?>
