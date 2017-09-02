<?php
/*
* Created by Olga A. on August 8
* discountCalculate function. Receives good id
* Checks if a good is currently on sale and returns good price adjusted for % discount
* If good is not in sale returns its normal price
* If good was not found returns 0
*
* Edit August 21 by Olga update date check condition to change price on day sale starts and ends
*/


function discountCalculate($goodid){
 

    $discountedPrice =0;

    $db = Database::getInstance();//retrieving good from id
    $good = new Good($db);
    $alldata = $good->getGoodDetail($goodid);

    if(mysqli_num_rows($alldata) > 0){
        
       $row = mysqli_fetch_assoc($alldata);
 
        $oldprice = $row['good_price'];
        $saleid = $row['sale_id'];
        $discountedPrice = $oldprice;

        if(isset($saleid)){//check if good is on sale
          
            $query="SELECT * FROM sale WHERE sale_id = ".$saleid;//get sale info
          
            $conn = $db->getConnection();  
            $sale = $conn->query($query);
            $salerow = mysqli_fetch_assoc($sale);
            
            $startdate = date("Y-m-d", strtotime($salerow['start_date']));
            $enddate = date("Y-m-d", strtotime($salerow['end_date']));
            $todaydate = date("Y-m-d");

            if($todaydate >= $startdate && $todaydate <= $enddate){//check dates of sale
                $salediscount = $salerow['discount'];
             //   if dates are valid, discounting sale discount % 
                $discountedPrice = sprintf("%01.2f",($oldprice-($salediscount/100*$oldprice)));//if sale is ongoing, calculate new price
            }
        } 
    }
 //  returning discounted Price
    return $discountedPrice;
}
?>
