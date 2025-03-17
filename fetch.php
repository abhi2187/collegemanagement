<?php
header("Content-Type: application/json"); // Ensure JSON output
$servername = "sql212.infinityfree.com";
$username = "if0_38490080";
$password = "Abhi1234webs";
$database = "if0_38490080_college_db"; // Change to your actual database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

$sql = "SELECT No ,Event_Name ,Event_Organizer ,Event_Date ,Event_Place FROM events";
$result = $conn->query($sql);

$students = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
} else {
    echo json_encode(["message" => "No records found"]);
    exit();
}

echo json_encode($students);
$conn->close();
?>
