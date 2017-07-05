<!DOCTYPE html>
<html>
<body>
<?php
//echo 1;
include('cart.php');
    //create an object
    $good = new Cart();
    
    //get all  
    $good->getAllCart();
    
    
	//printArray();
	/*
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] <br />";
    }    
	*/
    /*
    //get one
    echo "get one test<br>";
    $alldata = $good->getGoodDetail(3);
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] <br />";
    }    
*/
    //add one
    $good->addCart('stick',5,3);
	$good->addCart('pen',4,6);
/*
    if($good->addGood("testgood2", "test good table 2")){
        echo "add good #2 success<br/>";
    }else{
        echo "add good #2 fail<br/>";
    } 
 
    //edit one
    echo "edit existing test<br>";
    if($good->editGood(7, "testnameedit", "test description edit"){
        echo "edit good #7 success<br/>";
    }else{
        echo "edit good #7 fail<br/>";
    }

    //delete one
    echo "delete existing test<br>";
    if($good->deleteGood(8){
        echo "delete good #8 success<br/>";
    }else{
        echo "delete good #8 fail<br/>";
    }
*/
/*
    //get all  
    echo "listing goods again<br>";
    $alldata = $good->getAllGoods();
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] <br />";
    }    
*/
?>
</body>
</html>