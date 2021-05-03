<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<h4>Check for Updates</h4>
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
        $command = "/usr/bin/git -C /var/www/thingfinder/ pull";
        exec($command, $out, $status);

        echo $command;

			echo "<br><br>";
			
			echo end($out);
			/*
			foreach ($out as $line) {
				echo $line . "<br><br>";
			} */
		
		#echo $status;
    ?>

	<form action="startScreen.php" method="get">
		<button type="submit">Back</button>
	</form>
</body>
</html>
