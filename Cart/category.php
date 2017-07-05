<?php
include("sql.php");

/*
* Category class
* Author Brian
*/
class Category {

	private $mysqli;

	/*
	Get All categories
	@return category
	*/
	public function getAll() {
		$sql_query = "SELECT * FROM category WHERE category_display = 1";
	    return $this->mysqli->query($sql_query);
	}

	/*
	Get one categorie
	@return category
	*/
	public function getOne($id) {
		$sql_query = "SELECT * FROM category WHERE category_display = 1 AND category_id=$id";
	    return $this->mysqli->query($sql_query);
	}


	/*
	Add one category
	*/
	public function add($name, $description) {
		$sql_query = "INSERT INTO category(category_name, category_description, category_display) VALUES ('$name', '$description', 1)";
	    return $this->mysqli->query($sql_query);
	}

	/*
	Edit one category
	*/
	public function edit($id, $name, $description) {
		$sql_query = "UPDATE category SET category_name='$name',category_description='$description' WHERE category_id=$id";
	    return $this->mysqli->query($sql_query);
	}

	/*
	Hide a category
	*/
	public function hide($id) {
		$sql_query = "UPDATE category SET category_display=0 WHERE category_id=$id";
	    return $this->mysqli->query($sql_query);
	}

	/*
	show a hidden category 
	*/
	public function show($id) {
		$sql_query = "UPDATE category SET category_display=1 WHERE category_id=$id";
	    return $this->mysqli->query($sql_query);
	}


	// Constructor
	public function __construct() {
		$db = Database::getInstance();
	    $this->mysqli = $db->getConnection(); 
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
}
?>
