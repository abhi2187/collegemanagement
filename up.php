<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the AJAX request
    $action = $_POST['action'];
    $student_id = $_POST['student_id'];
    $course = $_POST['course'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Process the data (e.g., save to a database)
    // For demonstration, we'll just return a success message
    echo json_encode(['status' => 'success', 'message' => 'Data updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>