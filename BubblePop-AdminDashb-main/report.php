<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bubblebop');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch totals
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
$totalProductsQuery = "SELECT COUNT(*) AS total_products FROM products";
$totalPurchasesQuery = "SELECT COUNT(*) AS total_purchases FROM purchases";

$totalUsersResult = $conn->query($totalUsersQuery)->fetch_assoc()['total_users'];
$totalProductsResult = $conn->query($totalProductsQuery)->fetch_assoc()['total_products'];
$totalPurchasesResult = $conn->query($totalPurchasesQuery)->fetch_assoc()['total_purchases'];

// Pass data to JavaScript
$data = [
    'total_users' => $totalUsersResult,
    'total_products' => $totalProductsResult,
    'total_purchases' => $totalPurchasesResult,
];
// Query for each status
$statusCounts = [
    'preparing_count' => 0,
    'in_transit_count' => 0,
    'order_delivered_count' => 0,
    'canceled_count' => 0
];

$query = "
    SELECT 
        status, COUNT(*) as count 
    FROM purchases 
    GROUP BY status
";

$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        switch ($row['status']) {
            case 'Preparing':
                $statusCounts['preparing_count'] = $row['count'];
                break;
            case 'In Transit':
                $statusCounts['in_transit_count'] = $row['count'];
                break;
            case 'Order Delivered':
                $statusCounts['order_delivered_count'] = $row['count'];
                break;
            case 'Canceled':
                $statusCounts['canceled_count'] = $row['count'];
                break;
        }
    }
}
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
