<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
</head>
<body>
	<form action="scan.php" method="get">
		<p1>Please select a tracking type</p1>
		<br>
		<input type="radio" id="RFID" name="rfid" value="male">
		<label for="male">RFID Tracking</label><br>
		<input type="radio" id="visual" name="visual" value="female">
		<label for="female">Visual</label><br>
		<input type="radio" id="composite" name="composite" value="other">
		<label for="composite">RFID and Visual</label> 
		
		<br>
		<label for="itemName">Name the item:</label>
		<input type="text" id="itemName" name="itemName" required>
		
		<label  
		<br>
		<br>
		<button type="submit">Continue</button>
	</form>
</body>
</html>