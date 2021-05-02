<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="w3.css">
	</head>
	
	<?php
		session_start();

		//check if logged in 
		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			header("location: startScreen.php");
			exit;
		}


	?>
	<h2>Welcome to Thing Finder Mobile!</h2>
	<form action="startScreen.php" method="post">
		<label for="username">Username:</label><br>
		<input type="text" id="username" name="username" value=""><br>
		<label for="password">Password:</label><br>
		<input type="text" id="Password" name="Password" value=""><br><br>
		<input type="submit" value="Login">
	</form>
	<br><br>
	<form action ="../index.php" method="get">
		<input type="submit" value ="Return to demo start page">
	</form>
</html>