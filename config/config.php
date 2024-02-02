<?php
// Database connection parameters
$servername = "Your_Servername";  // In my case "localhost"
$username = "Your_Username"; // In my case "root"
$password = "Your_Password";
$dbname = "WA_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
