<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<h2>Welcome 
	<?php
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
	?>!</h2>
	<br>
	<br>
	<br>

	<form action="update.php" method="get">
		<button type="submit">Check for Updates</button>
	</form>
	
	<br><br>
	<p2>Please select an action:<p2>
	<form action="addItem.php" method="get">
		<button type="submit">Add a New Item</button>
	</form>
	
	<form action="modifyItem.php" method="get">
		<button type="submit">Modify an Item</button>
	</form>
	
	<form action="addUser.php" method="get">
		<button type="submit">Add a New User</button>
	</form>

	<br><br><br>
	<form action="logout.php" method="get">
		<button type="submit">Logout</button>
	</form>
	
</body>
</html>
