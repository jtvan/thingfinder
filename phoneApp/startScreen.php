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
	<!-- Old button, removed due to time constaints 
	<form action="menu.php" method="get">
		<button type="submit">Menu</button>
	</form>
	
	<form action="notifications.php" method="get">
		<button type="submit">Notifications</button>
	</form>
	-->
	<!-- Old button, removed due to time constaints 
	<form action="camerafeed.php" method="get">
		<button type="submit">Camera Feed</button>
	</form>
	-->

	<br><br>
	
	<p2>Please select an item to track:<p2>
	<br>
	<form action="trackingInterface.php" method="POST">
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


		<button type="submit">Find Item</button>
	</form>

	</form>
	
</body>
</html>
