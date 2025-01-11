<?php
include 'db_conn.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
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
            <a class="nav-link" href="admin.php"><img src="material-symbols_dashboard-outline.svg" alt="Dashboard Icon">Dashboard</a>
            <a class="nav-link" href="order.php"><img src="Purchase Order.svg" alt="Order Icon">Order</a>
            <a class="nav-link active" href="inventory.php"><img src="Milkshake.svg" alt="Product Icon">Product</a>
            <a class="nav-link" href="category.php"><img src="Cardboard Box.svg" alt="Supplies Icon">Categories</a>
            <a class="nav-link" href="order_management.php"><img src="Test Results.svg" alt="Inventory Icon">Order Management</a>
            <a class="nav-link" href="../index.php"><img src="arrow-red-down.svg" alt="Inventory Icon"> <span style="color:darkred; font-weight:bold;">Log Out</span></a>

        </nav>
    </div>
    <div class="content">
        <div class="content-container">
            <div class="top-nav">
                <div class="dashboard-title">
                    <img src="material-symbols_dashboard-outline.svg" alt="Dashboard Icon">
                    Dashboard
                </div>
            </div>
            <div class="table-container">
                <!-- Add Product Button -->
                <button class="btn add" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

                <!-- Product Table -->
                <table class="table table-hover table-striped">
                    <thead>
                        <tr class="table-header">
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Sizes</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                                    <td><?= htmlspecialchars($row['category']) ?></td>
                                    <td><?= htmlspecialchars($row['sizes']) ?></td>
                                    <td>&#8369;<?= number_format($row['price'], 2) ?></td>
                                    <td>
                                        <?php if (!empty($row['image_path'])): ?>
                                            <img src="uploads/<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" class="table-image">
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>

                                    </td>

                                    <td class="action-buttons">
                                        <button class="btn btn-sm add editProduct"
                                            data-id="<?= $row['id'] ?>"
                                            data-name="<?= htmlspecialchars($row['product_name']) ?>"
                                            data-category="<?= htmlspecialchars($row['category']) ?>"
                                            data-sizes="<?= htmlspecialchars($row['sizes']) ?>"
                                            data-price="<?= $row['price'] ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editProductModal">Edit</button>
                                        <button class="btn btn-sm add deleteProduct"
                                            data-id="<?= $row['id'] ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Add Product Modal -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addProductForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="add">
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" id="productName" placeholder="Enter product name">
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="" disabled selected>Select a category</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="sizes" class="form-label">Sizes</label>
                                    <input type="text" class="form-control" name="sizes" id="sizes" placeholder="Enter sizes">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter price">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Product Modal -->
            <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" id="editProductId">
                                <div class="mb-3">
                                    <label for="editProductName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" id="editProductName" placeholder="Enter product name">
                                </div>
                                <div class="mb-3">
                                    <label for="editCategory" class="form-label">Category</label>
                                    <select class="form-control" name="category" id="editCategory">
                                        <option value="" disabled selected>Select a category</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="editSizes" class="form-label">Sizes</label>
                                    <input type="text" class="form-control" name="sizes" id="editSizes" placeholder="Enter sizes">
                                </div>
                                <div class="mb-3">
                                    <label for="editPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" name="price" id="editPrice" placeholder="Enter price">
                                </div>
                                <div class="mb-3">
                                    <label for="editImage" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="editImage">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Product</button>
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
            $("#addProductForm").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'product_actions.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $("#editProductForm").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'product_actions.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $(".deleteProduct").click(function() {
                var productId = $(this).data("id");

                $.post('product_actions.php', {
                    action: 'delete',
                    id: productId
                }, function() {
                    location.reload();
                });
            });

            $(".editProduct").click(function() {
                var productId = $(this).data("id");
                var productName = $(this).data("name");
                var category = $(this).data("category");
                var sizes = $(this).data("sizes");
                var price = $(this).data("price");

                $("#editProductId").val(productId);
                $("#editProductName").val(productName);
                $("#editCategory").val(category);
                $("#editSizes").val(sizes);
                $("#editPrice").val(price);
            });
        });
        $(document).ready(function() {
            function loadCategories() {
                $.ajax({
                    url: 'fetch_categories.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            const categories = response.categories;
                            const categoryDropdown = $('#category');
                            const editCategoryDropdown = $('#editCategory');

                            categoryDropdown.empty().append('<option value="" disabled selected>Select a category</option>');
                            editCategoryDropdown.empty().append('<option value="" disabled selected>Select a category</option>');

                            categories.forEach(category => {
                                const option = `<option value="${category.name}">${category.name}</option>`;
                                categoryDropdown.append(option);
                                editCategoryDropdown.append(option);
                            });
                        } else {
                            alert(response.message || 'Failed to load categories.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while fetching categories.');
                    }
                });
            }

            loadCategories();
        });
    </script>

</body>

</html>