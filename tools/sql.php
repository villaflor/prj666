<?php
/*
* SQL class
*/
class Database {
	private $_connection;
	private static $_instance;
	/**
	* @return The DB
	*/
	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Constructor
	private function __construct() {
		$sqlinfo = parse_ini_file("/secret/sql.ini");
		$host = $sqlinfo['host'];
		$username = $sqlinfo['username'];
		$password = $sqlinfo['password'];
		$database = $sqlinfo['database'];
		$this->_connection = new mysqli($host, $username, $password, $database);

		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
		}
	}
	private function __clone() { }
	public function getConnection() {
		return $this->_connection;
	}

	function __destruct() {
		$this->_connection ->close();
	}
}
?>
