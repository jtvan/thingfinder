<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<form action="scan.php" method="post">
		<h4>Register a new item for tracking:</h4> 
		<br>
		<label for="itemName">Name the item:</label>
		<input type="text" id="itemName" name="itemName" required>
		<br><br>
		
		<img src="demoPictures/takeImage.jpg" alt="Live feed of system camera." width="200" height="200">
		<br>
		
		<label for="img">Select image(s):</label>
		<input type="file" id="img" name="img" accept="image/*">

		<br>
		<br>

		<script>
			function confirmSelection() {
			  var txt;
			  var r = confirm("Are you sure?");
			  if (r == true) {
				txt = "New item added.";
			  } else {
				txt = "You cancelled.";
			  }
			  document.getElementById("confirmResult").innerHTML = txt;
			}
		</script>
		
		<p1 id="confirmResult"></p1><br>
		

		<button onclick="confirmSelection()" name="submit" type="submit">Finalize New Item</button>
	</form>

	<form action="startScreen.php" method="get">
		<button type="submit">Back</button>
	</form>
		
</body>
</html>
