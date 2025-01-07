<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bubblebop');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch categories
$query = "SELECT * FROM categories";
$categories = $conn->query($query);

// Check for query errors
if (!$categories) {
    die('Query failed: ' . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BubbleBop Sidebar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            border-right: 1px solid #e0e0e0;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .logo img {
            max-width: 100%;
        }

        .sidebar hr {
            border: 0;
            border-top: 1px solid #e0e0e0;
            margin: 20px 0;
        }

        .sidebar .nav-link {
            color: #555;
            font-weight: 500;
            font-size: 16px;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
        }

        .sidebar .nav-link.active {
            color: #0d6efd;
            font-size: 16px;
            font-weight: bold;
        }

        .sidebar .nav-link:hover {
            background-color: #f0f4ff;
            color: #0d6efd;
        }

        .sidebar .nav-link img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }

        .sidebar .dropdown-icon {
            margin-left: auto;
            width: 12px;
            height: 12px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f0f4ff;
        }

        .content-container {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);

        }

        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;


        }

        .top-nav .dashboard-title {
            display: flex;
            align-items: center;
            font-size: 40px;
            font-weight: 600;
            color: #464e5f;
            font-family: 'Roboto', sans-serif;
        }

        .top-nav .dashboard-title img {
            margin-right: 10px;
            width: 34px;
            height: 34px;
        }

        /* Table Header */
        .table-header {
            background: linear-gradient(45deg, #205CAD, #007bff);
            /* Update to use your blue color */
            color: white;
            font-weight: bold;
        }

        /* Table Styling */
        .table-container .table {
            border-radius: 10px;
            overflow: hidden;
            margin-top: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for the table */
        }

        /* Table Image Styling */
        .table-image {
            width: 50px;
            height: auto;
            border-radius: 5px;
        }

        /* Hover effect for rows */
        .table-hover tbody tr:hover {
            background-color: #F2E6CD;
            /* Light beige color for hover effect */
        }

        /* Action Buttons Styling */
        .action-buttons .btn {
            transition: all 0.3s ease;
        }

        .action-buttons .btn:hover {
            transform: scale(1.1);
            /* Slight zoom effect on button hover */
        }

        /* Button Styling for Add/Edit Product */
        .btn-primary {
            background-color: #205CAD;
            /* Set primary buttons to your brand blue */
            border-color: #205CAD;
        }

        .btn-primary:hover {
            background-color: #1A4F7C;
            /* Darker shade for hover */
            border-color: #1A4F7C;
        }

        .add {
            background-color: #205CAD;
            /* Green for success button */
            color: #FFFFFF;
        }

        .btn-danger {
            background-color: #dc3545;
            /* Red for delete button */
        }

        /* Modal Styling */
        .modal-content {
            background-color: #FFFFFF;
            /* White background for modal */
        }

        .modal-header {
            background-color: #205CAD;
            /* Match modal header with your blue */
            color: white;
        }
    </style>
</head>

<body>
    <div class="sidebar d-flex flex-column">
        <div class="logo mb-4">
            <img src="Logo with mascot - Blue 2.png" alt="BubbleBop Logo">
        </div>
        <hr>
        <nav class="nav flex-column">
            <a class="nav-link" href="#"><img src="material-symbols_dashboard-outline.svg" alt="Dashboard Icon">Dashboard</a>
            <a class="nav-link" href="#"><img src="Purchase Order.svg" alt="Order Icon">Order</a>
            <a class="nav-link" href="#"><img src="Milkshake.svg" alt="Product Icon">Product</a>
            <a class="nav-link active" href="#"><img src="Cardboard Box.svg" alt="Supplies Icon">Categories</a>
            <a class="nav-link" href="#"><img src="Test Results.svg" alt="Inventory Icon">Order Management</a>
            <a class="nav-link" href="#"><img src="Group 37009.svg" alt="Report Icon">Report</a>
        </nav>
    </div>
    <div class="content">
        <div class="content-container">
            <div class="top-nav mb-4">
                <div class="dashboard-title">
                    <img src="material-symbols_dashboard-outline.svg" alt="Dashboard Icon">
                    Dashboard
                </div>
            </div>

            <!-- Add Category Button -->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                Add Category
            </button>

            <!-- Categories Table -->
            <div class="table-container">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr class="table-header">
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($categories) && $categories->num_rows > 0): ?>
                            <?php while ($category = $categories->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $category['id'] ?></td>
                                    <td><?= htmlspecialchars($category['name']) ?></td>
                                    <td>
                                        <?php if (!empty($category['image_path'])): ?>
                                            <img src="uploads/<?= htmlspecialchars($category['image_path']) ?>" alt="<?= htmlspecialchars($category['name']) ?>" class="table-image">
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td class="action-buttons">
                                        <button class="btn btn-sm btn-warning editCategory"
                                            data-id="<?= $category['id'] ?>"
                                            data-name="<?= htmlspecialchars($category['name']) ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal">Edit</button>
                                        <button class="btn btn-sm btn-danger deleteCategory"
                                            data-id="<?= $category['id'] ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No categories found.</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

            <!-- Add Category Modal -->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addCategoryForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="addCategory">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="name" id="categoryName" placeholder="Enter category name">
                                </div>
                                <div class="mb-3">
                                    <label for="categoryImage" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="categoryImage">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Category Modal -->
            <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="editCategory">
                                <input type="hidden" name="id" id="editCategoryId">
                                <div class="mb-3">
                                    <label for="editCategoryName" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="name" id="editCategoryName" placeholder="Enter category name">
                                </div>
                                <div class="mb-3">
                                    <label for="editCategoryImage" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="editCategoryImage">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add Category
            $('#addCategoryForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: 'category_handler.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                        if (response.success) {
                            location.reload(); // Reload to show updated data
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while adding the category.');
                    }
                });
            });

            // Edit Category - Populate Form
            $('.editCategory').click(function() {
                $('#editCategoryId').val($(this).data('id'));
                $('#editCategoryName').val($(this).data('name'));
            });

            // Update Category
            $('#editCategoryForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: 'category_handler.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                        if (response.success) {
                            location.reload(); // Reload to show updated data
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while updating the category.');
                    }
                });
            });

            // Delete Category
            $('.deleteCategory').click(function() {
                if (confirm('Are you sure you want to delete this category?')) {
                    const categoryId = $(this).data('id');

                    $.ajax({
                        url: 'category_handler.php',
                        type: 'POST',
                        data: {
                            action: 'deleteCategory',
                            id: categoryId
                        },
                        dataType: 'json',
                        success: function(response) {
                            alert(response.message);
                            if (response.success) {
                                location.reload(); // Reload to show updated data
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('An error occurred while deleting the category.');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>