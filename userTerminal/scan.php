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

	<br>
	<?php
	
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$itemListPath = "/var/www/thingfinder/itemList.txt";
		

		$availableCategories = array("person", "bicycle", "car", "motorbike", "aeroplane", "bus", "train", "truck",
		"boat", "traffic light", "fire hydrant", "stop sign", "parking meter", "bench",
		"bird", "cat", "dog", "horse", "sheep", "cow", "elephant", "bear", "zebra", "giraffe",
		"backpack", "umbrella", "handbag", "tie", "suitcase", "frisbee", "skis", "snowboard",
		"sports ball", "kite", "baseball bat", "baseball glove", "skateboard", "surfboard",
		"tennis racket", "bottle", "wine glass", "cup", "fork", "knife", "spoon", "bowl", "banana",
		"apple", "sandwich", "orange", "broccoli", "carrot", "hot dog", "pizza", "donut", "cake",
		"chair", "sofa", "pottedplant", "bed", "diningtable", "toilet", "tvmonitor", "laptop", "mouse",
		"remote", "keyboard", "cell phone", "microwave", "oven", "toaster", "sink", "refrigerator",
		"book", "clock", "vase", "scissors", "teddy bear", "hair drier", "toothbrush");

		$itemExists = false;
		$message = "";
		
		if(isset($_POST["submit"])){
			$itemName = trim($_POST["itemName"]);
			$itemCategory = trim($_POST["itemCate"]);
			
			//used for item removal and such
			$itemCompoundName = $itemName . ":" . $itemCategory;
			
			
			$file = fopen($itemListPath,"r");

			while(! feof($file)){
				if(fgets($file) == $itemCompoundName){
					$itemExists = true;
					echo "Item exists, please select a different name.";
				}
			}
			fclose($file);
			
			if ($itemExists == false){
				if(in_array($itemCategory, $availableCategories) == true){
					//add item to list
					file_put_contents ( $itemListPath , $itemCompoundName . "\n", FILE_APPEND );
					
					$itemPictureDirPath = "/var/www/thingfinder/itemImages/" . $itemCompoundName . "/";
					
					mkdir($itemPictureDirPath, 0700);
					
					
					//FILE UPLOAD STUFF BEGINS
					$target_dir = $itemPictureDirPath;
					$target_file = $target_dir . basename($_FILES["img"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					// Check if image file is a actual image or fake image
					if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["img"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.\n";
						$uploadOk = 0;
					}
					}

					// Check if file already exists
					if (file_exists($target_file)) {
					echo "Sorry, file already exists.\n";
					$uploadOk = 0;
					}

					// Check file size
					if ($_FILES["img"]["size"] > 5000000) {
					echo "Sorry, your file is too large.\n";
					$uploadOk = 0;
					}

					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
					$uploadOk = 0;
					}

					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.\n";
					// if everything is ok, try to upload file
					} else {
					if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
						echo "The file ". htmlspecialchars( basename( $_FILES["img"]["name"])). " has been uploaded.\n";
					} else {
						echo "Sorry, there was an error uploading your file.\n";
					}
					}
				}
				else echo "Sorry, ". $itemCategory . " is not currently a trackable category. Please select a different category.";
			}
			else{
				echo "Sorry, an item of that name already exists.\n";
			}


		
		}else{
		echo "No post error.";
		}
	?>
	<br><br>
	<form action="startScreen.php" method="get">
		<button type="submit">Back</button>
	</form>
</body>
</html>
