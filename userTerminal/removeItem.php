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
		
		$imgDirectory = "/var/www/thingfinder/itemImages/" . $itemName . "/";
		
		if(isset($_POST["submit"])){
			$itemName = $_POST["itemName"];
			
			$file = fopen($itemListPath,"r");

			while(! feof($file)){
				if(fgets($file) == $itemName){
					$itemExists = true;
				}
			}
			fclose($file);
			
			if($itemExists == true){
				$contents = file_get_contents($itemListPath);
				$contents = str_replace($itemName, '', $contents);
				file_put_contents($itemListPath, $contents);
				
				
				//delete saved images
				array_map('unlink', glob("$imgDirectory/*.*"));
				rmdir($imgDirectory);
			}
			if ($itemExists == false){
				echo "Error, item doesn't exist.";
					
			}
		
		}else{
		echo "no post";
		}
	?>
</body>
</html>
