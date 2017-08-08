<?php
// initializ shopping cart class

include 'cartSession.php';
$cart = new Cart;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Cart</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{padding: 50px;}
    input[type="number"]{width: 20%;}
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
</head>
 <style>
    .fhead {
      text-align: center;
      justify-content: center
    }

    .centeredImage {
      position: absolute;
      left: 40%;
      text-align:center;
    }

    .left{
      text-align:right;
    }

  </style>
<?php include_once("headmeta.php");


?>
<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->

  <!-- items -->
 <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
       <!-- info -->
      <body>
<div class="container">
    <h1>Shopping Cart</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
		$clientId = file_get_contents('conf.ini');
			if($clientIdRed != $clientId){
					$cart->destroy();
			}
        if($cart->total_items() > 0){
            //get cart items from session
			if(isset($_COOKIE['client'])){
				if($_COOKIE['client']!=$clientId){
					$cart->removeAll();
				}
			}

            $cartItems = $cart->contents();
            include ("/data/www/default/wecreu/tools/discountCalculator.php");
            $priceTotal = 0;
            foreach($cartItems as $item){
        ?>
        <tr>
            <?php
              $gid = $item["id"];
              $priceAfterDiscount = discountCalculate($gid);
            ?>
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
             ?>
           </td>
            <td><input type="number" min="1" step="1" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo '$'.$subTotal.' CAD'; ?></td>
            <td>
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Your cart is empty.....</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a></td>
            <td colspan="2"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="">
              Price: <?php echo '$'.round($priceTotal,2).' CAD';?> <br/>
              Tax %: <?php echo $client->getClientTax()."%";?> <br/>
              Tax: $<?php echo round($priceTotal*($client->getClientTax()/100),2);?> CAD<br/>
              Total: <strong><?php echo '$'.round($priceTotal*($client->getClientTax()/100 + 1 ),2); ?></strong> CAD</td>
            <td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>

        </tr>
    </tfoot>
    </table>
</div>


    </div>
        </div>
  </div>

  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>
