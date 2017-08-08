<?php
// include database configuration file
$clientId = file_get_contents('conf.ini');
include_once("/data/www/default/wecreu/tools/sql.php");
include_once('/data/www/default/wecreu/tools/client.php');
include_once('/data/www/default/wecreu/tools/good.php');
//create an object
$db = Database::getInstance();
$client = new Client($db,$clientId);
$good = new Good($db,$clientId);


include 'sql.php';
$clientId = file_get_contents('conf.ini');
$nameErr = $addressErr = $phoneErr = $cityErr = $stateErr = $countryErr = $emailErr = "";
$proceed=0;
//include validation file
if($_POST){
   include 'cartValidate.php';

}

// initializ shopping cart class
include 'cartSession.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: index.php");
}

// set customer ID in session
// $_SESSION['sessCustomerID'] = 115;



//$nameErr = $addressErr = $phoneErr = $cityErr = $stateErr = $countryErr = $emailErr = "";

// get customer details by session customer ID
//$query = $dbc->query("SELECT * FROM customer WHERE customer_id = ".$_SESSION['sessCustomerID']);
//$custRow = $query->fetch_assoc();

$query = $dbc->query("SELECT * FROM client WHERE client_id = $clientId");
$client_tax = $query->fetch_assoc()['client_tax'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
</head>
<body>
<div class="container">
    <h1>Order Preview</h1>
	<p>Step 1: Fill out shipping detail fields and click submit</p>
	<p>Step 2: Once you recieve confirmation please confirm that the shipping deatils are correct then click the place order button</p>
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
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            include ("/data/www/default/wecreu/tools/discountCalculator.php");
            $priceTotal = 0;
            foreach($cartItems as $item){
              $gid = $item["id"];
              $priceAfterDiscount = discountCalculate($gid);

			/*
			<p><?php echo $custRow['customer_name']; ?></p>
			<p><?php echo $custRow['customer_email']; ?></p>
			<p><?php echo $custRow['customer_city']; ?></p>
			<p><?php echo $custRow['customer_street_address']; ?></p>

		<form>
			Customer ID:<input type="text" name="custID" class="spaceThree" autofocus><br>
			Name:<input type="text" name="name" class="spaceOne"><br>
			Address:      <input type="text" name="address" class="spaceTwo"><br>
			Phone Number: <input type="text" name="number"><br>
			City: <input type="text" name="city" class="spaceFour"><br>
			State: <input type="text" name="state" class="spaceFive"><br>
			Country: <input type="text" name="country" class="spaceSix"><br>
			Email: <input type="text" name="email" class="spaceSeven"><br>

		cartAction.php?action=placeOrder
		</form>
			*/
        ?>
        <tr>

            <td><?php echo $item["name"]; ?></td>
            <td>
            <?php
            if ($item["price"] != $priceAfterDiscount){
              echo '<span style="text-decoration:line-through;">$'.$item["price"].' CAD</span>';
              echo '<br> $'.$priceAfterDiscount.' CAD';
              $subTotal = $priceAfterDiscount;
            }else{
              echo '$'.$item["price"].' CAD';
              $subTotal = $item["price"];
            }
            $subTotal = $subTotal * $item["qty"];
            $priceTotal += $subTotal;
            ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$subTotal.' CAD'; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No items in your cart......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
          <td colspan="3"></td>
          <?php if($cart->total_items() > 0){ ?>
            <td>
              Price: <?php echo '$'.round($priceTotal,2).' CAD';?> <br/>
              Tax %: <?php echo $client_tax."%";?> <br/>
              Tax: $<?php echo round($priceTotal*($client_tax/100),2);?> CAD<br/>
              Total: <strong><?php echo '$'.round($priceTotal*($client_tax/100 + 1 ),2); ?></strong> CAD
            </td>
            <?php } ?>
        </tr>

    </tfoot>
    </table>

    <div class="shipAddr">

        <h4>Shipping Details</h4>

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="" method="post" enctype="multipart/form-data">


			Name:<input type="text" name="name" class="spaceOne" autofocus placeholder="Enter name"><br/>

			<p style="color:#ff0000;"><?php echo $nameErr; ?></p>
			Address:      <input type="text" name="address" class="spaceTwo" placeholder="Enter address"><br>
			<p style="color:#ff0000;"><?php echo $addressErr; ?></p>
			Phone Number: <input type="text" name="number" placeholder="Enter phone number"><br>
			<p style="color:#ff0000;"><?php echo $phoneErr; ?></p>
			City: <input type="text" name="city" class="spaceFour" placeholder="Enter city"><br>
			<p style="color:#ff0000;"><?php echo $cityErr; ?></p>
			State: <input type="text" name="state" class="spaceFive" placeholder="Enter state"><br>
			<p style="color:#ff0000;"><?php echo $stateErr; ?></p>
			Country: <input type="text" name="country" class="spaceSix" placeholder="Enter country"><br>
			<p style="color:#ff0000;"><?php echo $countryErr; ?></p>
			Email: <input type="text" name="email" class="spaceSeven" placeholder="Enter email"><br>
			<p style="color:#ff0000;"><?php echo $emailErr; ?></p>

			<input class="submit" type="submit" value="Submit"/>
			</br>
			</br>
			<?php
				if($proceed==1){
					echo $name;
			?>
			<p style="color:#1dff00;"><?php echo $confirm; ?></p>
			<?php
				}
			?>
		</form>
    </div>

    <div class="footBtn">
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
		<?php
		if($proceed){
		?>
        <a href="cartAction.php?action=placeOrder&cid=<?php echo $customerid;?>" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>
		<?php
		}
		?>
    </div>
</div>
</body>
</html>
