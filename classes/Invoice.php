<?php
include_once("/data/www/default/wecreu/tools/sql.php");
/*
*Invoice Class
*Author Olga
*contains add delete and get id functions for invoice and invoice lines tables
*created August 24 2017
*/
class Invoice {
    
    private $mysqli;

    /*
    Get invoice id
    */
    public function getInvoiceId($customerId, $payment, $totalqty, $price, $finalPrice, $status){
     
        $sql_query = "SELECT MAX(invoice_id) as invoice_id
                    FROM invoice 
                    WHERE customer_id = $customerId
                      AND invoice_payment_option='$payment' 
                      AND invoice_total_quantity = $totalqty
                      AND invoice_price = $price 
                      AND invoice_final_price = $finalPrice 
                      AND status = $status
                      ";

    //    echo "<br/>QUERY: ".$sql_query."<br/>";
        return $this->mysqli->query($sql_query);
    }

    /*
    Add a new invoice record to db
    */
    public function addInvoice($customerId, $payment, $totalqty, $price, $finalPrice, $status){
       
       $sql_query = "INSERT INTO `invoice`(`customer_id`, `invoice_payment_option`, `invoice_total_quantity`,
                      `invoice_price`, `invoice_final_price`, `status`) 
                    VALUES ($customerId, '$payment', $totalqty, 
                        $price, $finalPrice, $status)";

        if($this->mysqli->query($sql_query)){
       //     echo "Invoice.php:query worked ".$sql_query."<br/>";
            return true;
        }else{
       //     echo "Invoice.php:received error for query ".$sql_query." <br/>";
            return false;
        }
    }

   /*
    Add a new order line record to db
    */
    public function addOrderLine($invoiceId, $orderLines){
       
       $query = "INSERT INTO `order_line`(`invoice_id`, `good_id`, `good_quantity`) 
                    VALUES ";
        foreach($orderLines as $line){
            $query = $query."(".$invoiceId.", ".$line['goodId'].", ".$line['quantity']."),";
        }
        $sql_query = substr($query, 0, -1);

        if($this->mysqli->query($sql_query)){
            echo "Invoice.php:query worked ".$sql_query."<br/>";
            return true;
        }else{
            echo "Invoice.php:received error for query ".$sql_query." <br/>";
            return false;
        }
    }

    /*
    Add a new order line record to db
    */
  /*  public function addOrderLine($invoiceId, $goodId, $goodQty){
       
       $sql_query = "INSERT INTO `order_line`(`invoice_id`, `good_id`, `good_quantity`) 
                    VALUES ($invoiceId, $goodId, $goodQty)";

        if($this->mysqli->query($sql_query)){
        //    echo "Invoice.php:query worked ".$sql_query."<br/>";
            return true;
        }else{
      //      echo "Invoice.php:received error for query ".$sql_query." <br/>";
            return false;
        }
    }*/

    /*
    Delete an existing invoice in db
    */
    public function deleteInvoice($id){
       $sql_query = "DELETE FROM `invoice` WHERE `invoice_id`=$id";
     //   echo "<br/>QUERY: ".$sql_query."<br/>";
        return $this->mysqli->query($sql_query);
    }

    /*
    Delete an existing order line in db associated with an invoice
    */
    public function deleteOrderLine($id){
       $sql_query = "DELETE FROM `order_line` WHERE `invoice_id`=$id";
      //  echo "<br/>QUERY: ".$sql_query."<br/>";
        return $this->mysqli->query($sql_query);
    }

    //Constructor
    public function __construct($db){
        //echo "Constructor called";
        $this->mysqli = $db->getConnection();  
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone(){}
}               
?>
