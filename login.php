<?php
// login.php
session_start();
require 'config1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in both fields.";
        header("Location: login.html");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        // Login successful; store user data in session
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name']  = $user['last_name'];
        header("Location: studentdash.html");
        exit();
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: student-login.html");
        exit();
    }
}
?>
