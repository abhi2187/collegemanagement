<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli("localhost", "root", "abhi2006", "college_db");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the request data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['action'])) {
    switch ($data['action']) {
        case 'update':
            // Update student data
            $sql = "UPDATE civilstudents SET 
                    first_name = ?, 
                    last_name = ?, 
                    dob = ?, 
                    gender = ?, 
                    email = ?, 
                    phone = ?, 
                    address = ?, 
                    previous_school = ?, 
                    percentage = ? 
                    WHERE student_id = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssi", 
                $data['firstName'],
                $data['lastName'],
                $data['dob'],
                $data['gender'],
                $data['email'],
                $data['phone'],
                $data['address'],
                $data['previousSchool'],
                $data['percentage'],
                $data['id']
            );

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Student updated successfully']);
            } else {
                echo json_encode(['error' => 'Error updating student: ' . $stmt->error]);
            }
            break;

        case 'delete':
            // Delete student
            $sql = "DELETE FROM civilstudents WHERE student_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $data['id']);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Student deleted successfully']);
            } else {
                echo json_encode(['error' => 'Error deleting student: ' . $stmt->error]);
            }
            break;

        default:
            echo json_encode(['error' => 'Invalid action']);
    }
} else {
    echo json_encode(['error' => 'No action specified']);
}

$conn->close();
?>