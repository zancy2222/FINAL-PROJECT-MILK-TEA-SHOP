<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
            $productName = $_POST['product_name'];
            $categoryName = $_POST['category'];
            $sizes = $_POST['sizes'];
            $price = $_POST['price'];
            $imagePath = null;

            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                $fileName = basename($_FILES['image']['name']);
                $targetFilePath = $targetDir . $fileName;
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    echo "Error uploading image.";
                    exit;
                }
                $imagePath = $fileName;
            }
            // Insert into the database
            $stmt = $conn->prepare("INSERT INTO products (product_name, category, sizes, price, image_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $productName, $categoryName, $sizes, $price, $imagePath);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Product added successfully";
            } else {
                echo "Error adding product.";
            }

            $stmt->close();
        } elseif ($action === 'edit') {
            $id = $_POST['id'];
            $productName = $_POST['product_name'];
            $categoryName = $_POST['category'];
            $sizes = $_POST['sizes'];
            $price = $_POST['price'];
            $imagePath = null;

            // Check if there's a new image uploaded
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                $imagePath = $targetDir . basename($_FILES['image']['name']);
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    echo "Error uploading image.";
                    exit;
                }
            }

            // Update product
            if ($imagePath) {
                // Update with image
                $stmt = $conn->prepare("UPDATE products SET product_name = ?, category = ?, sizes = ?, price = ?, image_path = ? WHERE id = ?");
                $stmt->bind_param("sssssi", $productName, $categoryName, $sizes, $price, $imagePath, $id);
            } else {
                // Update without changing the image
                $stmt = $conn->prepare("UPDATE products SET product_name = ?, category = ?, sizes = ?, price = ? WHERE id = ?");
                $stmt->bind_param("ssssi", $productName, $categoryName, $sizes, $price, $id);
            }

            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Product updated successfully";
            } else {
                echo "Error updating product.";
            }

            $stmt->close();
        } elseif ($action === 'delete') {
            $id = $_POST['id'];

            // Delete product
            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Product deleted successfully";
            } else {
                echo "Error deleting product.";
            }

            $stmt->close();
        }
    }
}

$conn->close();
