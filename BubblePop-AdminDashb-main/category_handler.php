<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'bubblebop');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'addCategory') {
        $name = $_POST['name'] ?? '';
        $imagePath = null;

        if (!empty($_FILES['image']['name'])) {
            $targetDir = 'uploads/';
            $fileName = basename($_FILES['image']['name']);
            $imagePath = $fileName;
            $fullPath = $targetDir . $fileName;
            move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);
        }

        $stmt = $conn->prepare("INSERT INTO categories (name, image_path) VALUES (?, ?)");
        $stmt->bind_param('ss', $name, $imagePath);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Category added successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add category.']);
        }


        $stmt->close();
    } elseif ($action === 'editCategory') {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $imagePath = null;

        if (!empty($_FILES['image']['name'])) {
            $targetDir = 'uploads/';
            $fileName = basename($_FILES['image']['name']);
            $imagePath = $fileName;
            $fullPath = $targetDir . $fileName;
            move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);

            $stmt = $conn->prepare("UPDATE categories SET name = ?, image_path = ? WHERE id = ?");
            $stmt->bind_param('ssi', $name, $imagePath, $id);
        } else {
            $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
            $stmt->bind_param('si', $name, $id);
        }

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Category updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update category.']);
        }

        $stmt->close();
    } elseif ($action === 'deleteCategory') {
        $id = $_POST['id'] ?? '';

        $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Category deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete category.']);
        }

        $stmt->close();
    }
}

$conn->close();
