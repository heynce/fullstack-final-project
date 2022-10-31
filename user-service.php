<?php

	class User {
		private mysqli $conn;
		public int $userid = 10;
		public string $username = '';
		public string $email = '';

		public function __construct(Database $db) {
			$this->conn = $db->getConnections();
		}

		function create() {
			$number_rows = $this->read()->num_rows;
			$newUserID = $number_rows + 1; 

			$query = "INSERT INTO USERS (userid, username, email ) VALUES (?, ?, ?);";
			$statement = $this->conn->prepare($query);

			$statement->bind_param('issss', $newUserid, $this->username, $this->email);
			return $statement->execute();
		}

		function read() {
			$query = "SELECT * FROM users;";
			$statement = $this->conn->prepare($query);
			
			$statement->execute();
			return $statement->get_result();
		}

		function update() {}
		function delete() {}
	}

?>