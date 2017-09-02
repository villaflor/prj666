<!DOCTYPE html>
<!--
Blue template - Good List page, 
retrieves and provides a list of goods for a selected category, 
or all categories when first opened
formatted for BLUE template

HTML/CSS, PHP for getting goods and sale info created by Olga

update August 19 by Olga
Fixing text overflow when good name is too small, and price displays
updated August 21 check condition on price displays with better one
-->
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
            $clientId = file_get_contents('conf.ini');
            include_once '/data/www/default/wecreu/tools/discountCalculator.php';

          //  $db = Database::getInstance();
            //$category = new Category($db,1);
		?>
		
		<div class="middle">
		
			<div class="content">
				<h3>Goods in Category:<?php $selectcategory; //getting a category id to display goods from
                                            if(isset( $_GET["cid"])){
                                                $selectcategory = $_GET["cid"];
                                                $alldata = $category->getOne($selectcategory);
                                                $row = mysqli_fetch_assoc($alldata);
                                                echo " $row[category_name]"; 
                                            }else{
                                                $selectcategory = "*";
                                                echo "All"; 
                                            }?> </h3>
				
                <?php
                   // getting goods and displaying each in a formatted box
                    $good = new Good($db);
                    $alldata = $good->getAllGoods($selectcategory,$clientId);

                    if(mysqli_num_rows($alldata) == 0){
                        echo "<p>No goods were found in this category</p>";
                    } else{  
                        while ($row = mysqli_fetch_assoc($alldata)){
                         $imagepath = "/wecreu/images/".$row['good_image'];
                        ?>
                        <div class="gooditem" style="max-height:230px;">
                            <a href="GoodDetail.php?gid=<?php echo "$row[good_id]";?>">

                            <?php $name = $row['good_name']; //trim name if too long
                                    if(strlen($name) > 16 ){
                                        $name = substr($name,0,16)."...";
                                    }
                                    echo $name;  ?>
                            <img src="<?php echo $imagepath; ?>" alt="good image" height="120" width="120" style="padding:20px 40px;"/>
                            <br />
                                <?php $calcprice=discountCalculate($row['good_id']); //display current price from database or with discount
                                    if(isset($row['sale_id']) && $calcprice != $row['good_price']){
                                        echo '<span style="color:#990000;">$'.$calcprice.'</span> [<span style="text-decoration:line-through;">$'.$row['good_price'].'</span>]';
                                    } else {
                                        echo "$".$row['good_price'];
                                    }
                                ?>
                            </a>
                        </div>
                     <?php
                        }
                    }
                    ?>

				
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