<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="w3.css">
</head>
	
<body>
	<h4>Welcome Username!</h4>
	<br>
	
	<form action="login.php" method="get">
		<button type="submit">Logout</button>
	</form>
	<form action="menu.php" method="get">
		<button type="submit">Menu</button>
	</form>
	<form action="notifications.php" method="get">
		<button type="submit">Notifications</button>
	</form>
	
	<br><br>
	<p2>Please select an item:<p2>
	<br>
	<select name="itemList" size="10">
		<option value="item1">Item 1</option>
		<option value="item2">Item 2</option>
		<option value="item3">Item 3</option>
	</select>
	<?php
		// Open the file
		// $filename = "../itemList.txt";
		// $fp = @fopen($filename, 'r'); 

		// Add each line to an array
		// if ($fp) {
		// $array = explode("\n", fread($fp, filesize($filename)));
		// }
	?>
	<form action="trackingInterface.php" method="get">
		<input type="submit">
	</form>

	</form>
	
</body>
</html>
