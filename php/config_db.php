<!-- PHP for starting the session and connecting to server and database -->

<?php

// Start the session
session_start();

// Set Timezone of PHP date() function to Dubai's Time
$timezone = date_default_timezone_set("Asia/Dubai");

// Connect to XAMPP Localhost Server and Byte Delight Database
$server_name = "localhost";
$server_username = "root";
$server_password = "";
$database = "bytedelight_db";

// Use MySqli to establish database connection
$conn = new mysqli($server_name, $server_username, $server_password, $database) or die("Connection to database failed: %s\n". $conn -> error);

?>