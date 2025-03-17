<?php
header('Content-Type: application/json');

 // Ensure JSON output
$servername = "sql212.infinityfree.com";
$username = "if0_38490080";
$password = "Abhi1234webs";
$database = "if0_38490080_college_db";

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

if (isset($_GET['id'])) {
    // Fetch single student
    $stmt = $conn->prepare("SELECT * FROM civilstudents WHERE student_id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
} else {
    // Fetch all students
    $result = $conn->query("SELECT * FROM civilstudents");
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    echo json_encode($students);
}

$conn->close();
?>
