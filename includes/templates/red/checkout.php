<?php
/*
* Checkout page. 
* This page redisplays the items in shopping cart as they will be seen in the invoice,
* and provides  form for customer t fill in.
* Once valid information is entered the order is placed
* Author Olga
*/

// include database configuration file and other necessary files
$clientId = file_get_contents('conf.ini');
require_once('/data/www/default/wecreu/core/init.php');
include_once('/data/www/default/wecreu/tools/placeOrder.php');
include_once('/data/www/default/wecreu/tools/client.php');
include_once("/data/www/default/wecreu/tools/sql.php");
include_once '/data/www/default/wecreu/classes/Cookie.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//prepare variables
$db = Database::getInstance();
$client = new Client($db,$clientId);
$isValid = true;


$name=$address=$phone=$city=$state=$country=$email=$payment="";
$nameErr=$addressErr=$phoneErr=$cityErr=$stateErr=$countryErr=$emailErr=$paymentErr="";

include_once('/data/www/default/wecreu/tools/cartValidate.php');
   
$cookieTotalQty=0;
$cookiePriceTotal=0;
$cookieFinalPrice=0;
$getCookieGoods = Cookie::getCart($clientId);
$cookieDataArray = array();

    if($getCookieGoods){//store cookie data in a 2D array

        foreach($getCookieGoods as $index => $item){

            $cookieTotalQty += $item->quantity;

            $cookiePrice=0;
            if ($item->discount_price){
                $cookiePrice = $item->discount_price;
            }else{
                $cookiePrice = $item->good_price;
            } 
            $cookiePriceTotal += $cookiePrice * $item->quantity;

            array_push($cookieDataArray, array(
                        'goodId' => $item->good_id,
                        'goodName' => $item->good_name,
                        'price' => $cookiePrice,
                        'quantity' => $item->quantity,
                        'subTotal' => $cookiePrice * $item->quantity));
        }

        $cookieFinalPrice = round($cookiePriceTotal*($client->getClientTax()/100 + 1 ),2);
        $cookiePriceTotal = round($cookiePriceTotal,2);
    }

   if($_POST && $isValid && $getCookieGoods){// data present, data valid and cookie didn't expire

        $customerData = array(
        'name' => $name,
        'address' => $address,
        'phone' => $phone,
        'city' => $city,
        'state' => $state,
        'country' => $country,
        'email' => $email,
        'payment' => $payment
        );

        placeOrder($customerData, $cookieDataArray, $cookieTotalQty, $cookiePriceTotal, $cookieFinalPrice);
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("headmeta.php");?>

    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
	.spaceOne{margin-left: 61px}
	.spaceTwo{margin-left: 43px}
	.spaceThree{margin-left: 20px}
	.spaceFour{margin-left: 70px}
	.spaceFive{margin-left: 62px}
	.spaceSix{margin-left: 45px}
	.spaceSeven{margin-left: 59px}

    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.js" integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"></script>
</head>
<body>
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
   <div class="container bg-faded pt-5">

    <div class="container">
        <h1>Order Preview</h1>
        <p>Step 1: Fill out shipping detail fields and click submit</p>
        <p>Step 2: Once you receive confirmation please confirm that the shipping details are correct then click the place order button</p>
        <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //display data in cookie if available
        $getCookieData = Cookie::getCart($clientId);

        if($getCookieData){
            $priceTotal = 0;

            foreach($getCookieData as $index => $item){
        ?>
            <tr>
                <?php
                $gid = $item->good_id;
                ?>
                <td><?php echo $item->good_name; ?></td>
                <td><?php    
                        if ($item->discount_price){
                            echo '$'.$item->discount_price.' CAD';
                            $subTotal = $item->discount_price;
                        }else{
                            echo '$'.$item->good_price.' CAD';
                            $subTotal = $item->good_price;
                        } 
                        $subTotal = $subTotal * $item->quantity;
                        $priceTotal += $subTotal;
                    ?></td>
                <td><?php echo $item->quantity; ?></td>
                <td><?php echo '$'.$subTotal.' CAD'; ?></td>
            </tr>
        <?php
            }
        } else {
        ?>
            <tr><td colspan="4"><p>No items in your cart......</p></td></tr>
        <?php
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
            <?php
            //calculate totals
            if(count($getCookieData) > 0){ ?>

              <td colspan="3"></td>
                <td>
                  Price: <?php echo '$'.round($priceTotal,2).' CAD';?><br/>
                  Tax %:  <?php echo $client->getClientTax()."%";?><br/>
                  Tax: $<?php echo round($priceTotal*($client->getClientTax()/100),2);?> CAD<br/>
                  Total: <strong><?php echo '$'.round($priceTotal*($client->getClientTax()/100 + 1 ),2); ?></strong> CAD
                </td>
            <?php
            }
            ?>
            </tr>
        </tfoot>
        </table>

        <div class="shipAddr">

            <h4>Shipping Details</h4>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="" method="post" enctype="multipart/form-data">

                Name:<input type="text" name="name" maxlength="50" class="spaceOne" autofocus placeholder="Enter name" value="<?php echo $name; ?>" /><br/>
                <p style="color:#ff0000;"><?php echo $nameErr; ?></p>
                Address: <input type="text" name="address" class="spaceTwo" maxlength="280" placeholder="Enter address" value="<?php echo $address; ?>" /><br>
                <p style="color:#ff0000;"><?php echo $addressErr; ?></p>
                Phone Number: <input type="text" name="number" maxlength="14" placeholder="Enter phone number" value="<?php echo $phone; ?>" /><br>
                <p style="color:#ff0000;"><?php echo $phoneErr; ?></p>
                City: <input type="text" name="city" class="spaceFour" maxlength="99" placeholder="Enter city" value="<?php echo $city; ?>" /><br>
                <p style="color:#ff0000;"><?php echo $cityErr; ?></p>
                Province: <input type="text" name="state" class="spaceFive" maxlength="99" placeholder="Enter state" value="<?php echo $state; ?>" /><br>
                <p style="color:#ff0000;"><?php echo $stateErr; ?></p>
                Country: <input type="text" name="country" class="spaceSix" maxlength="99" placeholder="Enter country" value="<?php echo $country; ?>" /><br>
                <p style="color:#ff0000;"><?php echo $countryErr; ?></p>
                Email: <input type="text" name="email" class="spaceSeven"  maxlength="140" placeholder="Enter email" value="<?php echo $email; ?>" /><br>
                <p style="color:#ff0000;"><?php echo $emailErr; ?></p>
                Payment: <br/>
                 <input style="margin-left: 10px;" type="radio" name="payment" id="payment" value="paypal" /> Paypal<br/>
                <input style="margin-left: 10px;" type="radio" name="payment" id="payment" value="amex" /> American Express<br/>
                <input style="margin-left: 10px;" type="radio" name="payment" id="payment" value="visa" /> Visa<br/>
                <input style="margin-left: 10px;" type="radio" name="payment" id="payment" value="mastercard" /> Mastercard <br/>
                <p style="color:#ff0000;"><?php echo $paymentErr; ?></p>
                
                <input class="btn btn-success orderBtn" type="submit" id="subm" value="Place Order"/>
                <p style="color:red; font-size:25px;" id="subMsg"></p>
                </br>
                </br>
            </form>
        </div>

        <div class="footBtn">
            <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
        </div>
        <script>
   $(document).ready(function(){
      $("#subm").click(function(){
         $("#subm").hide();
         $("#subMsg").text("You purchase is submitting, it may take one minute to validate your information.");
      });
   });
</script>
    </div>
</div>
<!-- footer -->
<?php include_once("footer.php");?>
</body>
</html>
