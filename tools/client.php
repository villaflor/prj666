<?php
include_once("sql.php");

/*
* client class
* Author Brian
*/
class Client {

	private $mysqli;
	private $client_id;

	public function getClientName() {
		$sql_query = "SELECT client_name FROM client WHERE client_id = $this->client_id";
	    $result = $this->mysqli->query($sql_query);
	    $result = mysqli_fetch_assoc($result);
	    return $result['client_name'];
	}

	public function getClientSiteTitle() {
		$sql_query = "SELECT * FROM client WHERE client_id = $this->client_id";
	    $result = $this->mysqli->query($sql_query);
	    $result = mysqli_fetch_assoc($result);
	    return $result['client_site_title'];
	}

	public function getClientInfo() {
		$sql_query = "SELECT * FROM client WHERE client_id = $this->client_id";
	    $result = $this->mysqli->query($sql_query);
	    $result = mysqli_fetch_assoc($result);
	    return $result['client_information'];
	}


	public function getClientUserName() {
		$sql_query = "SELECT * FROM client WHERE client_id = $this->client_id";
	    $result = $this->mysqli->query($sql_query);
	    $result = mysqli_fetch_assoc($result);
	    return $result['username'];
	}

	public function getClientEmail() {
		$sql_query = "SELECT * FROM client WHERE client_id = $this->client_id";
	    $result = $this->mysqli->query($sql_query);
	    $result = mysqli_fetch_assoc($result);
	    return $result['client_admin_email'];
	}
	public function getClientPhone() {
		$sql_query = "SELECT * FROM client WHERE client_id = $this->client_id";
	    $result = $this->mysqli->query($sql_query);
	    $result = mysqli_fetch_assoc($result);
	    return $result['phone_number'];
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
