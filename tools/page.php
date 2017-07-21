<?php
include_once("sql.php");

class Page {

	private $mysqli;
	private $client_id;

	public function getAll() {
		$sql_query = "SELECT * FROM page WHERE client_id = $this->client_id";
	  return $this->mysqli->query($sql_query);
	}

	public function add($name) {
		if ($name == ""){
			return false;
		}

		if(strlen($name)>90){
			$name = substr($name, 1 ,90);
		}
		$sql_query = "INSERT INTO page(page_name, client_id) VALUES ('$name', $this->client_id)";
	  return $this->mysqli->query($sql_query);
	}

	public function edit($id, $name) {
		if ($name == ""){
			return false;
		}

		$sql_query = "UPDATE page SET page_name='$name'WHERE id=$id AND client_id = $this->client_id";
	  return $this->mysqli->query($sql_query);
	}


	public function delete($id) {
    $sql_query = "DELETE FROM page WHERE id = $id AND client_id = $this->client_id";
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
