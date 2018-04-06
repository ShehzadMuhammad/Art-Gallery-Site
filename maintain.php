<html>
	<head>
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<form>
			<select id="tableSelect" name="table">
				<option value="" selected="selected"></option>
				<option value="artists">artists</option>
				<option value="artworks">artworks</option>
				<option value="museums">museums</option>
				<option value="images">images</option>
				<option value="genres">genres</option>
				<option value="subjects">subjects</option>
				<option value="shoppingcart">shoppingcart</option>
				<option value="reviews">reviews</option>
			</select>
		</form>
		<div>
			<form id="artists" style="display:none">
				
			</form>
			<form id="artworks" style="display:none">
				
			</form>
			<form id="museums" style="display:none">
				
			</form>

			<form id="images" style="display:none">
				
			</form>

			<form id="genres" style="display:none">
				
			</form>

			<form id="subjects" style="display:none">
				
			</form>

			<form id="museums" style="display:none">
				
			</form>
			<form id="threeFields">
				<div id="fieldSection">

				</div>
				<p id="doot">
				</p>
			</form>
		</div>
		<script>
			$("#tableSelect").on("change", function() {
				var x = $(this).val();
				selectTable(x);


			});
			function selectTable(table){
				var numFields = 0;
				//var fieldDiv = document.getElementById("fieldSection");
				//while (fieldDiv.firstChild) {
				//	fieldDiv.removeChild(fieldDiv.firstChild);
				//}
				document.getElementById("fieldSection").innerHTML="";
				switch(table){
					case "images": break;
					case "artists": case "shoppingcart": case "reviews": numFields = 3; break;
					case "artworks": numFields = 6; break;
					case "museums": numFields = 4; break;;
					case "genres": case "subjects": numFields =1; break;
					
					//document.getElementById("fieldSection").innerHTML 

				}
				for(var i = 0; i < numFields; i++){
					var fieldName = document.createElement("input");
					fieldName.type="text";
					fieldName.name="f" + i;

					var value = document.createElement("input");
					value.type="text";
					value.name="v" + i;
					document.getElementById("fieldSection").appendChild(document.createTextNode("Field #" + i));
					document.getElementById("fieldSection").appendChild(document.createElement("br"));
					document.getElementById("fieldSection").appendChild(document.createTextNode("Column Name"));
					document.getElementById("fieldSection").appendChild(fieldName);
					document.getElementById("fieldSection").appendChild(document.createTextNode("Column Value"));
					document.getElementById("fieldSection").appendChild(value);
					document.getElementById("fieldSection").appendChild(document.createElement("br"));

				}
				//$("#" + $(this).val()).show().siblings().hide();
				//$("#tableSelect").show();
				//document.getElementById('a').innerHTML="nope";
			}

		</script>
	</body>
</html>