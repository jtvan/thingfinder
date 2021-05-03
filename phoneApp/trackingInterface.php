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
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header("location: login.php");
			exit;
		}

	?>

	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		// define variables and set to empty values
		$itemName = "";

		

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["itemName"])) {
				echo "Please select an item.<br>";
				echo '
					<br>
					<br>	
					<form action="startScreen.php" method="get">
						<button type="submit">Back</button>
					</form>';
			} 
			else 
			{
				//call the script to make the bounded image. Provide category, name, and temperature

				#get the item category
				$itemName=trim(strval($_POST["itemName"]));
				$separatedName = explode(":", $itemName);

				$itemCategory = "\"". trim($separatedName[1]) . "\"";
				$cameraFeedPath = "\"" . "/media/sf_capturephoto/photo.jpg" . "\"";
				$prefThreshold = "0.65";
				$weightPath = "\"" . "/var/www/thingfinder/yolov3.weights".  "\"";
				$outputPath = "\"" . "/var/www/thingfinder/result.png".  "\"";

				$imageSource = "\"" . "/var/www/thingfinder/pic.jpg".  "\"";


				copy("/media/sf_capturephoto/photo.jpg","/var/www/thingfinder/pic.jpg");

				set_time_limit (60 );

				$command = "/usr/bin/python3 /var/www/thingfinder/findObject.py " . $imageSource . " " . $itemCategory . " " . $prefThreshold . " " . $weightPath. " " .	$outputPath ." 2>&1";

				exec($command, $out, $status);


				//testing stuff
				/*echo $command;

				echo "<br><br>";
				
				foreach ($out as $line) {
					echo $line . "<br><br>";
				} 
			
				echo $status;*/

				
				$result = end($out);

			}
			//rania URL for JSON integration
			$ch = curl_init('http://rania-env.eba-zymia96u.us-east-2.elasticbeanstalk.com/');

			//create JSON object
			if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
				$JSON_Obj = array(
					'timeStamp' => date('D-m-h:i:s',time()),
					'deviceName' => 'ThingFinder',
					'patientName' => $_SESSION['username'],
					'Priority' => 'low',
					'Message' => $itemName.' Location Requested'
				);
			}

			//sending JSON 
			$Request_Data = json_encode($JSON_Obj);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $Request_Data);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$Curl_Out = curl_exec($ch);
			curl_close($ch);
		}
		else{echo "NO POST ERROR";}
	?>
	
	<img src="../result.png" alt="Loading" height=600>
	<br>
	<?php
		$imgDirectory = "/var/www/thingfinder/itemImages/" . $itemName . "/";
		$lastResult = $imgDirectory . "latest.png";

		if($result == "False"){
			echo "Sorry, we could not locate your item.<br>";
			//if it exists, show the most recent location
			if(file_exists($lastResult)== true){
				echo "This is our last recorded location of " . $separatedName[0] . ".<br>";
				$picPath = 'src="/itemImages/' . $itemName . '/latest.png"'; 
				echo '<img ' . $picPath . ' alt="oops" height=600><br>';
				
			}
			else{
				echo "Currently, your " . $separatedName[0] . " has never been seen by Thing Finder.";
			}
			echo '
			<br>
			<br>	
			<form action="startScreen.php" method="get">
				<button type="submit">Back</button>
			</form>';
		}
		//else, is this your item? if yes -> save/move the photo, else delete it 
		else{
			echo "Is this your " . $separatedName[0] . "?";	
			echo '<br>
			<br>	
			<form action="saveResult.php" method="post">
				<button type="submit" name="submit" id="submit">Yes, record this result.</button>
				<input type="hidden" name="itemName" id="itemName" value='.$itemName.'/>
			</form>;
			<form action="startScreen.php" method="get">
				<button type="submit">No, do not record result.</button>
			</form>';
			
		}
	?>

</body>
</html>
