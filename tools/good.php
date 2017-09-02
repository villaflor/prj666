<?php
include_once("/data/www/default/wecreu/tools/sql.php");
/*
*Good Class
*Author Olga
*contains add edit delete get all and get detail functions for goods
*created June 4 2017
*updated August 21 to retrieve sale id in getAllGoods and getGoodRows
*updated August 22 get good id function added
*/
class Good {
    
    private $mysqli;


    /*
    Get all goods
    return good list
    */
    public function getAllGoods($categoryid, $clientid){

        if($categoryid === "*"){
             $sql_query = "SELECT g.good_id as good_id, g.good_name as good_name, g.good_image as good_image, g.good_description as good_description, g.good_price as good_price, g.sale_id as sale_id,
                        c.category_id as category_id, c.category_name as category_name, c.category_description as category_description, g.good_in_stock as good_in_stock, c.client_id as client_id
                        FROM good g JOIN category c ON g.category_id = c.category_id WHERE g.good_visible = true and c.client_id = $clientid ORDER BY g.good_name";
        }else{
            $sql_query = "SELECT g.good_id as good_id, g.good_name as good_name, g.good_image as good_image, g.good_description as good_description, g.good_price as good_price, g.sale_id as sale_id,
                        c.category_id as category_id, c.category_name as category_name, c.category_description as category_description, g.good_in_stock as good_in_stock, c.client_id as client_id
                        FROM good g JOIN category c ON g.category_id = c.category_id
                        WHERE g.good_visible = true AND c.category_id = $categoryid AND c.client_id = $clientid ORDER BY g.good_name";
        }
       // echo "<br/>clientId is ".$clientid." SQL QUERY ".$sql_query."<br/>";
        return $this->mysqli->query($sql_query);
    }

    /*
    Get all goods for wecreu site that receives a client id. all goods per client only
    return good list
    */
    public function getMgmtGoods($client){

         $sql_query = "SELECT g.good_id as good_id, g.good_name as good_name, g.good_image as good_image, g.good_description as good_description, g.good_price as good_price, 
                    c.category_id as category_id, g.good_visible as good_visible, c.category_name as category_name, c.category_description as category_description, g.good_in_stock as good_in_stock, c.client_id as client_id
                    FROM good g JOIN category c ON g.category_id = c.category_id WHERE c.client_id = $client ORDER BY c.category_name, g.good_name, g.good_visible";

        return $this->mysqli->query($sql_query);
    }

   /*
    Get all goods with limit function
    return good list
    */
    public function getGoodRows($categoryid, $clientid, $limit=0, $offset=0){
       
        if($categoryid === "*"){
             $sql_query = "SELECT g.good_id as good_id, g.good_name as good_name, g.good_image as good_image, g.good_description as good_description, g.good_price as good_price, g.sale_id as sale_id,
                        c.category_id as category_id, c.category_name as category_name, c.category_description as category_description, g.good_in_stock as good_in_stock, c.client_id as client_id
                        FROM good g JOIN category c ON g.category_id = c.category_id WHERE g.good_visible = true AND c.client_id = $clientid ORDER BY g.good_name 
                        LIMIT $limit OFFSET $offset "; 
        }else{
            $sql_query = "SELECT g.good_id as good_id, g.good_name as good_name, g.good_image as good_image, g.good_description as good_description, g.good_price as good_price, g.sale_id as sale_id,
                        c.category_id as category_id, c.category_name as category_name, c.category_description as category_description, g.good_in_stock as good_in_stock, c.client_id as client_id
                        FROM good g JOIN category c ON g.category_id = c.category_id
                        WHERE g.good_visible = true AND c.category_id = $categoryid AND c.client_id = $clientid ORDER BY g.good_name 
                        LIMIT $limit OFFSET $offset"; 
        }
      //  echo "<br/> SQL QUERY ".$sql_query."<br/>";
        return $this->mysqli->query($sql_query);
    }

    /*
    Get one good
    return good list
    */
    public function getGoodDetail($id){
     
        $sql_query = "SELECT g.good_id as good_id, g.good_name as good_name, g.good_image as good_image, 
                            g.good_description as good_description, g.good_price as good_price, g.good_in_stock as good_in_stock,
                            g.good_weight as good_weight, g.good_taxable as good_taxable, g.good_visible as good_visible, 
                            c.category_id as category_id, c.category_name as category_name, 
                            g.sale_id as sale_id
                    FROM good g join category c on g.category_id = c.category_id
                    WHERE g.good_id = $id";
     //   echo "<br/>QUERY: ".$sql_query."<br/>";
        return $this->mysqli->query($sql_query);
    }

    /*
    Get good id
    return good list
    */
    public function getGoodId($name, $image, $description, $price, $stock, $weight, $taxable, $visible, $category, $clientId){
     
        $sql_query = "SELECT MAX(g.good_id) as good_id
                    FROM good g join category c on g.category_id = c.category_id
                    WHERE g.good_name = '$name' AND g.good_image='$image' AND g.good_description = '$description'
                      AND g.good_price = $price AND g.good_in_stock = $stock AND g.good_weight = '$weight'
                      AND g.good_taxable = $taxable AND g.good_visible = $visible AND g.category_id = $category 
                      AND c.client_id = $clientId";

    //    echo "<br/>QUERY: ".$sql_query."<br/>";
        return $this->mysqli->query($sql_query);
    }

    /*
    Add a new good to db
    */
    public function addGood($name, $image, $description, $price, $stock, $weight, $taxable, $visible, $category){
       
       $sql_query = "INSERT INTO `good`(`good_name`, `good_image`, `good_description`, `good_price`, 
                      `good_in_stock`, `good_weight`, `good_taxable`, `good_visible`, `category_id`) 
                    VALUES ('$name', '$image', '$description', $price,
                        $stock, $weight, $taxable, $visible, $category)";

        if($this->mysqli->query($sql_query)){
         //   echo "good.php:query worked ".$sql_query."<br/>";
            return true;
        }else{
         //   echo "good.php:received error for query ".$sql_query." <br/>";
            return false;
        }
    }

    /*
    Edit an existing good in db
    */
    public function editGood($id, $name, $image, $description, $price, $stock, $weight, $taxable, $visible, $category, $sale){
       
        $sql_query = "UPDATE `good` SET good_name='$name', good_image='$image', good_description='$description', good_price=$price, 
                                    good_in_stock=$stock, good_weight=$weight, good_taxable=$taxable, good_visible=$visible,
                                    category_id=$category, sale_id=$sale WHERE good_id = $id";
        
        if($this->mysqli->query($sql_query)){
         //   echo "good.php:query worked ".$sql_query."<br/>";
            return true;
        }else{
         //   echo "good.php:received error for query ".$sql_query." <br/>";
            return false;
        }  
    }

    /*
    Delete an existing good in db
    */
    public function deleteGood($id){
       $sql_query = "DELETE FROM `good` WHERE `good_id`=$id";
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
