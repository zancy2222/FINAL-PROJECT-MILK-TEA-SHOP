<?php
session_start();
include 'db_conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

// Fetch user name
$user_id = $_GET['id'] ?? $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_name);
$stmt->fetch();
$stmt->close();

// Fetch products
$stmt = $conn->prepare("SELECT id, product_name, category, sizes, price, image_path FROM products");
$stmt->execute();
$result = $stmt->get_result();
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap 5 Sidebar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="CustomerSide/bubblebop-category.css">
    <link rel="stylesheet" href="CustomerSide/CustomerSide.css">
    <link rel="stylesheet" href="CustomerSide/footer.css">
    <link rel="stylesheet" href="CustomerSide/header.css">
    <link rel="stylesheet" href="CustomerSide/popular-milktea.css">
    <link rel="stylesheet" href="CustomerSide/sidebar.css">
    <style>
        .custom-btn {
            background-color: #205cad;
            color: #fff;
            border: none;
        }

        .custom-btn:hover {
            background-color: #184a8c;
            /* Optional: Darker shade for hover */
            color: #fff;
        }
    </style>
</head>

<body>
    <main>
        <div class="sidebar">
            <div class="logo">
                <img src="logo-mascot-blue.svg" alt="Logo" width="150">
            </div>
            <div class="divider"></div>
            <nav class="nav flex-column">
                <a class="nav-link" href="CustomerSide.php">
                    <div class="nav-item-content">
                        <img src="Category.svg" alt="Category"> Dashboard
                    </div>
                </a>
                <a class="nav-link active" href="Order.php">
                    <div class="nav-item-content">
                        <img src="Edit-Square.svg" alt="Edit Square"> Food Order
                    </div>
                </a>

                <a class="nav-link" href="Settings.php">
                    <div class="nav-item-content">
                        <img src="Heart.svg" alt="Settings"> Order Status
                    </div>
                </a>
                <a class="nav-link" href="../index.php">
                    <div class="nav-item-content">
                        <img src="Setting.svg" alt="Settings"> Log Out
                    </div>
                </a>
            </nav>
            <div class="divider"></div>
            <div class="upgrade-box mt-4">
                <p>Upgrade your Account to Get Free Vouchers</p>
                <button class="btn"><span>Upgrade Now</span></button>
            </div>
        </div>


        <div class="main-content">
            <div class="header">
                <div class="header-content">
                    <div class="greeting">
                        <span>Hello <?php echo htmlspecialchars($user_name); ?>!</span>
                        <span class="emoji">👋</span>
                    </div>
                    <div class="subtext">What do you want to Drink?</div>
                </div>

                <div class="user-info">

                    <img src="user.png" alt="User" class="rounded-circle" style="width: 50px;">
                    <div class="user-name"><?php echo htmlspecialchars($user_name); ?>
                        <div style="font-size: 14px; color:#205cad;">Customer</div>
                    </div>
                </div>
            </div>

            <div class="discount-banner">
                <div class="text">
                    20% Discount on all<br>
                    Vanilla Filled Products
                    <br>
                    <a href="#" class="coupon">Get Coupon</a>
                </div>
                <img src="white-Banner.svg" alt="Mascot" class="mascot">
            </div>
            <!-- Products Section -->
            <div class="products">
                <h2>Products</h2>
                <div class="row">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <?php if (!empty($product['image_path'])): ?>
                                    <img style="width: auto; height:200px;" src="../BubblePop-AdminDashb-main/uploads/<?= htmlspecialchars($product['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['product_name']) ?>">
                                <?php endif; ?>

                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                                    <p class="card-text">Category: <?= htmlspecialchars($product['category']) ?></p>
                                    <p class="card-text">Sizes: <?= htmlspecialchars($product['sizes']) ?></p>
                                    <p class="card-text">Price: PHP <?= number_format($product['price'], 2) ?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <button class="btn custom-btn buy-btn" data-product-id="<?= $product['id'] ?>">Buy</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Product successfully bought!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>


        </div>
    </main>

    <footer class="footer">
        <div class="container-fluid" style="padding: 0 5%;">
            <div class="row">
                <div class="col-md-2 footer-column footer-below">
                    <img src="logo-mascot-white.svg" alt="Logo" width="250">
                </div>
                <div class="col-md-2 footer-column">
                    <div class="footer-header">About Us</div>
                    <p>At BubbleBop, we're more than just a milky tea shop—we're creators of delightful experiences and purveyors
                        of flavorful indulgence. Born from a passion for crafting exceptional beverages and fostering community
                        connections, BubbleBop is where innovation meets tradition, and every sip tells a story.</p>
                </div>
                <div class="col-md-2 footer-column">
                    <div class="footer-header">Contact Us</div>
                    <p><img src="phone.svg" alt="Phone" style="margin-left: -4.5px;">09XXXXXXXXXXX</p>
                    <p><img src="email.svg" alt="Email"> Bubble_Pop@gmail.com</p>
                    <p><img src="location.svg" alt="Location"> CVSU Naic</p>
                </div>
                <div class="col-md-2 footer-column">
                    <div class="footer-header">Categories</div>
                    <p>Milktea</p>
                    <p>Fruit Tea</p>
                    <p>Sweets</p>
                    <p>Snacks</p>
                </div>
                <div class="col-md-2 footer-column footer-below">
                    <div class="footer-header">Get updates from BubbleBop!</div>
                    <input type="email" class="form-control mb-2" placeholder="Your email here">
                    <button class="btn btn-primary w-100">Subscribe</button>
                </div>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-bottom">
                <a href="#">Terms & Condition</a>
                <span class="px-4">|</span>
                <a href="#">Privacy Policy</a>
                <span class="px-4">|</span>
                <a href="#"><img src="social.svg" alt="Social" class="social-icon"></a>
            </div>
            <div class="footer-bottom pt-5">
                @2024 BubbleBop, LLC. All Rights Reserved.
            </div>
        </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.buy-btn').on('click', function() {
                const productId = $(this).data('product-id');
                $.post('buy_product.php', {
                    product_id: productId
                }, function(response) {
                    if (response === 'success') {
                        $('#successModal').modal('show');
                    } else {
                        alert('Error: Could not complete the purchase.');
                    }
                });
            });
        });
    </script>
</body>

</html>