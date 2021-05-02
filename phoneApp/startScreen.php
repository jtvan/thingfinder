<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="w3.css">
</head>
	
<body>


<?php
	//remove previous results

	$lastResult = "/var/www/thingfinder/result.png" ;
	if(file_exists($lastResult)== true){
		unlink($lastResult);
	}
?>

	<h2>What can we help you find, <?php
		// Initialize the session
		session_start();
		
		// Check if the user is logged in, otherwise redirect to login page
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header("location: login.php");
			exit;
		}
		else{
			echo $_SESSION["username"];
		}
	?>?</h2>
	<!-- Old button, removed due to time constaints 
	<form action="menu.php" method="get">
		<button type="submit">Menu</button>
	</form>
	
	<form action="notifications.php" method="get">
		<button type="submit">Notifications</button>
	</form>
	-->
	<!-- Old button, removed due to time constaints 
	<form action="camerafeed.php" method="get">
		<button type="submit">Camera Feed</button>
	</form>
	-->

	<br>
	
	<h3>Please select an item to track:<h3>
	<form action="trackingInterface.php" method="POST">
		<select name="itemName" size="10">
			<?php
				$file = fopen("../itemList.txt","r");
				while(! feof($file))
				{
					$current = fgets($file);
					echo "<option value=\"" . $current . "\">" . $current . "</option>";
				}

				fclose($file);
			?>
		</select>
		<br>


		<button type="submit">Find Item</button>
	</form>

	<br><br><br>
	<form action="logout.php" method="get">
		<button type="submit">Logout</button>
	</form>
	
	
</body>
</html>
