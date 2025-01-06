<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
            $productName = $_POST['product_name'];
            $category = $_POST['category'];
            $sizes = $_POST['sizes'];
            $price = $_POST['price'];
            $imagePath = '';

            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                $imagePath = $targetDir . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            }

            // Insert into the database
            $stmt = $conn->prepare("INSERT INTO products (product_name, category, sizes, price, image_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssd", $productName, $category, $sizes, $price, $imagePath);
            $stmt->execute();
            echo "Product added successfully";
        } elseif ($action === 'edit') {
            $id = $_POST['id'];
            $productName = $_POST['product_name'];
            $category = $_POST['category'];
            $sizes = $_POST['sizes'];
            $price = $_POST['price'];
            $imagePath = '';

            // Check if there's a new image uploaded
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                $imagePath = $targetDir . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            }

            // Update product
            $stmt = $conn->prepare("UPDATE products SET product_name = ?, category = ?, sizes = ?, price = ?, image_path = ? WHERE id = ?");
            $stmt->bind_param("ssssdi", $productName, $category, $sizes, $price, $imagePath, $id);
            $stmt->execute();
            echo "Product updated successfully";
        } elseif ($action === 'delete') {
            $id = $_POST['id'];

            // Delete product
            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            echo "Product deleted successfully";
        }
    }
}
?>
