<?php
// register.php
session_start();
require 'config1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form fields
    $first_name       = trim($_POST['first_name']);
    $last_name        = trim($_POST['last_name']);
    $email            = trim($_POST['email']);
    $phone            = trim($_POST['phone']);
    $address          = trim($_POST['address']);
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: register1.html");
        exit();
    }
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: register1.html");
        exit();
    }

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Email is already registered.";
        header("Location: register1.html");
        exit();
    }

    // Hash the password and insert the new user
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$first_name, $last_name, $email, $phone, $address, $passwordHash])) {
        $_SESSION['success'] = "Registration successful. Please log in.";
        header("Location: student-login.html");
        exit();
    } else {
        $_SESSION['error'] = "An error occurred. Please try again.";
        header("Location: student-login.html");
        exit();
    }
}
?>
