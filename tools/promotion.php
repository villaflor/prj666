<?php
include_once("sql.php");

/*
* promotion class
* Author Brian
*/
class Promotion {
	private $mysqli;
	private $client_id;

	/*
	Get All promotion
	@return promotion
	*/
	public function getAll() {
		$sql_query = "SELECT * FROM v_sale_good_category WHERE client_id = $this->client_id ORDER BY sale_id";
	  return $this->mysqli->query($sql_query);
	}

	/*
	Get All promotion that in the sale date
	@return promotion
	*/
	public function getAllAvaliable() {
		$sql_query = "SELECT * FROM `v_sale_good_category` WHERE `start_date` < NOW() AND `end_date` > NOW() AND client_id = $this->client_id ORDER BY sale_id";
	  return $this->mysqli->query($sql_query);
	}

	// Constructor
	public function __construct($db, $client_id) {
		$this->mysqli = $db->getConnection();
    $this->client_id = $client_id;
	}

	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
}
?>
