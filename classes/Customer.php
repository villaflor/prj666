<?php
include_once("/data/www/default/wecreu/tools/sql.php");
/*
*Customer Class
*Author Olga
*contains add and get id functions for customer table
*created August 24 2017
*/
class Customer {
    
    private $mysqli;

    /*
    Get customer id
    */
    public function getCustomerId($name, $phone, $address, $city, $state, $country, $email){
     
        $sql_query = "SELECT MAX(customer_id) as customer_id
                    FROM customer 
                    WHERE customer_name = '$name' 
                      AND customer_number='$phone' 
                      AND customer_street_address = '$address'
                      AND customer_city = '$city' 
                      AND customer_state = '$state' 
                      AND customer_country = '$country'
                      AND customer_email = '$email' ";

    //    echo "<br/>QUERY: ".$sql_query."<br/>";
        return $this->mysqli->query($sql_query);
    }

    /*
    Add a new customer record to db
    */
    public function addCustomer($name, $phone, $address, $city, $state, $country, $email){
       
       $sql_query = "INSERT INTO `customer`(`customer_name`, `customer_number`, `customer_street_address`,
                      `customer_city`, `customer_state`, `customer_country`, `customer_email`) 
                    VALUES ('$name', '$phone', '$address', 
                        '$city', '$state', '$country', '$email')";

        if($this->mysqli->query($sql_query)){
         //   echo "Customer.php:query worked ".$sql_query."<br/>";
            return true;
        }else{
           // echo "Customer.php:received error for query ".$sql_query." <br/>";
            return false;
        }
    }

    /*
    Delete an existing customer in db
    */
    public function deleteCustomer($id){
       $sql_query = "DELETE FROM `customer` WHERE `good_id`=$id";
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
