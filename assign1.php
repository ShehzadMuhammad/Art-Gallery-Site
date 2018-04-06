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
				function searchBarArt(name){
					var imagePath = "";
					switch(name){
						<?php
							$allArtworks = $thisDb->loadAllArtworks();
							while($row = $allArtworks->fetch_assoc()) {
								$name = $row['name'];
								$path = $row['imagePath'];
								echo "case \"$name\": imagePath = \"$path\"; break;\n";
							}
						?>

					}
					if(imagePath != ""){
						return [name, imagePath];
					}
					
				}

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
					if(details["name"] == "Mona Lisa") details["price"] = 800000000;
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
					/*var nameText = document.createNode('input');
					nameText.type="text";
					nameText.value=details["name"];
					nameText.name="name";
					document.getElementById("modalForm").appendChild(nameText);
					var priceValue = document.createNode('input');
					priceValue.type="number";
					priceValue.value=details["price"];
					priceValue.name="price";
					document.getElementById("modalForm").appendChild(priceValue);*/
					//document.getElementById("modalForm")
					var request = $.ajax({
						type: "POST",
						url: "shoppingcart.php",
						data: {name: dynamicName.value, quantity: quantity.value, shipping: details["shipping"]},
					    dataType: "html"
					});
					request.fail(function(jqXHR, textStatus) {
						alert( "Request failed: " + textStatus );
					});
					
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
					//document.getElementById('dynamicPaintingName').style.visibility='hidden';
					//document.getElementById('selectedPaintingName').innerHTML = selectedArt;
					document.getElementById('staticPaintingName').style.visibility='hidden';
					document.getElementById('dynamicPaintingName').style.visibility='visible';
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
					document.getElementById("dynamicPaintingName").value="<?php echo $result["name"];?>";
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
					document.getElementById("dynamicPaintingName").value="<?php echo $result["name"];?>";
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
					document.getElementById("dynamicPaintingName").value="<?php echo $result["name"];?>";
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
					document.getElementById("dynamicPaintingName").value="<?php echo $result["name"];?>";
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
					document.getElementById("dynamicPaintingName").value="<?php echo $result["name"];?>";
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>Price: $<?php echo $result["price"];?><br>Genre: Abstract";
					selectedArt = "Guernica";
				}
					function artist1() {
					<?php $result = $thisDb->fetchArtistData(1); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist1()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["information"];?>";
				}
				function showArtist1() {
					<?php $result = $thisDb->fetchArtistData(1); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["facts"];?>";
				}
				function artist2() {
					<?php $result = $thisDb->fetchArtistData(2); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist2()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["information"];?>";
				}
				function showArtist2() {
					<?php $result = $thisDb->fetchArtistData(2); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["facts"];?>";
				}
				function artist3() {
					<?php $result = $thisDb->fetchArtistData(1); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist3()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["information"];?>";
				}
				function showArtist3() {
					<?php $result = $thisDb->fetchArtistData(3); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["facts"];?>";
				}
				function artist4() {
					<?php $result = $thisDb->fetchArtistData(4); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist4()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["information"];?>";
				}
				function showArtist4() {
					<?php $result = $thisDb->fetchArtistData(4); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["facts"];?>";
				}
				function artist5() {
					<?php $result = $thisDb->fetchArtistData(5); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showArtist5()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["information"];?>";
				}
				function showArtist5() {
					<?php $result = $thisDb->fetchArtistData(5); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["facts"];?>";
				}
				
				function museum1() {
					<?php $result = $thisDb->fetchMuseumData(1); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showMuseum1()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result['shortDescription'];?>";
				}
				function showMuseum1() {
					<?php $result = $thisDb->fetchMuseumData(1); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result['longDescription'];?>";
				}
					function museum2() {
					<?php $result = $thisDb->fetchMuseumData(2); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showMuseum2()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["shortDescription"];?>";
				}
				function showMuseum2() {
					<?php $result = $thisDb->fetchMuseumData(2); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>";
				}
				function museum3() {
					<?php $result = $thisDb->fetchMuseumData(3); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showMuseum3()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["shortDescription"];?>";
				}
				function showMuseum3() {
					<?php $result = $thisDb->fetchMuseumData(3); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>";
				}
				function museum4() {
					<?php $result = $thisDb->fetchMuseumData(4); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showMuseum4()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["shortDescription"];?>";
				}
				function showMuseum4() {
					<?php $result = $thisDb->fetchMuseumData(4); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>";
				}

				function museum5() {
					<?php $result = $thisDb->fetchMuseumData(5); ?>
					document.getElementById("ArtSection").style.visibility = "visible";
					document.getElementById("ArtSection2").style.visibility = "hidden";
					document.getElementById("artImage").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription").innerHTML = "Name: <a><span onClick='showMuseum5()'><?php echo $result["name"];?></span></a> </br> Description: <?php echo $result["shortDescription"];?>";
				}
				function showMuseum5() {
					<?php $result = $thisDb->fetchMuseumData(5); ?>
					document.getElementById("ArtSection").style.visibility = "hidden";
					document.getElementById("ArtSection2").style.visibility = "visible";
					document.getElementById("artImage2").src = "<?php echo $result["imagePath"];?>";
					document.getElementById("artDescription2").innerHTML = "<?php echo $result["longDescription"];?>";
				}
					
				function showSearch() {
				    document.getElementById("search").style.visibility ="visible";

				}

				function doSearch() {
					document.getElementById("SearchResults").style.visibility = "visible";
					var textVal = document.getElementById("seeName").value;
					var x = searchBarArt(textVal);
					document.getElementById('searchName').innerHTML = x[0];
					document.getElementById('searchImage').src=x[1];


				}
				function maintainWindow(){
					window.open("maintain.php", "my popups");
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

			<a style="text-decoration: none" href="#" onclick="showSearch()">
			
					<button>Search</button>

			</a>
			<a style="text-decoration: none" href="#" onclick="maintainWindow()">
			
					<button>Maintain</button>

			</a>
			<div id="search"  style="visibility: hidden; float: right;">
				<br>
				<input type="text" id="seeName">
				<button onclick="doSearch()">Submit</button>&nbsp;&nbsp;&nbsp;
			</div>
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
				<a href="#" onclick="museum1()">The Louvre</a>
				<a href="#" onclick="museum2()">Metropolitan Museum of Art</a>
				<a href="#" onclick="museum3()">Hermitage Museum</a>
				<a href="#" onclick="museum4()">British Museum</a>
				<a href="#" onclick="museum5()">Art Institute of Chicago</a>
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

		<div id="SearchResults" style="visibility: hidden;">
			<div id="searchStuff">
				<p id="searchName"></p>
				<img id="searchImage" src="" width="200px" height="200px">
			</div>
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
						<!--<form id="modalForm" onsubmit="setPurchase()" action="shoppingcart.php" method="POST">-->
						<form id="modalForm" onsubmit="setPurchase()" >
							Painting:
							<div id="staticPaintingName">
								<p id="selectedPaintingName"></p>
							</div>
							<div >
								<select id="dynamicPaintingName" name="name">
									<option value="The Starry Night">The Starry Night</option>
									<option value="The Night Watch">The Night Watch</option>
									<option value="Third Class Carriage">Third Class Carriage</option>
									<option value="Guernica">Guernica</option>
									<option value="Mona Lisa">Mona Lisa</option>
								</select>
							</div>
							<br />
							<br />
							Quantity: <input type="number" id="purchaseQuantity" name="quantity" min="1" max="5" value="0">
							<br />
							Shipping Plan: <br/>
							<input id="ship1" type="radio" name="shipping" value="4.99" checked>Standard (2-3 weeks): $4.99 <br/>
							<input id="ship2" type="radio" name="shipping" value="14.99">Express (2-5 days): $14.99 <br/>
							<input id="ship3" type="radio" name="shipping" value="39.99">Next Day: $39.99 <br />
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