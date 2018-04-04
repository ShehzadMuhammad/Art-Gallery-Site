<?php 

	class Database{


		function __construct($connection) { 
			/*$a = func_get_args(); 
			$i = func_num_args(); 
			if (method_exists($this,$f='__construct'.$i)) { 
				call_user_func_array(array($this,$f),$a); 
			} */

			$this->connection = $connection;
		} 

		function __construct1($connection){ 
			$this->connection = $connection;
		} 

		function __construct4($servername, $username, $password, $dbname) { 
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
		 
		function fetchArtistData($id){
			$query = 'SELECT * FROM artists WHERE artistId=' . $id;
			$result = $this->connection->query($query);
			try{
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						return $row;
					
					}
				} else {
				    echo "0 results";
				}
			}catch(Exception $e){
			    echo "NOPE";
			}
			

		
		}
		function fetchMuseumData($id){
			$query = 'SELECT * FROM meusems WHERE museumID=' . $id;
			$result = $this->connection->query($query);
			try{
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						return $row;
					
					}
				} else {
				    echo "0 results";
				}
			}catch(Exception $e){
			    echo "NOPE";
			}
			

		
		}
		function fetchArtData($artId){
			$query = 'SELECT * FROM artworks WHERE artId=' . $artId;
			$result = $this->connection->query($query);
			try{
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						return $row;
					
					}
				} else {
				    echo "0 results";
				}
			}catch(Exception $e){
			    echo "NOPE";
			}
			

		}
		
	}


?>