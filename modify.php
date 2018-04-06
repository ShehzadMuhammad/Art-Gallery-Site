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
			$updateFields = "";
			$updateConditions = "";
			if(isset($_POST['table'])){
				$table = $_POST['table'];
			}else{
				die('input invalide. Please try again. ' . $thisDb->connection->error);
			}
			if(isset($_POST['updateQueryFields'])){
				$updateFields = $_POST['updateQueryFields'];
			}else{
				die('input invalide. Please try again. ' . $thisDb->connection->error);
			}
			
			if(isset($_POST['updateQueryConditions'])){
				$updateConditions = $_POST['updateQueryConditions'];
			}else{
				die('input invalide. Please try again. ' . $thisDb->connection->error);
			}
			$fullQuery = "UPDATE " . $table . " SET " . $updateFields . " WHERE " . $updateConditions;
			echo "Query: " . $fullQuery . "<br>";
			
			if ($thisDb->connection->query($fullQuery) === TRUE) {
			       echo "Successfully Updated";
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