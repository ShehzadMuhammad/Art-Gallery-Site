<?php
	require('Database.php');
	$servername = "localhost";
	$username = "p2andreo";
	$password = "Ciwowrav";
	$dbname = "p2andreo";
	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
	}
	$thisDb = new Database($connection);
	$table = "";
	$deleteQuery = "";
	if(isset($_POST['table'])){
		$table = $_POST['table'];
	}else{
				die('input invalide. Please try again. ' . $thisDb->connection->error);
			}
	if(isset($_POST['deleteQuery'])){
		$deleteQuery = $_POST['deleteQuery'];
	}else{
				die('input invalide. Please try again. ' . $thisDb->connection->error);
			}
	$fullQuery = "DELETE FROM " . $table . " WHERE " . $deleteQuery;
	echo "Query: " . $fullQuery . "<br>";
	
	if ($thisDb->connection->query($fullQuery) === TRUE) {
	       echo "Successfully Deleted";
	} else {
	    echo "Error Deleting: " . $conn->error . "<br>";
	}

?>
<br>
		<a href="maintain.php"><button>Back to Maintain</button></a>
		<br>
		<br>
		<a href="assign1.php"><button>Back to Main Page</button></a>