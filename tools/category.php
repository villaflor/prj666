<?php
include_once("sql.php");

/*
* Category class
* Author Brian
*/
class Category {

	private $mysqli;
	private $client_id;

	/*
	Get All categories
	@return category
	*/
	public function getAll() {
		$sql_query = "SELECT * FROM category WHERE category_display = 1 AND client_id = $this->client_id";
	    return $this->mysqli->query($sql_query);
	}

	/*
	Get All categories including hidden categories
	@return category
	*/
	public function getAllAvaliable() {
		$sql_query = "SELECT * FROM category WHERE client_id = $this->client_id";
		return $this->mysqli->query($sql_query);
	}

	/*
	Get one categorie
	@return category
	*/
	public function getOne($id) {
		$sql_query = "SELECT * FROM category WHERE category_id=$id AND client_id = $this->client_id ";
	    return $this->mysqli->query($sql_query);
	}

	/*
	Add one category
	*/
	public function add($name, $description) {
		if ($name == "" || $description == ""){
			return false;
		}

		$sql_query = "INSERT INTO category(category_name, category_description, category_display, client_id) VALUES ('$name', '$description', 1, $this->client_id)";
	    return $this->mysqli->query($sql_query);
	}

	/*
	Edit one category
	*/
	public function edit($id, $name, $description) {
		if ($name == "" || $description == ""){
			return false;
		}

		$sql_query = "UPDATE category SET category_name='$name',category_description='$description' WHERE category_id=$id AND client_id = $this->client_id";
	    return $this->mysqli->query($sql_query);
	}

	/*
	Hide a category
	*/
	public function hide($id) {
		$sql_query = "UPDATE category SET category_display=0 WHERE category_id=$id AND client_id = $this->client_id";
	    return $this->mysqli->query($sql_query);
	}

	/*
	Delete a category
	*/
	public function delete($id) {
		$sql_query = "DELETE FROM `good` WHERE `category_id` = $id";
		$this->mysqli->query($sql_query);
		$sql_query = "DELETE FROM `category` WHERE `category`.`category_id` = $id AND client_id = $this->client_id";
		return $this->mysqli->query($sql_query);
	}

	/*
	show a hidden category
	*/
	public function show($id) {
		$sql_query = "UPDATE category SET category_display=1 WHERE category_id=$id AND client_id = $this->client_id";
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
