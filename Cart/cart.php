<!DOCTYPE html>
<html>
<body>
<?php
include("sql.php");

/*
*Cart Class
*Author Christopher
*contains add remove view shipping information
*created June 4 2017
*/
class Cart {
    
    private $mysqli;
	//$cartItems = array("Volvo","BMW","Toyota");
    /*
    Get all goods
    return good list
    */
    public function getAllCart(){
		print_r($_COOKIE);
		echo "<br>";
        //$sql_query = "SELECT * FROM good";
        //return $this->mysqli->query($sql_query);
    }

    /*
    Get one good
    return good list
    
    public function getGoodDetail($id){
       $sql_query = "SELECT * FROM good WHERE good_id = $id";
        return $this->mysqli->query($sql_query);
    }
*/
    /*
    Add a new good to cart, create a cookie and add data to it
    */
    public function addCart($goodName,$goodId, $goodQuantity){
		
		$cookie_name = "$goodName";
		$elements = array("$goodId","$goodQuantity");
		$cookie_value = implode(",", $elements);
		//echo $item_info;
		//array_push($cartItems,$item_info);
		
						
		
		
		//if(count($_COOKIE) > 0) {
			
			setcookie($cookie_name, $cookie_value, time() + 86400, "/");
			if(!isset($_COOKIE[$cookie_name])){
				echo "Cookie named '" . $cookie_name . "' is not set! <br>";
			
		
			}
			else{
				echo "Cookie '" . $cookie_name . "' is set!<br>";
				echo "Value is: '" . $_COOKIE[$cookie_name]. "'<br>";
		
		
			}
			
		//}		
		/*
		else{
			echo "Cookies are disabled, please enable them for a full shopping experience";
		}*/
        /*
		$sql_query = "INSERT INTO order_line (invoice_id, good_id, good_quantity) VALUES ('$invoiceId', '$goodId', '$goodQuantity')";
        if($this->mysqli->query($sql_query)){
            echo "query worked <br/>";
            return true;
        }else{
            echo "received error ".mysqli_error($this->mysqli->query($sql_query))."<br/>";
            return false;
        }
		*/
    }
	public function printArray(){
		for ($i = 0; $i < sizeof($cartItems) ; $i++){
			echo $cartItems[$i] . '\n';
		}
	}
    /*
    Edit an existing good in db
    */
    public function editGood($id, $name, $description){
       $sql_query = "UPDATE good SET good_name='$name', good_description='$description' WHERE good_id = $id";
        return $this->mysqli->query($sql_query);
    }

    /*
    Delete an existing good in db
    */
    public function deleteCart($id){
       $sql_query = "DELETE FROM order_line WHERE good_id = $id";
        return $this->mysqli->query($sql_query);
    }

    //Constructor
    public function __construct(){
        //echo "Constructor called";
        $db = Database::getInstance();
        $this->mysqli = $db->getConnection();  
        //echo "error connecting " . $mysqli->connect_error;
        /*echo "error connecting" . $mysqli->connect_errno;*/
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone(){}
}               
?>
</body>
</html>
