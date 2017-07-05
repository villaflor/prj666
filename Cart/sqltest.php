<?php

include('sql.php');

    $db = Database::getInstance();
    $mysqli = $db->getConnection(); 
    $sql_query = "SELECT * FROM good";
    $result = $mysqli->query($sql_query);

    //print_r($result);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "$row[good_name]<br/>";
    }
?>
