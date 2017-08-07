<?php
// initialize shopping cart class
$clientId = file_get_contents('conf.ini');
include 'cartSession.php';
$cart = new Cart;

// include database configuration file
include 'sql.php';
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
		//$cName = "client";
		//$cValue = $clientId;
		//setcookie($cName, $cValue, time() + (86400 * 30), "/"); // 86400 = 1 day
        $productID = $_REQUEST['id'];
        // get product details
        $query = $dbc->query("SELECT * FROM good WHERE good_id = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['good_id'],
            'name' => $row['good_name'],
            'price' => $row['good_price'],
            'qty' => 1
        );

        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'viewCart.php':'index.php';

        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){

        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // get client tax
        $clientId = file_get_contents('conf.ini');
        $query = $dbc->query("SELECT * FROM client WHERE client_id = $clientId");
        $client_tax = $query->fetch_assoc()['client_tax'];
        $price = $cart->total() * (1 + $client_tax/100);
        $price = round($price,2);
        // insert order details into database
        $sql = "INSERT INTO invoice (customer_id, invoice_total_quantity, invoice_price,invoice_final_price) VALUES ('".$_SESSION['sessCustomerID']."','".$cart->total_items()."', '".$cart->total()."','".$price ."')";
        $insertOrder = $dbc->query("$sql");

        if($insertOrder){
            $orderID = $dbc->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_line (invoice_id, good_id, good_quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $dbc->multi_query($sql);

            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
