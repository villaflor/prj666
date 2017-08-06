<?php
include_once("sql.php");

/**
* view order class
*/
class Order {

	private $mysqli;
	private $client_id;

	public function getAll() {
		$sql_query = "SELECT * FROM v_orderLine_invoice_customer WHERE client_id = $this->client_id";
	  return $this->mysqli->query($sql_query);
	}

	public function getOne($invoiceid) {
		$sql_query = "SELECT * FROM v_orderLine_invoice_customer WHERE client_id = $this->client_id AND invoice_id = $invoiceid";
	  return $this->mysqli->query($sql_query);
	}

	// Constructor
	public function __construct($db, $client_id) {
		$this->mysqli = $db->getConnection();
    $this->client_id = $client_id;
	}

	private function __clone() { }
}
?>
