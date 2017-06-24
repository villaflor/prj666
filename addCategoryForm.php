<?php
	if ($_POST && $_POST['method'] == 'categoryAdd'){

		include_once('tools/category.php');
	    include_once("tools/sql.php");

	    $db = Database::getInstance();
	    $clientId = 3;
		//create an object
	    $category = new Category($db,$clientId);

		// add one
	    if ($category->add($_POST['name'],$_POST['desc'])){
	    	echo "add #1 success<br>";
	    }else{
	    	echo "add #1 fail<br>";
	    }
	}else{
		?>
		<form action="" method="POST">
		  Name:<br>
		  <input type="text" name="name" value="">
		  <br>
		  Description:<br>
		  <input type="text" name="desc" value="">
		  <input type="hidden" name="method" value="categoryAdd">
		  <br><br>
		  <input type="submit" value="Submit">
		</form> 
		<?php
	}

?>


