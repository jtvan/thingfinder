<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="w3.css">
</head>

<body>
	<h2>Item Tracking:</h2>
	
	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		// define variables and set to empty values
		$itemName = "";

		//rania URL for JSON integration
		$ch = curl_init('http://rania-env.eba-zymia96u.us-east-2.elasticbeanstalk.com/');
		
		$data = array(
			'timeStamp' => time(),
			'deviceName' => 'ThingFinder',
			'patientName' => $_SESSION['username'],
			'Priority' => 'low',
			'Message' => 'Item Location Requested'
		);

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


			#get the item category
			$itemName=trim(strval($_POST["itemName"]));
			$separatedName = explode(":", $itemName);

			$itemCategory = "\"". trim($separatedName[1]) . "\"";
			$cameraFeedPath = "\"" . "/home/thingfinder/Desktop/Testing Pictures/IMG_20210426_161131.jpg" . "\"";
			$prefThreshold = "0.65";
			$weightPath = "\"" . "/var/www/thingfinder/yolov3.weights".  "\"";
			$outputPath = "\"" . "/var/www/thingfinder/result.png".  "\"";

			set_time_limit (60 );

			$command = "/usr/bin/python3 /var/www/thingfinder/findObject.py " . $cameraFeedPath . " " . $itemCategory . " " . $prefThreshold . " " . $weightPath. " " .	$outputPath ." 2>&1";

			exec($command, $out, $status);


			//testing stuff
			/*echo $command;

			echo "<br><br>";
			
			foreach ($out as $line) {
				echo $line . "<br><br>";
			} 
		
			echo $status;*/

			
			$result = end($out);




			
			//wait and display image 

			//prompt user if image is correct or not? 
					//if correct, save the item to the corresponding directory 
					//if not, delete and show last item


			}
		}
		else{echo "yeeee";}
	?>
	<h3>
		<?php
			if($result == "False"){
				echo "We could not locate your item.";
				//if it exists, show the most recent location

			}
			//else, is this your item? if yes -> save/move the photo, else delete it 

		?>
	</h3>


	<img src="../result.png" alt="Loading">

	<br>
	<br>

	<form action="startScreen.php" method="get">
		<button type="submit">back</button>
	</form>
	
</body>
</html>
