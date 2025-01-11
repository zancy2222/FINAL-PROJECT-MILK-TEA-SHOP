<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bubblebop');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch purchases with user and product details
$sql = "
    SELECT 
        u.name AS user_name,
        p.product_name,
        p.sizes,
        p.image_path,
        pr.purchased_at
    FROM 
        purchases pr
    JOIN 
        users u ON pr.user_id = u.id
    JOIN 
        products p ON pr.product_id = p.id
    ORDER BY 
        pr.purchased_at DESC
";

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
            color: white;
            font-weight: bold;
            text-align: center;
            /* Centers header content */
        }

        /* Table Styling */
        .table-container .table {
            border-radius: 10px;
            overflow: hidden;
            margin-top: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for the table */
        }

        /* Center Table Data */
        .table td,
        .table th {
            text-align: center;
            /* Centers all table data */
            vertical-align: middle;
            /* Centers data vertically */
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
            <a class="nav-link active" href="order.php"><img src="Purchase Order.svg" alt="Order Icon">Order</a>
            <a class="nav-link" href="inventory.php"><img src="Milkshake.svg" alt="Product Icon">Product</a>
            <a class="nav-link" href="category.php"><img src="Cardboard Box.svg" alt="Supplies Icon">Categories</a>
            <a class="nav-link" href="order_management.php"><img src="Test Results.svg" alt="Inventory Icon">Order Management</a>
            <a class="nav-link" href="../index.php"><img src="arrow-red-down.svg" alt="Inventory Icon"> <span style="color:darkred; font-weight:bold;">Log Out</span></a>

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

            <div class="table-container">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr class="table-header">
                            <th>User Name</th>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Image</th>
                            <th>Purchased At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                                    <td><?= htmlspecialchars($row['sizes']) ?></td>
                                    <td>
                                        <?php if (!empty($row['image_path'])): ?>
                                            <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" width="50" height="50">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($row['purchased_at']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No purchases found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    </script>

</body>

</html>