<!DOCTYPE html>
<html>
<!--http://www.scs.ryerson.ca/~p2andreo/CPS630/Assignment/CPS630/assign1.php-->

	<head>
		<meta charset="UTF-8">
		<title>Art Gallery</title>
		<link rel="stylesheet" type="text/css" href="assign1.css">
    <!--<script src="art.js"></script>-->


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
			$connection = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
    				die("Connection failed: " . $conn->connect_error);

			}

			/*$result = $connection->query("select * from artists");
			while($row = $result->fetch_assoc()) {
        		echo $row['artistId'];
    		}*/
			//$thisDb = new Database($servername, $username, $password, $dbname);
				$thisDb = new Database($connection);


		?>
		<script>
				var selectedArt = "";
				var purchasedArt = [];



				function setPurchase(){
					var staticName = document.getElementById('staticPaintingName');
					var dynamicName = document.getElementById('dynamicPaintingName');
					var quantity = document.getElementById("purchaseQuantity");
					var ship1 = document.getElementById("ship1");
					var ship2 = document.getElementById("ship2");
					var ship3 = document.getElementById("ship3");
					var details = [];
					if(staticName.style.visibility == "visible"){
						details["name"] = staticName.innerHTML;
					}else{
						details["name"] = dynamicName.value;
					}
					if(details["name"] == "Monal Lisa") details["price"] = 800000000;
					else if(details["name"] == "The Night Watch") details["price"] = 23000;
					else if(details["name"] == "Third Class Carriage") details["price"] = 40000;
					else if(details["name"] == "The Starry Night") details["price"] = 150000000;
					else if(details["name"] == "Guernica") details["price"] = 179000000;
					else details["price"] = 0;
					if(parseInt(quantity.value) > 0){
						details["quantity"] = parseInt(quantity.value);
					}
					if(ship1.checked){
						details["shipping"] = 4.99;

					}else if(ship2.checked){
						details["shipping"] = 14.99;
					}else{
						details["shipping"] = 39.99;
					}
					
					purchasedArt.push(details);
					console.log(details);
					//return true;
				}
				function calcInvoice(){
					var total = 0;
					
					if(purchasedArt.length > 0){
						console.log(purchasedArt);
						for(var i = 0; i < purchasedArt.length; i++){
							
							total += (purchasedArt[i]["quantity"] * purchasedArt[i]["price"]) + purchasedArt[i]["shipping"];
						}
					}
					document.getElementById("invoice").innerHTML = "Your total so far is: " + toString(total);
				}
				function openModalByShoppingCart(){
					document.getElementById('myModal').style.visibility='visible';
					document.getElementById('staticPaintingName').style.visibility='hidden';
					document.getElementById('dynamicPaintingName').style.visibility='visible';

				}
				function openModal(){
					document.getElementById('myModal').style.visibility='visible';
					document.getElementById('staticPaintingName').style.visibility='visible';
					document.getElementById('dynamicPaintingName').style.visibility='hidden';
					document.getElementById('selectedPaintingName').innerHTML = selectedArt;
				}
				function artwork1() {
					<?php $result = $thisDb->fetchArtData(1); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = <?php echo "\"" . $result["imagePath"] . "\"";?>;
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArt1()'><?php echo $result["name"];?> </span></a> </br> Description:  <?php echo $result["shortDescription"];?><br>Price: $<?php echo $result["price"];?>";
				}

				function showArt1() {
					<?php $result = $thisDb->fetchArtData(1); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>Price: $<?php echo $result["price"];?><br>Genre: Portrait";
					selectedArt = "Monal Lisa";
				}

				function artwork2() {
					<?php $result = $thisDb->fetchArtData(2); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArt2()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["shortDescription"];?>  <br>Price: $<?php echo $result["price"];?>";
				}
				<?php unset($result); ?>

				function showArt2() {
					<?php $result = $thisDb->fetchArtData(2); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>Price: $<?php echo $result["price"];?><br>Genre: Baroque";
					selectedArt = "The Night Watch";
				}
<?php unset($result); ?>
				function artwork3() {
					<?php $result = $thisDb->fetchArtData(3); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArt3()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["shortDescription"];?>  <br>Price: $<?php echo $result["price"];?>";
				}
<?php unset($result); ?>
				function showArt3() {
					<?php $result = $thisDb->fetchArtData(3); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>Price: $<?php echo $result["price"];?><br>Genre: Realism";
					selectedArt = "Third Class Carriage";
				}
<?php unset($result); ?>
				function artwork4() {
					<?php $result = $thisDb->fetchArtData(4); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArt4()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["shortDescription"];?>  <br>Price: $<?php echo $result["price"];?>";
				}
<?php unset($result); ?>
				function showArt4() {
					<?php $result = $thisDb->fetchArtData(4); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>Price: $<?php echo $result["price"];?><br>Genre: Landscape";
					selectedArt = "The Starry Night";
				}
<?php unset($result); ?>
				function artwork5() {
					<?php $result = $thisDb->fetchArtData(5); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArt5()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["shortDescription"];?>  <br>Price: $<?php echo $result["price"];?>";

				}
<?php unset($result); ?>
				function showArt5() {
					<?php $result = $thisDb->fetchArtData(5); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>Price: $<?php echo $result["price"];?><br>Genre: Abstract";
					selectedArt = "Guernica";
				}


					function artist1() {
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "Resources/raph.jpg";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist1()'> Raphael Sanzio da Urbino</span></a> </br> Description: Raffaello Sanzio da Urbino, known as Raphael, was an Italian painter and architect of the High Renaissance. His work is admired for its clarity of form, ease of composition, and visual achievement of the Neoplatonic ideal of human grandeur.";
				}

				function showArtist1() {
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "Resources/raph.jpg";
					document.getElementById("artDescription2").innerHTML = "Date of birth: 1483<br> deathof the artist: 1520<br> Place of his/her living: Urbino, Italy<br> Genres of his/her paintings(e.g. Gothic, Renaissance, Baroque, Pre-Modern, and Modern): Baroque, Renaissance<br> Famous of his/her piece of works: \"The School of Athens\", \"The Sistine Madonna\", \"The Marriage of the Virgin\"";
				}

				function artist2() {
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "Resources/vinci.jpg";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist2()'> Leonardo di ser Piero da Vinci</span></a> </br> Description: Leonardo di ser Piero da Vinci, more commonly Leonardo da Vinci or simply Leonardo, was an Italian Renaissance polymath whose areas of interest included invention, painting, sculpting, architecture.";
				}

				function showArtist2() {
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "Resources/vinci.jpg";
					document.getElementById("artDescription2").innerHTML = "Date of birth: 1452<br> Death of the artist: 1519<br> Place of his/her living: Anchiano, Italy<br> Genres of his/her paintings(e.g. Gothic, Renaissance, Baroque, Pre-Modern, and Modern): Renaissance<br> Famous of his/her piece of works: \"Mona Lisa\", \"The Last Supper\", \"St. John the Baptist\"";
				}

				function artist3() {
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src =  "Resources/rembrandt.jpg";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist3()'> Rembrandt Harmenszoon van Rjin</span></a> </br> Description:  was a Dutch draughtsman, painter, and printmaker. An innovative and prolific master in three media,[3] he is generally considered one of the greatest visual artists in the history of art and the most important in Dutch art history.";
				}

				function showArtist3() {
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "Resources/rembrandt.jpg";
					document.getElementById("artDescription2").innerHTML = "Date of birth: 1606<br> Death of the artist: 1669<br> Place of his/her living: Leiden, Netherlands<br> Genres of his/her paintings(e.g. Gothic, Renaissance, Baroque, Pre-Modern, and Modern): Baroque, Realism, Post-Impressionism<br> Famous of his/her piece of works: \"The Night Watch\", \"The Return of the Prodigal\", \"The Jewish Bride\"";
				}

				function artist4() {
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src =  "Resources/picasso.jpg";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist4()'> Pablo Picasso</span></a> </br> Description: Pablo Picasso was a Spanish painter, sculptor, printmaker, ceramicist, stage designer, poet and playwright who spent most of his adult life in France.";
				}

				function showArtist4() {
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "Resources/picasso.jpg";
					document.getElementById("artDescription2").innerHTML = "Date of birth: 1881<br> Death of the artist: 1973<br> Place of his/her living: Malaga, Spain<br> Genres of his/her paintings(e.g. Gothic, Renaissance, Baroque, Pre-Modern, and Modern): Cubism, Surrealism, Expressionism, Post=Post-Impressionism<br> Famous of his/her piece of works: \"Guernica\", \"Les Demoiselles d'Avignon\", \"The Old Guitarist\"";
				}

				function artist5() {
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src =  "Resources/angelo.jpg";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist5()'> Michelangelo</span></a> </br> Description: was an Italian sculptor, painter, architect and poet of the High Renaissance born in the Republic of Florence, who exerted an unparalleled influence on the development of Western art";
				}

				function showArtist5() {
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "Resources/angelo.jpg";
					document.getElementById("artDescription2").innerHTML = "Date of birth: 1475<br> Death of the artist: 1564<br> Place of his/her living: Caprese Michelangelo, Italy<br> Genres of his/her paintings(e.g. Gothic, Renaissance, Baroque, Pre-Modern, and Modern): High Renaissance, Italian Renaissance, Renaissance<br> Famous of his/her piece of works: \"Sistine Chapel ceiling\", \"The Last Judgment\", \"David\"";
				}




				function smallData(name) {
					document.getElementById("ArtSection").style.visibility = "visible";
					var artsrc = "";
					var description = "";
					/*Artist Switch*/
				}
				function showData(name) {
								document.getElementById("ArtSection").style.visibility = "visible";
								var artsrc = "";
								var description = "";
								/*Artist Switch*/
								
								/*Museum Switch*/
								switch (name){
									case "The Louvre":
										artsrc = "Resources/Louvre.jpg";
										description = "Description: The Louvre Palace is a former royal palace located on the Right Bank of the Seine in Paris, between the Tuileries Gardens and the church of Saint-Germain l'Auxerrois.";
										break;
									case "Metropolitan Museum of Art":
										artsrc = "Resources/met-museum.jpg";
										description = "Description: The Metropolitan Museum of Art of New York, colloquially 'the Met', is the largest art museum in the United States.";
										break;
									case "Hermitage Museum":
										artsrc = "Resources/hermitage.jpg";
										description = "Description: The State Hermitage Museum is a museum of art and culture in Saint Petersburg, Russia. The second largest in the world,";
										break;
									case "British Museum":
										artsrc = "Resources/british.jpg";
										description = "Description: The British Museum, located in the Bloomsbury area of London, United Kingdom, is a public institution dedicated to human history, art and culture.";
										break;
									case "Art Institute of Chicago":
										artsrc = "Resources/chicago.jpg";
										description = "Description: The Art Institute of Chicago, founded in 1879 and located in Chicago's Grant Park, is one of the oldest and largest art museums in the United States";
										break;
								}
								document.getElementById("artImage").src = artsrc;
								document.getElementById("info").innerHTML = description;
							}




			</script>
		
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
