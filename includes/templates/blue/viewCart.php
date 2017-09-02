<?php
require_once('/data/www/default/wecreu/core/init.php');
$checkQTY = true;
?>

<br>
<div class="container bg-faded pt-5">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
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

                    $getCookieData = Cookie::getCart(file_get_contents('conf.ini'));

                    if($getCookieData){
                        $priceTotal = 0;

                        foreach($getCookieData as $index => $item){
                            ?>
                            <tr>
                                <?php
                                $gid = $item->good_id;
                                ?>
                                <td><?php echo $item->good_name; ?></td>
                                <td>
                                    <?php
                                    if ($item->discount_price){
                                        echo '<span style="text-decoration:line-through;">$'.$item->good_price.' CAD</span>';
                                        echo '<br> $'.$item->discount_price.' CAD';
                                        $subTotal = $item->discount_price;
                                    }else{
                                        echo '$'.$item->good_price.' CAD';
                                        $subTotal = $item->good_price;
                                    }
                                    $subTotal = $subTotal * $item->quantity;
                                    $priceTotal += $subTotal;
                                    ?>
                                </td>
                                <?php

                                if ($item->quantity > $item->in_stock){
                                    $checkQTY = false;
                                }



                                ?>
                                <td><input type="number" id="cart_qty" min="1" step="1" max="<?php echo $item->in_stock;?>" class="form-control text-center" value="<?php echo $item->quantity; ?>" onchange="window.location.href = 'addProducToCart.php?action=add&productId=<?php echo $item->good_id?>&qty=' + this.value"></td>
                                <td><?php echo '$'.$subTotal.' CAD'; ?></td>
                                <td>
                                    <a href="addProducToCart.php?action=delete&productId=<?php echo $item->good_id; ?>" class="button" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash">X</i></a>
                                </td>
                            </tr>
                        <?php } }
                    else{ ?>
                    <tr><td colspan="5"><p>Your cart is empty.....</p></td>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><a href="index.php" class="button"> Continue Shopping</a></td>
                        <td colspan="2"></td>
                        <?php

                        if(count($getCookieData) > 0 && $checkQTY){ ?>
                            <td class="">
                                Price: <?php echo '$'.round($priceTotal,2).' CAD';?> <br/>
                                Tax %: <?php echo $client->getClientTax()."%";?> <br/>
                                Tax: $<?php echo round($priceTotal*($client->getClientTax()/100),2);?> CAD<br/>
                                Total: <strong><?php echo '$'.round($priceTotal*($client->getClientTax()/100 + 1 ),2); ?></strong> CAD</td>
                            <td><a href="checkout.php" class="submit">Checkout </a></td>
                          <?php }
                                      else{
                                        if (count($getCookieData) > 0){
                                        ?>
                                        <td class="">
                                          The side owner doesn't have enough quantity. You cannot checkout.
                                          <td>
                                      <?php
                                      }}
                                      ?>

                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
