<div class="row">
  <div class=" col-md-3 col-sm-3 col-xs-3 sidebar">
      <ul class="nav nav-pills nav-stacked">
        <?php
			include_once('../../../tools/category.php');

			//create an object
		    $category = new Category($db, 5);
		    
        	$alldata = $category->getAllAvaliable();
		    while ($row = mysqli_fetch_assoc($alldata)) {
		        //$row[category_id] $row[category_name] $row[category_description] $row[category_display] 
		        echo "<li><a href='good.php?gid=$row[category_id]'>$row[category_name]</a></li>";
		    }

        ?>
      </ul>
  </div>
