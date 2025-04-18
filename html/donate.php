<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure only logged-in patients can donate
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
        die(header("Location: cases.php?status=unauthorized"));
    }

    $user_id = $_SESSION['user_id'];
    $case_id = isset($_POST['case_id']) ? (int)$_POST['case_id'] : 0;
    $amount = isset($_POST['amount']) ? (float)$_POST['amount'] : 0;
    $currency = $_POST['currency'] ?? 'GBP';

    // Basic validation
    if ($case_id <= 0 || $amount <= 0 || !in_array($currency, ['GBP', 'USD', 'EUR', 'JPY', 'AUD'])) {
        die(header("Location: cases.php?status=invalid"));
    }

    // Insert into donations table
    $stmt = $conn->prepare("INSERT INTO donations (user_id, case_id, amount, currency) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iids", $user_id, $case_id, $amount, $currency);
    $stmt->execute();

    // Redirect back to cases.php
    header("Location: cases.php?status=success");
    exit;
}
?>