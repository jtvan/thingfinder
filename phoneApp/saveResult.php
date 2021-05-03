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
    
    $itemImagesPath = "/var/www/thingfinder/itemImages/";
    
    $itemExists = false;
    
    if(isset($_POST["submit"])){
        $itemName= trim($_POST["itemName"]);

        $specificImagePath = $itemImagesPath . $itemName . "/";
        $dest = $specificImagePath . "latest.png";
        echo $dest;
        if(file_exists($specificImagePath)){
            if(file_exists($specificImagePath . "latest.png")){
                unlink($specificImagePath . "latest.png");
            }
            copy("/var/www/thingfinder/result.png", $dest);
            header("location: startScreen.php");
        }
    }

?>
        