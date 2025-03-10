<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['firstName'] ?? '';
    $last_name = $_POST['lastName'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $course = $_POST['course'] ?? '';
    $previous_school = $_POST['previousSchool'] ?? '';
    $percentage = $_POST['percentage'] ?? '';

    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
        die("Error: Please fill all required fields.");
    }

    // Check if the email or phone already exists
    $check_sql = "SELECT * FROM students WHERE email = ? OR phone = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $email, $phone);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Duplicate found, but allow insertion
        $email = $email . "_" . time(); // Add timestamp to make it unique
        $phone = $phone . "_" . rand(1000, 9999);
    }
    $check_stmt->close();

    // Insert data (allow duplicates)
    $sql = "INSERT INTO students (first_name, last_name, dob, gender, email, phone, address, course, previous_school, percentage) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssd", $first_name, $last_name, $dob, $gender, $email, $phone, $address, $course, $previous_school, $percentage);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: success.php"); // Redirect after successful submission
        exit(); // Stop further execution
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
