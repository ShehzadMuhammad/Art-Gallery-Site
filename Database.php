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
		 
		function fetchArtData($artId){
			$query = 'SELECT * FROM artworks WHERE artId=' . $artId;
			$name = '';
			$imagePath = '';
			$description = '';
			$artistId = -1;
			$price = 0;
			$output = array();
			$result = $this->connection->query($query);

			try{
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						return $row;
						$name = $row["name"];

						$imagePath = $row["imagePath"];

						$description = $row["description"];
						$artistId = $row["artistId"];
						$price = $row["price"];
					}
				} else {
				    echo "0 results";
				}
			}catch(Exception $e){
			    echo "NOPE";
			}
			
			$output['name'] = $name;
			$output['imagePath'] = $imagePath;
			$output['description'] = $description;
			$output['artistId'] = $artistId;
			$output['price'] = $price;

			return $output;

		}
		
	}


?>