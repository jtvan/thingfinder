<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<?php
	
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$itemListPath = "/var/www/thingfinder/itemList.txt";
		
		$itemExists = false;
		$message = "";
		

		
		if(isset($_POST["submit"])){
			$itemName = trim($_POST["itemName"]);		
			
			$imgDirectory = "/var/www/thingfinder/itemImages/" . $itemName . "/";

			//find if item exists in item list
			if(strpos(file_get_contents($itemListPath), $itemName) !== false){
				$itemExists = true;
			}

			if($itemExists == true){
				//remove item from list
				$DELETE = $itemName;

				$data = file($itemListPath);

				$out = array();

				foreach($data as $line) {
				 if(trim($line) != $DELETE) {
					 $out[] = $line;
				 }
				}

				$fp = fopen($itemListPath, "w+");
				flock($fp, LOCK_EX);
					foreach($out as $line) {
					fwrite($fp, $line);
					}
				flock($fp, LOCK_UN);
				fclose($fp);  
				
				
				//delete saved images
				array_map('unlink', glob("$imgDirectory/*.*"));
				rmdir($imgDirectory);
				
				echo "Successfully removed " . $itemName ."!";
			}
			if ($itemExists == false){
				echo "Error, item doesn't exist.";
			}
		
		}else{
		echo "No post error.";
		}
	?>
	<form action="modifyItem.php" method="get">
		<button type="submit">Back</button>
	</form>
</body>
</html>
