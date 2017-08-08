<?php
/*
* Created by Olga A. on August 8
* discountCalculate function. Receives good id
* Checks if a good is currently on sale and returns good price adjusted for % discount
* If good is not in sale returns its normal price
* If good was not found returns 0
*/


function discountCalculate($goodid){
 //   echo "got good_id ".$goodid."<br/>";

    $discountedPrice =0;

    $db = Database::getInstance();//retrieving good from id
    $good = new Good($db);
    $alldata = $good->getGoodDetail($goodid);
 //   echo "good has been collected from db<br/>";
    if(mysqli_num_rows($alldata) > 0){
        
       $row = mysqli_fetch_assoc($alldata);
 
        $oldprice = $row['good_price'];
        $saleid = $row['sale_id'];
    //    echo "found good id, its old price is ".$oldprice." its on sale ".$saleid."<br/>";
        $discountedPrice = $oldprice;
    //    echo "if no sale - price is ".$discountedPrice."<br/>";
        if(isset($saleid)){//check if good is on sale
          
            $query="SELECT * FROM sale WHERE sale_id = ".$saleid;//get sale info
          
            $conn = $db->getConnection();  
            $sale = $conn->query($query);
            $salerow = mysqli_fetch_assoc($sale);
            
            $startdate = date("Y-m-d", strtotime($salerow['start_date']));
            $enddate = date("Y-m-d", strtotime($salerow['end_date']));
            $todaydate = date("Y-m-d");
       //     echo "today is ".$todaydate. " sale ".$saleid." starts ".$startdate." and ends ".$enddate."<br/>";

            if($todaydate > $startdate && $todaydate < $enddate){//check dates of sale
                $salediscount = $salerow['discount'];
             //   echo "dates are valid, discounting ".$salediscount."% <br/>";
                $discountedPrice = sprintf("%01.2f",($oldprice-($salediscount/100*$oldprice)));//if sale is ongoing, calculate new price
            }
        } 
    }
 //   echo "returning ".$discountedPrice."<br/>";
    return $discountedPrice;
}
?>
