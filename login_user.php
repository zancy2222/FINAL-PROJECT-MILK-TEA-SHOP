<?php
session_start();
header('Content-Type: application/json');
include 'BubblePop-AdminDashb-main/db_conn.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if the credentials match the default admin account
    if ($email === 'Admin@gmail.com' && $password === 'Admin123') {
        $_SESSION['admin'] = true; // Set admin session
        echo json_encode(['success' => true, 'message' => 'Admin login successful', 'redirect' => 'BubblePop-AdminDashb-main/admin.php']);
        exit;
    }

    // Check the database for user credentials
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $user_name, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Correct password, login successful
            $_SESSION['user_id'] = $user_id; // Store user ID in session
            echo json_encode(['success' => true, 'message' => 'Login successful', 'user_id' => $user_id, 'redirect' => 'bubbleuser/CustomerSide.php?id=' . $user_id]);
        } else {
            // Incorrect password
            echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
        }
    } else {
        // User does not exist
        echo json_encode(['success' => false, 'message' => 'User not found.']);
    }

    $stmt->close();
    $conn->close();
}
?>
