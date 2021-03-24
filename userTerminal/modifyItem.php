<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="w3.css">
</head>

<body>
	<h4>Select an item from the list to modify.</h4>

	<br>

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
	<br>
	<form action ="renameItem.php" method ="post">
		<select name="itemName" size="10">
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
		<input type="text" id="newName" name="newName">
		<button name="submit" type="submit">Rename Item</button>
	</form>
	<br>
	<form action ="removeItem.php" method ="post">
			<select name="itemName" size="10">
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
		<button onclick="confirmRemoval()" name="submit" type="submit">Confirm Item Removal</button>
	</form>

	<br>

	<p id="removalResult"></p>

	<br>

	<form action="startScreen.php" method="get">
		<button type="submit">Back</button>
	</form>
</body>
</html>
