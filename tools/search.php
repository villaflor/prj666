<?php
include_once("sql.php");

/*
* Good search class
* Author Brian
*/
class Search {
	private $mysqli;
	private $client_id;

	/*
	Get All goods
	@return goods
	*/
	public function getAll() {
		$sql_query = "SELECT * FROM v_category_good WHERE category_display = 1 AND client_id = $this->client_id";
	  return $this->mysqli->query($sql_query);
	}

	/*
	search
	@return goods
	*/
	public function searchGood($keyword) {
		$sql_query = "SELECT * FROM v_category_good WHERE category_display = 1 AND client_id = $this->client_id AND good_name LIKE '%$keyword%' ";
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
