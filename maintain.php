<html>
	<head>
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<form id="QueryForm" method="POST" action="">
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
				document.getElementById("fieldSection").innerHTML="";
				
				$("#tableSelect").off();
				//If they choose to add to database, activate the listener for 
				if(x ==""){
					$("#tableSelect").hide();
				}else{
					$("#tableSelect").show();
				}
				if(x == "add"){
					$("#tableSelect").on("change", function() {
						var x = $(this).val();
						selectTableAdd(x);


					});
				}else if(x == "delete"){
					$("#tableSelect").on("change", function() {
						var x = $(this).val();
						selectTableDelete(x);


					});
				}else if(x == "modify"){
					$("#tableSelect").on("change", function() {
						var x = $(this).val();
						selectTableModify(x);


					});
				}



			});
			function selectTableDelete(table){
				var numFields = 0;
				document.getElementById("fieldSection").innerHTML="";
				document.getElementById("fieldSection").appendChild(document.createTextNode("Please insert conditions for deleting. Ex: \"artId=1 and name=\'Mona Lisa\'\""));
				document.getElementById("fieldSection").appendChild(document.createElement("br"));
				var query = document.createElement("input");
				query.type="text";
				query.name="deleteQuery";
				document.getElementById("fieldSection").appendChild(query);
				document.getElementById("QueryForm").action="delete.php";
				document.getElementById("fieldSection").appendChild(document.createElement("br"));
				var submit = document.createElement("input");
				submit.type="submit";
				submit.value="Execute Query";
				document.getElementById("fieldSection").appendChild(submit);
				document.getElementById("fieldSection").appendChild(document.createElement("br"));
				var schema = document.createElement("IMG");
				schema.src = "Resources/" + table + "Schema.png";
				document.getElementById("fieldSection").appendChild(schema);



			}
			function selectTableModify(table){
				var numFields = 0;
				document.getElementById("fieldSection").innerHTML="";
				document.getElementById("fieldSection").appendChild(document.createTextNode("Please insert conditions for updating. Ex: Fields to update: \"name=\'Shmoobly\'\"  Conditions: \"name=\'Mona Lisa\'\""));
				document.getElementById("fieldSection").appendChild(document.createElement("br"));
				document.getElementById("fieldSection").appendChild(document.createTextNode("SET"));
				var fields = document.createElement("input");
				fields.type="text";
				fields.name="updateQueryFields";
				document.getElementById("fieldSection").appendChild(fields);
				document.getElementById("fieldSection").appendChild(document.createTextNode("WHERE"));
				var conditions = document.createElement("input");
				conditions.type="text";
				conditions.name="updateQueryConditions";
				document.getElementById("fieldSection").appendChild(conditions);
				document.getElementById("QueryForm").action="modify.php";
				document.getElementById("fieldSection").appendChild(document.createElement("br"));
				var submit = document.createElement("input");
				submit.type="submit";
				submit.value="Execute Query";
				document.getElementById("fieldSection").appendChild(submit);
				document.getElementById("fieldSection").appendChild(document.createElement("br"));
				var schema = document.createElement("IMG");
				schema.src = "Resources/" + table + "Schema.png";
				document.getElementById("fieldSection").appendChild(schema);
			}
			function selectTableAdd(table){
				var numFields = 0;
				document.getElementById("fieldSection").innerHTML="";
				switch(table){
					case "images":
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
				document.getElementById("QueryForm").action="add.php";
				document.getElementById("fieldSection").appendChild(document.createElement("br"));
				var submit = document.createElement("input");
				submit.type="submit";
				submit.value="Execute Query";
				document.getElementById("fieldSection").appendChild(submit);
				document.getElementById("fieldSection").appendChild(document.createElement("br"));
				var schema = document.createElement("IMG");
				schema.src = "Resources/" + table + "Schema.png";
				document.getElementById("fieldSection").appendChild(schema);
			}

		</script>
	</body>
</html>