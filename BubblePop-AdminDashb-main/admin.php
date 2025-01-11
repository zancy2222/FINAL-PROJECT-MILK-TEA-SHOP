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

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        canvas {
            margin-top: 15px;
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
            <a class="nav-link active" href="admin.php"><img src="material-symbols_dashboard-outline.svg" alt="Dashboard Icon">Dashboard</a>
            <a class="nav-link" href="order.php"><img src="Purchase Order.svg" alt="Order Icon">Order</a>
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
            <!-- Chart Card -->
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">Statistics</h5>
                        <canvas id="dashboardChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fetch data from PHP
        fetch('report.php') // Replace with the correct PHP file path
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('dashboardChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Total Users', 'Total Products', 'Total Purchases'],
                        datasets: [{
                            label: 'Count',
                            data: [data.total_users, data.total_products, data.total_purchases],
                            backgroundColor: [
                                '#205CAD', // Blue
                                '#28A745', // Green
                                '#FFC107' // Yellow
                            ],
                            hoverBackgroundColor: [
                                '#1A4A8D', // Darker Blue
                                '#206633', // Darker Green
                                '#D1A006' // Darker Yellow
                            ],
                            borderRadius: 10,
                            barThickness: 40
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false // Hide the legend for a cleaner look
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false // Remove grid lines on X-axis
                                },
                                ticks: {
                                    font: {
                                        size: 14
                                    },
                                    color: '#333'
                                }
                            },
                            y: {
                                grid: {
                                    color: '#eee'
                                },
                                beginAtZero: true,
                                ticks: {
                                    font: {
                                        size: 14
                                    },
                                    color: '#333'
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>


</body>

</html>