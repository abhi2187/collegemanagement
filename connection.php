<?php
$servername = "localhost";
$username = "root"; // Default for WAMP
$password = "abhi2006"; // Default is empty
$dbname = "college_db"; // Change this to your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

?>


