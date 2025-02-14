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

// Fetch categories
$stmt = $conn->prepare("SELECT name, image_path FROM categories");
$stmt->execute();
$result = $stmt->get_result();

$categories = [];
while ($row = $result->fetch_assoc()) {
  $categories[] = $row;
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
    rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="CustomerSide/CustomerSide.css">
  <link rel="stylesheet" href="CustomerSide/footer.css">
  <link rel="stylesheet" href="CustomerSide/header.css">
  <link rel="stylesheet" href="CustomerSide/popular-milktea.css">
  <link rel="stylesheet" href="CustomerSide/sidebar.css">
  <style>
    .bubblebop-category {
      padding: 20px;
      font-family: Arial, sans-serif;
      background-color: #ACC7F0;;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .category-header {
      margin-bottom: 20px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 10px;
    }

    .category-header h2 {
      font-size: 1.5rem;
      color: #333;
    }

    .view-more {
      font-size: 0.9rem;
      color: #007bff;
      text-decoration: none;
    }

    .view-more img {
      width: 12px;
      height: 12px;
    }

    .categories {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .category-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 120px;
      padding: 10px;
      background-color:#205CAD;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .category-item:hover {
      transform: scale(1.05);
    }

    .category-image img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #ddd;
    }

    .category-text {
      margin-top: 8px;
      font-size: 0.9rem;
      font-weight: bold;
      color: #ffff;
      text-align: center;
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
        <a class="nav-link active" href="CustomerSide.php">
          <div class="nav-item-content">
            <img src="Category.svg" alt="Category"> Dashboard
          </div>
        </a>
        <a class="nav-link" href="Order.php">
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

      <div class="bubblebop-category mt-3">
        <div class="category-header d-flex justify-content-between align-items-center">
          <h2>BubbleBop Category</h2>

        </div>
        <div class="categories d-flex flex-wrap justify-content-center gap-3">
          <?php foreach ($categories as $category): ?>
            <div class="category-item text-center">
              <div class="category-image">
                <img src="../BubblePop-AdminDashb-main/uploads/<?= htmlspecialchars($category['image_path']) ?>" alt="<?= htmlspecialchars($category['name']) ?>">
              </div>
              <div class="category-text"><?= htmlspecialchars($category['name']) ?></div>
            </div>
          <?php endforeach; ?>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz4fnFO9gybBogGzY8To0J6loB5Hg5p2mZ9ERV2h/5GATjF3TqwlK5Pj8" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-pZwi7mz6tT9KY6f0ZFk4f5bgNyvYkQ09Ix7GBOFlmF+26a1+v7y0tgKqfL5C3u7G"
    crossorigin="anonymous"></script>
</body>

</html>