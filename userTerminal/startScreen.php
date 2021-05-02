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
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["permission"]) || $_SESSION["permission"] != "x"){
			header("location: login.php");
			exit;
		}
		else{
			echo $_SESSION["username"];
		}
	?>!</h2>
	<br>
	<br>
	<h3>What can we help you with today?</h3>
	<br>
	<form action="addItem.php" method="get">
		<button type="submit">Add a New Item</button>
	</form>
	
	<form action="modifyItem.php" method="get">
		<button type="submit">Modify an Item</button>
	</form>
	
	<!-- removed due to time constraints

	<form action="addUser.php" method="get">
		<button type="submit">Add a New User</button>
	</form>
	--> 


	<form action="update.php" method="get">
		<button type="submit">Check for Updates</button>
	</form>



	<br><br><br>
	<form action="logout.php" method="get">
		<button type="submit">Logout</button>
	</form>
	
</body>
</html>
