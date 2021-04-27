<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<h4>Item renamed.</h4>
	<form action="modifyItem.php" method="get">
		<button type="submit">Back</button>
	</form>
	<?php
	
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$itemListPath = "/var/www/thingfinder/itemList.txt";
		
		$itemExists = false;
		$message = "";
		
		if(isset($_POST["submit"])){
			$itemName = $_POST["itemName"];
			$newName = $_POST["newName"];
			
			$imgDirectory = "/var/www/thingfinder/itemImages/" . $itemName . "/";
			$newImgDirectory = "/var/www/thingfinder/itemImages/" . $newName . "/";
			
			$file = fopen($itemListPath,"r");

			$fullItemName = "";

			//find if item exists in item list
			while(! feof($file)){
				$currentLine = fgets($file);
				if(strpos($currentLine, $itemName . " : " ) !== false){
					$itemExists = true;
					$fullItemName = $currentLine;
				}
			}
			
			
			if ($itemExists == false){
				echo "Error, item doesn't exist.";
					
			}
			else{	
				$contents = file_get_contents($itemListPath);
				$contents = str_replace($itemName, $newName . "\n", $contents);
				file_put_contents($itemListPath, $contents);
				
				rename($imgDirectory, $newImgDirectory);
			}
		
		}else{
		echo "No post error.";
		}
	?>
</body>
</html>
