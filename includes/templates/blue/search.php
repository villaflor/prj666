<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="list of goods in a category" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Goods List</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
	</head>
	<body>

		<?php
			include 'Header.php';
		?>
		<div class="middle">
			<div class="content">
				<?php
          $clientId=file_get_contents("conf.ini");
					$search = require_once("/data/www/default/wecreu/tools/search.php");
					$search = new Search($db,$clientId);
					// call get all
          $limit=999;
          if(isset($_GET['offSet'])){
            $offSet=$_GET['offSet'];
          }else{
            $offSet=0;
          }
          if(!isset($_GET['keyword'])){
            $alldata = $search->getAll($limit,$offSet);
            $num=$limit+$offSet;
            $last="?offSet=$num";
            $num=$offSet-$limit;
            $pre="?offSet=$num";
            // count number of items on next page
            $nextAlldata = $search->getAll($limit,$offSet+$limit);
            $nextTotal=mysqli_num_rows($nextAlldata);
          } else{
            $keyword=$_GET['keyword'];
            $alldata = $search->searchGood($keyword,$limit,$offSet);
            $num=$limit+$offSet;
            $last="?keyword=$keyword&offSet=$num";
            $num=$offSet-$limit;
            $pre="?keyword=$keyword&offSet=$num";
            // count number of items on next page
            $nextAlldata = $search->searchGood($keyword,$limit,$offSet+$limit);
            $nextTotal=mysqli_num_rows($nextAlldata);
          }
          $total=mysqli_num_rows($alldata);
          if($total == 0){
            echo "Sorry, we can't find any record.";
          }
          while ($row = mysqli_fetch_assoc($alldata)) {
            ?>
                    <div class="gooditem">
                        <a href="GoodDetail.php?gid=<?php echo "$row[good_id]";?>">
                        <?php echo "$row[good_name]";  ?>
                        <img src=<?php echo "$row[good_image]"; ?> alt="good image" height="120" width="120" style="padding:20px 40px;"/>
                        <br />
                        $<?php echo "$row[good_price]";  ?>
                        </a>
                    </div>
                 <?php
                    }
                ?>

            <div >
              <br/>
              <?php
              if($offSet!=0){
                echo '<a href="'.$pre.'" >Previous page</a>';
              }
              if($total == $limit){
                if($nextTotal != 0) {
                  echo '<a href="'.$last.'" >Next page</a>';
                }
              }
              ?>
            </div>


			</div>

			<?php
				include 'Categories.php';
			?>

		</div>

		<?php
			include 'Menu.php';
		?>

		<?php
			include 'Footer.php';
		?>

	</body>
</html>
