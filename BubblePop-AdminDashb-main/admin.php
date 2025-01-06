<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BubbleBop Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="sidebar d-flex flex-column">
        <div class="logo mb-4">
            <img src="Logo with mascot - Blue 2.png" alt="BubbleBop Logo">
        </div>
        <hr>
        <nav class="nav flex-column">
            <a class="nav-link active" href="#"><img src="material-symbols_dashboard-outline.svg" alt="Dashboard Icon">Dashboard</a>
            <a class="nav-link" href="#"><img src="Purchase Order.svg" alt="Order Icon">Order</a>
            <a class="nav-link" href="#"><img src="Milkshake.svg" alt="Product Icon">Product</a>
            <a class="nav-link" href="#"><img src="Cardboard Box.svg" alt="Supplies Icon">Supplies</a>
            <a class="nav-link" href="#"><img src="Test Results.svg" alt="Inventory Icon">Inventory</a>
            <a class="nav-link" href="#"><img src="Group 37009.svg" alt="Report Icon">Report</a>
        </nav>
    </div>
    <div class="content">
        <div class="content-container">
            
            <div class="top-nav">
                <div class="dashboard-title">
                    <img src="material-symbols_dashboard-outline.svg" alt="Dashboard Icon">
                    Dashboard
                </div>
                <div class="notifications">
                    <img class="notif-blue" src="Notification.svg" alt="Notification Icon">
                    
                    <div class="user-menu">
                        <img src="BELL.svg" alt="Notification Icon Red">
                        <img class="male-user" src="Male User.svg" alt="User Icon">
                        <span class="username">Hachib</span>
                        <img class="dropsmall" style="width: 12px; padding-left: 5px;" src="Chevron LeftSmall.svg" alt="Settings Icons">
                        <img class="settings-icon" src="Settings.svg" alt="Settings Icon">
                    </div>
                    
                </div>
            </div>

            <div class="boxes-container">
                <div class="box">
                  <div class="box-header">
                    <span class="box-title">Customers</span>
                    <div class="box-icon">
                      <img src="ellipse-blue.svg" alt="Ellipse Icon">
                      <img src="three-user.svg" alt="Customers Icon">
                    </div>
                  </div>
                  <div class="box-content">
                    <span class="box-number">1045.313</span>
                    <div class="box-growth">
                        <div class="box-green">
                            <img src="growth-arrow.svg" alt="Growth Arrow Icon">
                            <span class="box-growth-text">12.5%</span>
                        </div>
                        <span class="box-growth-from">From 204.234</span>
                    </div>
                  </div>
                </div>
                <div class="box">
                  <div class="box-header">
                    <span class="box-title">Orders</span>
                    <div class="box-icon">
                      <img src="ellipse-red.svg" alt="Ellipse Icon">
                      <img src="tick-square.svg" alt="Orders Icon">
                    </div>
                  </div>
                  <div class="box-content">
                    <span class="box-number">230.816</span>
                    <div class="box-growth">
                        <div class="box-green">
                            <img src="growth-arrow.svg" alt="Growth Arrow Icon">
                            <span class="box-growth-text">12.5%</span>
                        </div>
                        <span class="box-growth-from">From 204.234</span>
                    </div>
                  </div>
                </div>
                <div class="box">
                  <div class="box-header">
                    <span class="box-title">Sales</span>
                    <div class="box-icon">
                      <img src="ellipse-orange.svg" alt="Ellipse Icon">
                      <img src="paper.svg" alt="Sales Icon">
                    </div>
                  </div>
                  <div class="box-content">
                    <span class="box-number">RIECODES</span>
                    <div class="box-growth">
                        <div class="box-green">
                            <img src="growth-arrow.svg" alt="Growth Arrow Icon">
                            <span class="box-growth-text">12.5%</span>
                        </div>
                        <span class="box-growth-from">From 204.234</span>
                    </div>
                  </div>
                </div>
            </div>

            <div class="products-bar-map">
                <div class="product">
                    <div class="top-products-header">Top Products</div>
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>PRODUCTS</th>
                                <th>SALES</th>
                                <th>GROWTH</th>
                                <th>REVENUE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="product-info">
                                    <img src="thumbnail-products.svg" alt="Product Thumbnail">
                                    <div class="product-text">
                                        <span>Boppy Caramel Crunch</span>
                                        <span>Milktea</span>
                                    </div>
                                </td>
                                <td>4723</td>
                                <td class="growth"><span>+42%</span></td>
                                <td>P3,568.00</td>
                            </tr>
                            <tr>
                                <td class="product-info">
                                    <img src="thumbnail-products.svg" alt="Product Thumbnail">
                                    <div class="product-text">
                                        <span>Boppy Caramel Crunch</span>
                                        <span>Milktea</span>
                                    </div>
                                </td>
                                <td>4723</td>
                                <td class="growth"><span>+42%</span></td>
                                <td>P3,568.00</td>
                            </tr>
                            <tr>
                                <td class="product-info">
                                    <img src="thumbnail-products.svg" alt="Product Thumbnail">
                                    <div class="product-text">
                                        <span>Boppy Caramel Crunch</span>
                                        <span>Milktea</span>
                                    </div>
                                </td>
                                <td>4723</td>
                                <td class="growth"><span>+42%</span></td>
                                <td>P3,568.00</td>
                            </tr>
                            <tr>
                                <td class="product-info">
                                    <img src="thumbnail-products.svg" alt="Product Thumbnail">
                                    <div class="product-text">
                                        <span>Boppy Caramel Crunch</span>
                                        <span>Milktea</span>
                                    </div>
                                </td>
                                <td>4723</td>
                                <td class="growth"><span>+42%</span></td>
                                <td>P3,568.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bar-map">
                    <div class="bar-map-header">
                        <span class="customer-map-title">Customer Map</span>
                        <button class="daily-gap-btn">
                            Daily <img src="red-arrow-down.svg" alt="Red Arrow Down">
                        </button>
                    </div>
                    <div class="bar-chart-container">
                        <div class="y-axis">
                            <div class="y-axis-label">100</div>
                            <div class="y-axis-label">80</div>
                            <div class="y-axis-label">60</div>
                            <div class="y-axis-label">40</div>
                            <div class="y-axis-label">20</div>
                            <div class="y-axis-label">0</div>
                        </div>
                        <div class="bar-chart">
                            <div class="bar red-bar" style="height: 60%;"></div>
                            <div class="bar orange-bar" style="height: 80%;"></div>
                            <div class="bar red-bar" style="height: 40%;"></div>
                            <div class="bar orange-bar" style="height: 20%;"></div>
                            <div class="bar red-bar" style="height: 70%;"></div>
                            <div class="bar orange-bar" style="height: 20%;"></div>
                            <div class="bar red-bar" style="height: 50%;"></div>
                        </div>
                        <div class="x-axis">
                            <div class="x-axis-label">Sun</div>
                            <div class="x-axis-label">Mon</div>
                            <div class="x-axis-label">Tue</div>
                            <div class="x-axis-label">Wed</div>
                            <div class="x-axis-label">Thu</div>
                            <div class="x-axis-label">Fri</div>
                            <div class="x-axis-label">Sat</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="unique-line-graph">
                <div class="unique-line-graph-header">
                    <span class="unique-line-graph-title">Total Revenue</span>
                    <div class="unique-year-labels">
                        <span class="unique-year-label">
                            <img src="blue-oblong.svg" alt="Blue Oblong">
                            <span class="unique-year-text">2020</span>
                        </span>
                        <span class="unique-year-label">
                            <img src="red-oblong.svg" alt="Red Oblong">
                            <span class="unique-year-text">2021</span>
                        </span>
                    </div>
                </div>
                <div class="unique-line-graph-container">
                    <div class="unique-y-axis">
                        <div class="unique-y-axis-label">P40k</div>
                        <div class="unique-y-axis-label">P30k</div>
                        <div class="unique-y-axis-label">P20k</div>
                        <div class="unique-y-axis-label">P10k</div>
                        <div class="unique-y-axis-label">0</div>
                    </div>
                    <div class="unique-lines">
                        <svg width="100%" height="100%">
                            <path d="M 0 150 Q 100 100 160 130 T 280 70 T 400 90 T 520 80 T 640 60 T 760 90 T 880 70 T 1000 90 T 1120 80 T 1240 70 T 1360 90 T 1480 80 T 1600 70" 
                                  style="fill:none;stroke:#2D9CDB;stroke-width:4"/>
                            <path d="M 0 250 Q 100 200 160 220 T 280 180 T 400 200 T 520 230 T 640 200 T 760 210 T 880 180 T 1000 200 T 1120 210 T 1240 200 T 1360 220 T 1480 200 T 1600 210" 
                                  style="fill:none;stroke:#FF5B5B;stroke-width:4"/>
                        </svg>
                        
                        <div class="unique-peak-label">
                            <img src="blue-oblong.svg" alt="Blue Oblong">
                            <span class="unique-label-text">P 38,753.00</span>
                        </div>
                        <div class="unique-bottom-label">
                            <img src="red-oblong.svg" alt="Red Oblong">
                            <span class="unique-label-text">P 12,657.00</span>
                        </div>
                    </div>
                    <div class="unique-x-axis">
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Jan
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Feb
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Mar
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Apr
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="red-dot.svg" alt="Dot" class="unique-dot">
                            May
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="blue-dot.svg" alt="Blue Dot" class="unique-dot">
                            Jun
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Jul
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Aug
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Sep
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Red Dot" class="unique-dot">
                            Oct
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Nov
                        </div>
                        <div class="unique-x-axis-label">
                            <img src="dot.svg" alt="Dot" class="unique-dot">
                            Dec
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
