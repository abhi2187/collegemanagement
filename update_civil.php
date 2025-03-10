<?php
$servername = "localhost";
$username = "root";
$password = "abhi2006";
$dbname = "college_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['student_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = "UPDATE civilstudents SET first_name=?, email=?, phone=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $email, $phone, $id);

if ($stmt->execute() === TRUE) {
    echo "Student updated successfully!";
} else {
    echo "Error updating student: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
