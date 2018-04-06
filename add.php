<html>
	<body>

		<?php
			require('Database.php');
			$servername = "localhost";
			$username = "p2andreo";
			$password = "Ciwowrav";
			$dbname = "p2andreo";
			$connection = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
					die("Connection failed: " . $thisDb->connection->connect_error);
			}
			$thisDb = new Database($connection);
			$table = "";
			$numFields=0;
			$fullQuery="INSERT INTO ";
			
			if(isset($_POST['table'])){
				$table = $_POST['table'];
			}else{
				die('input invalid. Please try again. ' . $thisDb->connection->error);
			}
			$fullQuery = $fullQuery . $table . " (";
			switch($table){
					case "images": break;
					case "artists": case "shoppingcart": case "reviews": $numFields = 3; break;
					case "artworks": $numFields = 6; break;
					case "museums": $numFields = 4; break;;
					case "genres": case "subjects": $numFields =1; break;
			}

			for($i=0; $i<$numFields; $i++){
				if(isset($_POST['f'.$i])){
					if($_POST['f'.$i] == ""){

						continue;
					}
					if($i > 0){
						$fullQuery .= ", ";
					}
					$fullQuery .= $_POST['f'.$i] ;/*
					if($i != $numFields-1){
						$fullQuery .= ", ";
					}*/
					
				}else{
					die('input invalid. Please try again. '  . $thisDb->connection->error);
				}
			}

			$fullQuery .= ") VALUES (";

			for($i=0; $i<$numFields; $i++){
				if(isset($_POST['v'.$i])){
					if($_POST['v'.$i] == ""){

						continue;
					}
					if($i > 0){
						$fullQuery .= ", ";
					}
					$fullQuery .= "'" . $_POST['v'.$i] . "'";
					
				}else{
					die('input invalid. Please try again. '  . $thisDb->connection->error);
				}
			}

			$fullQuery .= ")";


			//$fullQuery = "UPDATE " . $table . " SET " . $updateFields . " WHERE " . $updateConditions;
			echo "Query: " . $fullQuery . "<br>";
			
			if ($thisDb->connection->query($fullQuery) === TRUE) {
			       echo "Successfully Added";
			} else {
			    echo "Error Updating: " . $thisDb->connection->error . "<br>";
			}

		?>
		<br>
		<a href="maintain.php"><button>Back to Maintain</button></a>
		<br>
		<br>
		<a href="assign1.php"><button>Back to Main Page</button></a>
	</body>
</html>