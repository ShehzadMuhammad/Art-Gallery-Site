<!DOCTYPE html>
<html>
<!--http://www.scs.ryerson.ca/~p2andreo/CPS630/Assignment/CPS630/assign1.php-->

	<head>
		<meta charset="UTF-8">
		<title>Art Gallery</title>
		<link rel="stylesheet" type="text/css" href="assign1.css">
    <script src="art.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</head>
	  
	<body>
		<?php
		//include 'Database.php';
		require('Database.php');
		$servername = "localhost";
		$username = "p2andreo";
		$password = "Ciwowrav";
		$dbname = "p2andreo";
		$thisDb = new Database($servername, $username, $password, $dbname);


		$create_table_artworks = "
			";
	?>
		<div>
			<a style="text-decoration: none" href="">
				<button>Home</button>
			</a>
			<a style="text-decoration: none" href="">
				<button>About Us</button>
			</a>
			<a style="text-decoration: none" href="">
				<button>Blogs</button>
			</a>

			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="openModalByShoppingCart();"><img src="Resources/shopping-cart.svg" width="10%" height="10%"></button>
		</div>

		<br>
		<!--Group Table-->
		<table border="1">
			<tr>
				<td>
					<h1>Group 50</h1>
				</td>
			</tr>
			<tr>
				<td>
					Pietro Andreoli 500639696
				</td>
			</tr>
			<tr>
				<td>
					Shehzad Muhammad 500592053
				</td>
			</tr>
		</table>
		<br>
	  
		<!--Art Dropdown Menu-->
		<div class="dropdown">
			<button class="dropbtn">Art Works</button>
			<div class="dropdown-content">
				<a href="#" onclick="artwork1()">Mona Lisa</a>
				<a href="#" onclick="artwork2()">The Night Watch</a>
				<a href="#" onclick="artwork3()">Third Class Carriage</a>
				<a href="#" onclick="artwork4()">The Starry Night</a>
				<a href="#" onclick="artwork5()">Guernica</a>
			</div>

		</div>
	<!--Artist Dropdown Menu-->
		<div class="drop2">
			<button class="btn2">Artist</button>
			<div class="drop2-content">
				<a href="#" onclick="artist1()">Raphael Sanzio da Urbino</a>
				<a href="#" onclick="artist2()">Leonardo di ser Piero da Vinci</a>
				<a href="#" onclick="artist3()">Rembrandt Harmenszoon van Rjin</a>
				<a href="#" onclick="artist4()">Pablo Picasso</a>
				<a href="#" onclick="artist5()"> Michelangelo di Lodovico Buonarroti Simoni </a>
			</div>
		</div>
	<!--Museum Dropdown Menu-->
		<div class="drop2">
			<button class="btn2">Museum</button>
			<div class="drop2-content">
				<a href="#" onclick="showData('The Louvre')">The Louvre</a>
				<a href="#" onclick="showData('Metropolitan Museum of Art')">Metropolitan Museum of Art</a>
				<a href="#" onclick="showData('Hermitage Museum')">Hermitage Museum</a>
				<a href="#" onclick="showData('British Museum')">British Museum</a>
				<a href="#" onclick="showData('Art Institute of Chicago')">Art Institute of Chicago</a>
			</div>
		</div>
		<br>
		<br>
		<!--Info Container-->
		<div id="ArtSection" style="visibility: hidden;">
			<div id="image">
				<img id="artImage" src="" width="200px" height="200px">
			</div>
			<div id="info">
				<p id="artDescription"></p>
			</div>
		</div>

		<div id="ArtSection2" style="visibility: hidden;">
			<div id="image">
				<img id="artImage2" src="" width="100%" height="100%">
			</div>
			<div id="info">
				<p id="artDescription2"></p>
				  <!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="openModal();">Open Modal</button>

				
		</div>
<!-- Modal -->
				<div style="visibility: hidden;" class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Modal Header</h4>
						</div>
					<div class="modal-body">
						<form onsubmit="setPurchase()">
							Painting:
							<div id="staticPaintingName">
								<p id="selectedPaintingName"></p>
							</div>
							<div >
								<select id="dynamicPaintingName" name="paintings">
									<option value="The Starry Night">The Starry Night</option>
									<option value="The Night Watch">The Night Watch</option>
									<option value="Third Class Carriage">Third Class Carriagef</option>
									<option value="Guernica">Guernica</option>
									<option value="Mona Lisa">Mona Lisa</option>
								</select>
							</div>
							<br />
							<br />
							Quantity: <input type="number" id="purchaseQuantity" name="quantity" min="1" max="5" value="0">
							<br />
							Shipping Plan: <br/>
							<input id="ship1" type="radio" name="shippingPlan" value="standard" checked>Standard (2-3 weeks): $4.99 <br/>
							<input id="ship2" type="radio" name="shippingPlan" value="express">Express (2-5 days): $14.99 <br/>
							<input id="ship3" type="radio" name="shippingPlan" value="nextDay">Next Day: $39.99 <br />
							<br>
							<button onclick="calcInvoice();">Calculate Invoice</button>
							<br>
							<p id="invoice"></p>
							<br>

							<input type="submit" value="Submit" >
							<input type="reset">
						</form>
	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
	</body>

</html>