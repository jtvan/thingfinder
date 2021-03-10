<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<h4>Live feed of camera goes here. User takes pictures of the item from multiple angles.</h4>
	<img src="demoPictures/takeImage.jpg" alt="Live feed of system camera." width="200" height="200">
	<br>
	<button>Take Image</button>
	
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

	<button onclick="confirmSelection()">Finalize New Item</button>


	<form action="startScreen.php" method="get">
		<button type="submit">Back</button>
	</form>
</body>
</html>
