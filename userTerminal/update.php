<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<h4>Check for Updates</h4>
	
    <?php
        $command = "/usr/bin/git -C /var/www/thingfinder/ status";
        exec($command, $out, $status);

        echo $command;

			echo "<br><br>";
			
			foreach ($out as $line) {
				echo $line . "<br><br>";
			} 
		
		echo $status;
    ?>

	<form action="startScreen.php" method="get">
		<button type="submit">Back</button>
	</form>
</body>
</html>
