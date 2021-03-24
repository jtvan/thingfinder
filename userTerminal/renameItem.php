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
			
			$file = fopen($itemListPath,"r");

			while(! feof($file)){
				if(fgets($file) == $itemName){
					$itemExists = true;
				}
			}
			fclose($file);
			

			
			
			if ($itemExists == false){
				echo "Error, item doesn't exist.";
					
			}
			else{	
				$contents = file_get_contents($itemListPath);
				$contents = str_replace($itemName, $newName, $contents);
				file_put_contents($itemListPath, $contents);
			}
		
		}else{
		echo "no post";
		}
	?>
</body>
</html>
