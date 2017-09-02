<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('/data/www/default/wecreu/core/init.php');

$productId = Input::get('productId');
$qty = Input::get('qty');
$ownerId = file_get_contents('conf.ini');
$good = new Good();
$category = new Category();
$discount = 0;

if(Input::get('action') == 'add'){
    Cookie::changeQtyCart(array(
        'good_id' => $productId,
        'quantity' => $qty
    ), $ownerId);
    Redirect::to('cart.php');
}

$good->find($productId);
if(!$good->exists()) Redirect::to('index.php');
$category->find($good->data()->category_id);
if(!$category->exists()) Redirect::to('index.php');
if($category->data()->client_id != $ownerId) Redirect::to('index.php');

if(Input::get('action') == 'delete'){
    Cookie::deleteItem($productId, $ownerId);
    Redirect::to('cart.php');
}

if($good->data()->sale_id){
    $sale = new Sale();
    require_once '/data/www/default/wecreu/tools/discountCalculator.php';
    if($good->data()->sale_id){
        $sale->findSale(array('sale_id', '=', $good->data()->sale_id));

        $startdate = date("Y-m-d", strtotime($sale->data()->start_date));
        $enddate = date("Y-m-d", strtotime($sale->data()->end_date));
        $todaydate = date("Y-m-d");

        if($todaydate >= $startdate && $todaydate <= $enddate){//check dates of sale
            $salediscount = $sale->data()->discount;
            //   if dates are valid, discounting sale discount %
            $discount = sprintf("%01.2f",($good->data()->good_price -($salediscount/100*$good->data()->good_price)));//if sale is ongoing, calculate new price
        }
    }
}

if($qty){
    $toCart=array(
        'good_id' => $productId,
        'quantity' => $qty,
        'client_id' => $ownerId,
        'good_name' => $good->data()->good_name,
        'good_price' => $good->data()->good_price,
        'in_stock' => $good->data()->good_in_stock,
        'taxable' => $good->data()->good_taxable,
        'discount_price' => $discount
    );
    Cookie::addToCart($toCart, $ownerId);
}

Redirect::to('cart.php');
?>