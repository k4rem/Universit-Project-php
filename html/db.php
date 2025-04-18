<?php
$host = 'db';
$user = 'user';
$password = 'password';
$database = 'taazur';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>