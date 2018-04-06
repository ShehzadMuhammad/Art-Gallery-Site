<?php
	$name="";
	$price=0;
	$quantity=0;
	$shipping=0;
	$invoice = 0;
	if(isset($_POST['name'])){
				$name = $_POST['name'];
	}else{
		die('name invalide. Please try again. ' . $thisDb->connection->error);
	}
	if(isset($_POST['price'])){
				$price = $_POST['price'];
	}else{
		die('price invalide. Please try again. ' . $thisDb->connection->error);
	}
	if(isset($_POST['quantity'])){
				$quantity = $_POST['quantity'];
	}else{
		die('quantity invalide. Please try again. ' . $thisDb->connection->error);
	}
	if(isset($_POST['shipping'])){
				$shipping = $_POST['shipping'];
	}else{
		die('shipping invalide. Please try again. ' . $thisDb->connection->error);
	}
	$invoice = $price * $quantity + $shipping;
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
	$query = "INSERT INTO shoppingcart (shippingPlan, invoice) VALUES('" . $shipping . "'," . $invoice . ")";

?>