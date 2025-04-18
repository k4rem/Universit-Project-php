<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, first_name, last_name, password, role, active FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $first, $last, $hashed, $role, $active);
    $stmt->fetch();

    if ($password === $hashed) {
        if (!$active) {
            $_SESSION['login_error'] = "Your account is awaiting verification.";
            header("Location: index.php#login");
            exit;
        }
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = "$first $last";
        $_SESSION['role'] = $role;
        $_SESSION['active'] = $active;
        $_SESSION['login_success'] = "Welcome back!";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Incorrect password.";
        header("Location: index.php#login");
        exit;
    }
} else {
    $_SESSION['login_error'] = "User not found.";
    header("Location: index.php#login");
    exit;
}