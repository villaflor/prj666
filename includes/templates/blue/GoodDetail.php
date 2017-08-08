<!DOCTYPE html>
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
            include_once '/data/www/default/wecreu/tools/discountCalculator.php';

		?>
		
		<div class="middle">
		
			<div class="content">
				
                <?php

                    $db = Database::getInstance();
                    $good = new Good($db);
              
                    $alldata = $good->getGoodDetail($_GET["gid"]);
                     if(mysqli_num_rows($alldata) == 0){
                        echo "<p class='text-center'>Good not found</p>";
                    } else{

                        $row = mysqli_fetch_assoc($alldata);
                        $imagepath = "/wecreu/images/".$row['good_image'];
                        $calcprice = discountCalculate($_GET["gid"]);

                ?>
                
				<div class="goodimage" >     
					<img src='<?php echo $imagepath;  ?>' alt="good image" height="200" width="200" />
				</div>
				<div class="goodinfo">

                    <table style="width:100%">
						<tr>
							<td>Product Name: <?php echo "$row[good_name]";  ?></td>                            
							<td>Quantity: <?php echo "$row[good_in_stock]";  ?></td>
						</tr>
						<tr>
							<td>Category: <?php echo "$row[category_name]";  ?></td>                        
							<td>Weight: <?php echo "$row[good_weight]";  ?> lbs</td>
						</tr>
						<tr>
							<td>Price: $ <?php echo $calcprice;  ?></td>                           
							<td>Taxable: <?php if(isset($row['good_taxable'])){
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
                            <td>Sales Applicable: <?php if(isset($row['sale_id'])){
                                                            $query="SELECT * FROM `sale` WHERE `sale_id` = ".$row['sale_id'];
                                                         //   echo $query;
                                                            $conn = $db->getConnection();  
                                                            $datasale=$conn->query($query);
                                                            $salerow=mysqli_fetch_assoc($datasale);
                                                            $startdate = date("Y-m-d", strtotime($salerow['start_date']));
                                                            $enddate = date("Y-m-d", strtotime($salerow['end_date']));

                                                            echo $salerow['sale_name'].", ".$salerow['discount']."% off $".$row['good_price']."<br/> from ".$startdate." to ".$enddate; 
                                                        }else{
                                                            echo "No Sale";
                                                        }?></td>     
                            <td></td>
                        </tr>
					</table>
                    <table style="width:100%">
						<tr >
							<td> Description:<?php echo "$row[good_description]";  ?></td>
						</tr>
						<tr>
							<td><a class="button" href="cartAction.php?action=addToCart&id=<?php echo $row["good_id"]; ?>">Add to cart</a></td>
							
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
