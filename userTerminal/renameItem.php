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

	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$itemListPath = "/var/www/thingfinder/itemList.txt";
		
		$itemExists = false;
		
		if(isset($_POST["submit"])){
			$itemOldName = trim($_POST["itemName"]);
			
			$newName = trim($_POST["newName"]);
			
			//find if item exists in item list
			if(strpos(file_get_contents($itemListPath), $itemOldName) !== false){
				$itemExists = true;
			}
			
			//exit if we don't find the item in the list
			if ($itemExists == false){
				echo "Error, item doesn't exist.";
			}
			elseif (empty($newName)){ //exit if new name is bad
				echo "New name cannot be empty, item unchanged.";
			}
			else{	
				#process renamed name
				$separatedName = explode(":", $itemOldName);

				$itemCategory = $separatedName[1];

				$fullNewName = $newName . ":" . $itemCategory;

				$imgDirectory = "/var/www/thingfinder/itemImages/" . $itemOldName . "/";
				
				$newImgDirectory = "/var/www/thingfinder/itemImages/" . $fullNewName . "/";
				
				//remove item from list
				$DELETE = $itemOldName;

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

				
				//add new name to item list
				file_put_contents($itemListPath, $fullNewName,FILE_APPEND);

				//move folder
				rename($imgDirectory, $newImgDirectory);

				echo "Item successfully renamed";
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
