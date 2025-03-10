<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
error_log(print_r($_POST, true));
$conn = new mysqli("localhost", "root", "abhi2006", "college_db");

if ($_POST["id"]) {
    $id = $_POST["id"];
    $sql = "DELETE FROM mechstudents WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "Student deleted successfully!";
    $stmt->close();
}
header("Location: admindash.html");   
$conn->close();
?>
