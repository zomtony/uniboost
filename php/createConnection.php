<?php
	class createConnection {
		public $servername = "45.78.25.200";
		public $port = "3306";
		public $username = "zhimadeveloper";
		public $password = "zhimadeveloper12";
		public $dbname = "zhimadeveloper";
		public $conn;
		// Check connection
		function connect(){
			try {
				$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;port=$this->port", $this->username, $this->password);
				// set the PDO error mode to exception
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $this->conn;
			}
			catch(PDOException $e)
			{
				echo "Connection failed: " . $e->getMessage();
			}
		}

		function disconnect(){
			$this->conn = null;
		}
	}
?>
