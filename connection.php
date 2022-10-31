<?php 
	class Database {
		private $username="php_user";
		private $password="pass@123";
		private $host="localhost";
		private $database="login_db";
		private mysqli $conn;

		public function __construct() {
			$this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
			if ($this->conn->connect_error) {
				die('Connection Failed' . $this->conn->connect_error);
			}
		}

		public function getConnections() {
			return $this->conn;
		}
	}

?>