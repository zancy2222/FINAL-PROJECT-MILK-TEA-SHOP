<?php
session_start();
header('Content-Type: application/json');
include 'BubblePop-AdminDashb-main/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === 'Admin@gmail.com' && $password === 'Admin123') {
        $_SESSION['admin'] = true;
        echo json_encode(['success' => true, 'message' => 'Admin login successful', 'redirect' => 'BubblePop-AdminDashb-main/admin.php']);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $user_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            echo json_encode(['success' => true, 'message' => 'Login successful', 'user_id' => $user_id, 'redirect' => 'bubbleuser/CustomerSide.php?id=' . $user_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
    }

    $stmt->close();
    $conn->close();
}
