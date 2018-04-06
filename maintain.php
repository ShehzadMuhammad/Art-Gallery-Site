<html>
	<head>
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<form>
		<select id="mode" name="mode">
			<option value="" selected="selected"></option>
				<option value="add">add</option>
				<option value="delete">delete</option>
				<option value="modify">modify</option>
		</select>
		
			<select id="tableSelect" name="table" style="display: none;">
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
		
			<div id="fieldSection">

			</div>
		</form>
		<script>
			$("#mode").on("change", function() {
				var x = $(this).val();
				$("#tableSelect").show();
				$("#tableSelect").off();
				//If they choose to add to database, activate the listener for 
				if(x == "add"){
					$("#tableSelect").on("change", function() {
						var x = $(this).val();
						selectTableAdd(x);


					});
				}else if(x == "delete"){

				}else if(x == "modify"){

				}



			});
			
			function selectTableAdd(table){
				var numFields = 0;
				document.getElementById("fieldSection").innerHTML="";
				switch(table){
					case "images": break;
					case "artists": case "shoppingcart": case "reviews": numFields = 3; break;
					case "artworks": numFields = 6; break;
					case "museums": numFields = 4; break;;
					case "genres": case "subjects": numFields =1; break;
					

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