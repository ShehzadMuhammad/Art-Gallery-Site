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
	}
	if(isset($_POST['deleteQuery'])){
		$deleteQuery = $_POST['deleteQuery'];
	}
	$fullQuery = "DELETE FROM " . $table . " WHERE " . $deleteQuery;
	echo $fullQuery;
	
	if ($thisDb->connection->query($fullQuery) === TRUE) {
	       echo "Successfully Deleted";
	} else {
	    echo "Error Deleting: " . $conn->error . "<br>";
	}
?>