<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['case_id'])) {
    $doctor_id = $_SESSION['user_id'];
    $case_id = (int) $_POST['case_id'];

    $stmt = $conn->prepare("UPDATE cases SET doctor_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $doctor_id, $case_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Case successfully assigned to you.";
    } else {
        $_SESSION['message'] = "Error assigning case.";
    }

    $stmt->close();
    header("Location: cases.php");
    exit;
}

$caseId = $_POST['case_id'];
$query = "SELECT doctor_id FROM cases WHERE id = " . (int)$caseId;
$result = $conn->query($query);

if ($result && $row = $result->fetch_assoc()) {
    if ($row['doctor_id']) {
        echo "This case is already assigned to a doctor.";
    } else {
        // Proceed with assigning the case
        $assignQuery = "UPDATE cases SET doctor_id = " . (int)$_SESSION['user_id'] . " WHERE id = " . (int)$caseId;
        $conn->query($assignQuery);
        echo "You have successfully taken the case.";
    }
}


header("Location: cases.php");
exit;
?>