<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<h4>Item removed.</h4>
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
			
			$file = fopen($itemListPath,"r");
			
			
			$imgDirectory = "/var/www/thingfinder/itemImages/" . $itemName . "/";

			//find if item exists in item list
			while(! feof($file)){
				$currentLine = fgets($file);
				if(strpos($currentLine, $itemName ) !== false){
					$itemExists = true;
				}
			}
			fclose($file);
			
			if($itemExists == true){
				//remove item from list
				$contents = file_get_contents($itemListPath);
				$contents = str_replace($fullItemName, '', $contents);
				file_put_contents($itemListPath, $contents);
				
				
				//delete saved images
				array_map('unlink', glob("$imgDirectory/*.*"));
				rmdir($imgDirectory);
			}
			if ($itemExists == false){
				echo "Error, item doesn't exist.";
			}
		
		}else{
		echo "No post error.";
		}
	?>
</body>
</html>
