<html>

<head>
	<link rel="shortcut icon" href="favi.png" />
	<link rel="stylesheet" href="w3.css">
	<header>
		<title>Thing Finder Preview</title> 
	</header>
</head> 
<body>
	<?php

		// Initialize the session
		session_start();

		// Check if the user is already logged in, if yes then redirect him to welcome page
		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["permission"]) && $_SESSION["permission"] == "x"){
			header("location: startScreen.php");
			exit;

		}

		// Define variables and initialize with empty values
		$username = $password = "";
		$username_err = $password_err = $login_err = "";
		
		// Processing form data when form is submitted
		if($_SERVER["REQUEST_METHOD"] == "POST"){
		
			// Check if username is empty
			if(empty(trim($_POST["username"]))){
				$username_err = "Please enter username.";
			} else{
				$username = trim($_POST["username"]);
			}
			
			// Check if password is empty
			if(empty(trim($_POST["password"]))){
				$password_err = "Please enter your password.";
			} else{
				$password = trim($_POST["password"]);
			}

			// Validate credentials
			$file = fopen("/var/www/thingfinder/users.txt", "r");

			/*
			echo $username;
			echo "<br><br>";
			echo $password;
			echo "<br><br>";
			*/

			while(! feof($file)){
				$line =  fgets($file);
				$credArry = explode(":", $line);

				$uname = trim($credArry[0]);
				$pword = trim($credArry[1]);
				$priv = trim($credArry[2]);
				
				/*
				echo strcmp($uname, $username) . "    ". strcmp($pword, $password);
				echo "<br><br>";
				*/
	
				//if we match credentials
				if(strcmp($uname, $username) == 0 && strcmp($pword, $password) == 0){
					//echo $uname ."<br><br>" . $pword ."<br><br>" . $priv ."<br><br>" ;
					//if we have permission to login to managment console
					if(strcmp($priv, "x") ==0){
						session_start();    
						// Store data in session variables
						$_SESSION["loggedin"] = true;
						$_SESSION["id"] = $id;
						$_SESSION["username"] = $username;  
						$_SESSION["permission"] = $priv;

						header("location: startScreen.php");
					}
					else{
						$login_err = "That account does not have permission to access the managment console.";
					}
				}
				else $login_err = "Invalid username or password.";

			}
			fclose($file);
			
		}
	?>
	<h2>Welcome to the Thing Finder Managment Console!</h2>

	<div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <!-- <p>Don't have an account? <a href="register.php">Sign up now</a>.</p> -->
        </form>
    </div>


	<!--<form action="startScreen.php" method="post">
		<label for="username">Username:</label><br>
		<input type="text" id="username" name="username" value=""><br>
		<label for="password">Password:</label><br>
		<input type="text" id="Password" name="Password" value=""><br><br>
		<input type="submit" value="Login">
	</form> -->
	<br><br>
	<form action ="../index.php" method="get">
		<input type="submit" value ="Return to demo start page">
	</form>
</body>
</html>
