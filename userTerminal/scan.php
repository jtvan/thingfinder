<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<h4>Item added.</h4>
	<form action="startScreen.php" method="get">
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

			while(! feof($file)){
				if(fgets($file) == $itemName){
					$itemExists = true;
					echo "Item exists, please select a different name.";
				}
			}
			fclose($file);
			
			if ($itemExists == false){
				
				file_put_contents ( $itemListPath , "\n" . $itemName , FILE_APPEND );
				//file upload stuff goes here 
					
			}
			else{
				echo $message;
			}


		
		}else{
		echo "no post";
		}
	?>
</body>
</html>
