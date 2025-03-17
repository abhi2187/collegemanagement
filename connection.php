<?php
$servername = "sql212.infinityfree.com";
$username = "if0_38490080";
$password = "Abhi1234webs";
$database = "if0_38490080_college_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

?>


