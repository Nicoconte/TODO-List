<?php  


class DbConnection {

	private $userHost     = "localhost";
	private $userName     = "root";
	private $userPassword = "";
	private $userDatabase = "todolist";

	function getConnection() {

		$connection = mysqli_connect($this->userHost, $this->userName, $this->userPassword, $this->userDatabase);
		
		return $connection;
		
	}

}


?>