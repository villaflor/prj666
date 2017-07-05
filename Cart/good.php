<?php
include_once("sql.php");

/*
*Good Class
*Author Olga
*contains add edit delete get all and get detail functions for goods
*created June 4 2017
*/
class Good {
    
    private $mysqli;

    /*
    Get all goods
    return good list
    */
    public function getAllGoods(){
       // $sql_query = "SELECT * FROM good";
        $sql_query = "SELECT g.good_id as good_id, g.good_name as good_name, g.good_image as good_image, g.good_description as good_description, g.good_price as good_price, 
                        c.category_id as category_id, c.category_description as category_description, c.client_id as client_id
                        from good g join category c on g.category_id = c.category_id
                        where c.category_id = 4"; //c.client_id=1 
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
                            c.category_id as category_id, c.category_name as category_name 
                    FROM good g join category c on g.category_id = c.category_id where g.good_id = $id";
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
            echo "good.php:query worked <br/>";
            return true;
        }else{
            echo "good.php:received error ";//.mysqli_error($this->mysqli->query($sql_query))."<br/>";
            return false;
        }
    }

    /*
    Edit an existing good in db
    */
    public function editGood($id, $name, $image, $description, $price, $stock, $weight, $taxable, $visible, $category, $sale){
       /* "UPDATE 'good' SET 'good_name'='$name', 'good_image'='$image', 'good_description'='$description', 'good_price'=$price, 
                                    'good_in_stock'=$stock, 'good_weight'=$weight, 'good_taxable'=$taxable, 'good_visible'=$visible,
                                    'category_id'=$category, 'sale_id'=$sale WHERE 'good_id' = $id";*/
        $sql_query ="UPDATE good SET good_name='test', good_image='image', good_description='description', good_price=40.50,
                                       good_in_stock=100, good_weight=5, good_taxable=1, good_visible=1, category_id=4, sale_id=1 
                                    WHERE good_id = 7";
        //echo $sql_query;
        return $this->mysqli->query($sql_query);
      //return true;
    }

    /*
    Delete an existing good in db
    */

    public function deleteGood($id){
       $sql_query = "DELETE FROM `good` WHERE `good_id`=65";
        return $this->mysqli->query($sql_query);
    }

    //Constructor
    public function __construct($db){
        //echo "Constructor called";
        $this->mysqli = $db->getConnection();  
        //echo "error connecting " . $mysqli->connect_error;
        /*echo "error connecting" . $mysqli->connect_errno;*/
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone(){}
}               
?>
