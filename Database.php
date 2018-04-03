<?php 

	class Database{


		function __construct() { 
			$a = func_get_args(); 
			$i = func_num_args(); 
			if (method_exists($this,$f='__construct'.$i)) { 
				call_user_func_array(array($this,$f),$a); 
			} 
		} 

		function __construct1($connection){ 
			$this->connection = $connection;
		} 

		function __construct2($servername, $username, $password, $dbname) { 
			try{
				$this->connection = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) {
    				die("Connection failed: " . $conn->connect_error);
				}
				$this->servername = $servername;
				$this->username = $username;
				$this->password = $password;
				$this->dbname = $dbname;
			}catch(Exception $e){
				echo $e;
				
			}
		}
		 

		
	}


?>