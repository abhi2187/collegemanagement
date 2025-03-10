<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "abhi2006", "college_db");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

if (isset($_GET['id'])) {
    // Fetch single student
    $stmt = $conn->prepare("SELECT * FROM ecestudents WHERE student_id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
} else {
    // Fetch all students
    $result = $conn->query("SELECT * FROM ecestudents");
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    echo json_encode($students);
}

$conn->close();
?>
