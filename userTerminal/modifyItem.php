<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="w3.css">
</head>

<body>

	<?php
		// Initialize the session
		session_start();
		
		// Check if the user is logged in, otherwise redirect to login page
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["permission"]) || $_SESSION["permission"] != "x"){
			header("location: login.php");
			exit;
		}
	?>
	
	<h3>Select an item from the list to modify.</h3>

	<script>
		function confirmRemoval() {
		  var txt;
		  var r = confirm("Are you sure you want to remove the item?");
		  if (r == true) {
			txt = "You removed the item.";
		  } else {
			txt = "You cancelled item removal.";
		  }
		  document.getElementById("removalResult").innerHTML = txt;
		}
	</script>

	<br>

	<h4>Item list:</h4>
	<form  method ="post">
		<select name="itemName" size="10" style="min-width: 300px;font-size: 18px;">
		<?php
			//TODO get item list dynamically
			$file = fopen("../itemList.txt","r");
			while(! feof($file))
			{
				$current = fgets($file);
				echo "<option value=\"" . $current . "\">" . $current . "</option>";
			}

			fclose($file);
		?>
		</select>
		<br>
		<br>
		<input type="text" id="newName" name="newName" placeholder="Enter new item name:">
		<button name="submit" type="submit" formaction ="renameItem.php">Rename Item</button>
		<br>
		<br>
		<button onclick="confirmRemoval()" name="submit" type="submit" formaction ="removeItem.php">Remove Item</button>
	</form>
	<br>
	

	<br>

	<p id="removalResult"></p>

	<br>

	<form action="startScreen.php" method="get">
		<button type="submit">Back</button>
	</form>
</body>
</html>
