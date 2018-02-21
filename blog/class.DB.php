<?php
	class DB
	{
		private $db;
		private $database = "zalogowani";
		private $host = "localhost";
		private $username = "root";
		private $password = "";
		
		public function __construct()
		{
			$this->db = mysqli_connect( $this->host, $this->username, $this->password, $this->database);
			if (mysqli_connect_errno()) 
			{
				echo "Blad polaczenia z baza";
				die();
			}
			$this->db->query("SET NAMES utf8"); //polskie znaki  
		}
		
		public function query($query)
		{
			$result = mysqli_query($this->db, $query);
			
			if(is_bool($result)) return $result;
			
			$tablica = array();
			while ($row = mysqli_fetch_array($result))
			{
				$tablica[] = $row;
			}
			return $tablica;
		}
	}
?>