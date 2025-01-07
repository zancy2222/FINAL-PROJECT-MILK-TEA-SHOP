<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'bubblebop');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

$query = "SELECT id, name FROM categories";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    echo json_encode(['success' => true, 'categories' => $categories]);
} else {
    echo json_encode(['success' => false, 'message' => 'No categories found.']);
}

$conn->close();
?>
