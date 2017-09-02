<!DOCTYPE html>
<!--
Blue template - Good Detail page, 
retrieves and provides information about a selected good 
and sale if the good is on sale, 
formatted for BLUE template

HTML/CSS, PHP for getting goods and sale info created by Olga

update: August 19 by Olga
Adding white-space:normal for description, and everything else to avoid text overflow
adding back good not found message, link to cart, link to image, sales info, improving format
-->
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="good detail page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Good Detail</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
			include '/data/www/default/wecreu/tools/csql.php';
            include_once '/data/www/default/wecreu/tools/discountCalculator.php';

		?>
		
		<div class="middle">
		
			<div class="content">
				
                <?php
                   //getting database connection and good info
                    $db = Database::getInstance();
                    $good = new Good($db);
                    $alldata = $good->getGoodDetail($_GET["gid"]);

					$query = $dbc->query("SELECT * FROM good ORDER BY good_id");
					$cc = $query->fetch_assoc();

                    
                    
                    //check if good ino exists and display message or table
                    if(mysqli_num_rows($alldata) == 0){
                        echo "<p>Good not found</p>";
                    } else{                  
                        $row = mysqli_fetch_assoc($alldata);
                        $imagepath = "/wecreu/images/".$row['good_image']; //prepare path for image
                        $calcprice = discountCalculate($_GET["gid"]); //get current price adjusted for sale
                        $priceentry= "$ ".$row['good_price']; //get database price
                        $saleentry= "Not on sale"; //prepare sale info

                        if(isset($row['sale_id'])){

                            //get sale information if applicable
                            $query="SELECT * FROM `sale` WHERE `sale_id` = ".$row['sale_id'];
                         //   echo $query;
                            $conn = $db->getConnection();  
                            $datasale=$conn->query($query);
                            $salerow=mysqli_fetch_assoc($datasale);

                            $startdate = date("Y-m-d", strtotime($salerow['start_date']));
                            $enddate = date("Y-m-d", strtotime($salerow['end_date']));
                            $todaydate = date("Y-m-d");

                            //check if sale started, prepare sale info and update price label
                            if($todaydate > $startdate && $todaydate < $enddate){

                                $saleentry = "Current Sale ".$salerow['sale_name'].", <br/>".$salerow['discount']."% off  from ".$startdate." to ".$enddate; 
                                $priceentry ='<span style="color:#990000;">$ '.$calcprice.'</span> [old <span style="text-decoration:line-through;">$ '.$row['good_price'].'</span>]';

                            }else{//if sale not started display sale info and database price
                                $saleentry = "Future Sale ".$salerow['sale_name'].", <br/>".$salerow['discount']."% off  starts ".$startdate." ends ".$enddate; 
                                $priceentry ="$ ".$row['good_price'];
                            }
                        }
                ?>
                
				<div class="goodimage" >     
					<img src='<?php echo $imagepath;  ?>' alt="good image" height="350" width="350" />
				</div>
				<div class="goodinfo">

                    <table style="width:100%; table-layout:fixed;white-space:normal;">
						<tr>
							<td><span style="font-weight:bold">PRODUCT NAME:</span> <?php echo "  $row[good_name]";  ?></td>                            
							<td><span style="font-weight:bold">QUANTITY:</span> <?php echo "  $row[good_in_stock]";  ?></td>
						</tr>
						<tr>
							<td><span style="font-weight:bold">CATEGORY:</span> <?php echo "  $row[category_name]";  ?></td>                        
							<td><span style="font-weight:bold">WEIGHT:</span> <?php echo "  $row[good_weight]";  ?> lbs</td>
						</tr>
						<tr>
							<td><span style="font-weight:bold">PRICE:</span> <?php echo $priceentry; ?> </td>                           
							<td><span style="font-weight:bold">TAXABLE:</span> <?php if(isset($row['good_taxable'])){
                                                    if($row['good_taxable']==1){
                                                        echo "Taxable";
                                                    }else {
                                                        echo "Not Taxable";
                                                    }
                                                }else{
                                                    echo "No information";
                                                }  ?></td>
						</tr>
                        <tr>
                            <td><span style="font-weight:bold">SALES APPLICABLE:</span> <?php echo $saleentry; ?></td>     
                            <td></td>
                        </tr>
					</table>
                    <table style="width:100%; table-layout:fixed;">
						<tr >
							<td style="white-space:normal;"> <span style="font-weight:bold">DESCRIPTION:</span> <?php echo "  $row[good_description]";?></td>
						</tr>
						<tr >
							<td>
                            <?php
                                if($row['good_in_stock'] > 0){
                            ?>
                            <a class="button" href="addProducToCart.php?productId=<?php echo $row['good_id']; ?>&qty=1">Add to cart</a>
							<?php
                            } else {
                            ?>
                            <span style="color:#990000">Out of stock</span>
                            <?php
                            }
                            ?>
                            </td>
						</tr>
					</table>
				</div>
                <?php
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
