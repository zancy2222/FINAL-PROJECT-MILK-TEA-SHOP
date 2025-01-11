<?php
session_start();
include 'db_conn.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['product_id'])) {
    echo 'error';
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);

// Save purchase to a "purchases" table (create this table if it doesn't exist)
$stmt = $conn->prepare("INSERT INTO purchases (user_id, product_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $product_id);

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}

$stmt->close();
$conn->close();
?>
