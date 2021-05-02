<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="w3.css">
</head>

<body>
	<h4>Item Tracking:</h4>
	<img 
		<?php
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			// define variables and set to empty values
			$itemName = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  if (empty($_POST["itemName"])) {
				echo "src=\"null\" alt=\"Please select an item.\"";
			  } 
			  else 
			  {
				/*
				old demo line 
				$itemName=strval($_POST["itemName"]);
				$itemPath="../demoPictures/bounded";
				$itemExtension=".png";
				
				echo  "src=\"	". $itemPath .  $itemName . $itemExtension. "\" alt=\"". $itemPath. $itemName . $itemExtension."\"";
				*/

				//call the script to make the bounded image. Provide category, name, and temperature

				//wait and display image 

				//prompt user if image is correct or not? 
						//if correct, save the item to the corresponding directory 
						//if not, delete and show last item


			  }
			}
		?>
	>
	<br>
	<br>

	<form action="startScreen.php" method="get">
		<button type="submit">back</button>
	</form>
	
</body>
</html>
