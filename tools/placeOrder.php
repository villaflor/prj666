<?php
/*
* placeOrder function.
* this function receives customer order data and 
* creates a set of record for an order in the database
* in Customer, Invoice and Order_line tables
*
* if the function is successful it redirects to orderSuccess page,
* and sends an email with receipt to customer's email address
*
* if the function is not successful, it deletes an records that 
* got created and displays error message
* Author Olga
*/

include_once("/data/www/default/wecreu/tools/sql.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('/data/www/default/wecreu/core/init.php');
include_once('/data/www/default/wecreu/tools/client.php');
include_once("/data/www/default/wecreu/classes/Customer.php");
include_once("/data/www/default/wecreu/classes/Invoice.php");
include_once '/data/www/default/wecreu/classes/Cookie.php';

function placeOrder($customerData, $cookieDataArray, $totalQty, $price, $finalPrice){

    //prepare class objects and data
    $db = Database::getInstance();
    $client = new Client($db,file_get_contents('conf.ini'));

    $customer = new Customer($db);
    $invoice = new Invoice($db);
    $successCode =false;
    $invoiceId = 0;

    //if cookie contains data proceed..
    if($cookieDataArray){

        //create record for customer in customer table
        if($customer->addCustomer($customerData['name'], $customerData['phone'], $customerData['address'],  $customerData['city'], $customerData['state'], $customerData['country'], $customerData['email'])){

            //if successful get customer id
            $newCustomerInfo=$customer->getCustomerId($customerData['name'], $customerData['phone'], $customerData['address'],  $customerData['city'], $customerData['state'], $customerData['country'], $customerData['email']);
            $row = mysqli_fetch_assoc($newCustomerInfo);
            $customerId = $row['customer_id'];

            //create record for invoice in invoice table
            if($invoice->addInvoice($customerId, $customerData['payment'], $totalQty, $price, $finalPrice, 0)){

                //if successful get invoice id
                $newInvoiceInfo=$invoice->getInvoiceId( $customerId, $customerData['payment'], $totalQty, $price, $finalPrice, 0);
                $row = mysqli_fetch_assoc($newInvoiceInfo);
                $invoiceId = $row['invoice_id'];
            
                //create a record on order line table for each item in cookie...
                if($invoice->addOrderLine($invoiceId, $cookieDataArray)){

                    foreach($cookieDataArray as $goodSelected){ //...and update stock on good table
                        $query="UPDATE good SET good_in_stock = (good_in_stock-".$goodSelected['quantity'].") WHERE good_id = ".$goodSelected['goodId'];
                        $conn = $db->getConnection();  
                        $result = $conn->query($query);
                        if($result){
                            $successCode =true;
                        } else {
                            $successCode =false;
                        }
                    }

                } else {
                 
                    $invoice->deleteOrderLine($invoiceId);
                    $invoice->deleteInvoice($invoiceId);
                    $customer->deleteCustomer($customerId);
                    $successCode =false;
                }
            } else {
                $customer->deleteCustomer($customerId);
            }
        }
    } 

    //if database updated successfully send email and redirect to orderSuccess page
    if($successCode == true){

        $message="Your order has been registered.\n\nRECEIPT\nDate: ".date("r")."\nTransaction id: ".$invoiceId."    Customer id: ".$customerId;
        $message=$message."\nPayment Method: ".$customerData['payment']."\n\n----------------------------------";
        foreach($cookieDataArray as $invoiceline){
            $message = $message."\n".$invoiceline['quantity']."     ".$invoiceline['goodName']."    $".$invoiceline['price']." ea";
        }
        $message= $message."\n\n Total $".$price."\nTotal With Tax(".$client->getClientTax()."%) $".$finalPrice."\n\n";
        $message=$message."Shipping to: \n".$customerData['name']."\n".$customerData['address']."\n".$customerData['city']." ".$customerData['state']."\n".$customerData['country'];
        $message=$message."\n\nThank you for your purchase";

        mail($customerData['email'], "Wecreu site - Purchase Invoice (".$invoiceId.")", $message); 

        Redirect::to('orderSuccess.php?id='.$invoiceId);  

    } else {
        echo "<script type='text/javascript'>alert('There was an error placing your order. Please try again.') </script>";
    }

}

?>